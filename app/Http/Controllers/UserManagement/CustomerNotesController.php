<?php
/**
 * Created by PhpStorm.
 * Filename: CustomerNotesController.php
 * User: Orhan BAHAR
 * Date: 20.07.2021
 * Time: 16:03
 */

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerNote;
use App\Models\IpBan;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Claims\Custom;

class CustomerNotesController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $user = auth()->user();
        $userId = $request->input('user_id');
        $username = $request->input('username');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $sortKey = $request->input('sort_key');
        $sortValue = $request->input('sort_value');
        $limit = $request->input('limit') ?? 25;

        if (!empty($username)) {
            $checkUser = Customer::where('site_id', $this->siteId)
                ->where('username', $user)
                ->orderBy('id', 'DESc')
                ->first();

            if (empty($checkUser)) {
                return response()->json([
                    'status' => false,
                    'message' => 'no data',
                    'list' => []
                ]);
            }
        } else {
            $checkUser = [];
        }

        $getCustomerNotes = new CustomerNote();
        $getCustomerNotes = $getCustomerNotes->select([
            'id',
            'customer_id',
            'admin_id',
            'message',
            'date as create_date',
        ]);
        $getCustomerNotes = $getCustomerNotes->where('site_id', $this->siteId);

        if (!empty($userId) && empty($username))
            $getCustomerNotes = $getCustomerNotes->where('customer_id', $userId);

        if (!empty($username))
            $getCustomerNotes = $getCustomerNotes->where('customer_id', $checkUser->id);

        if (!empty($startDate))
            $getCustomerNotes = $getCustomerNotes->whereRaw("CONVERT_TZ(CONCAT(date), '+00:00','$user->timezone:00') >= '$startDate'");

        if (!empty($endDate))
            $getCustomerNotes = $getCustomerNotes->whereRaw("CONVERT_TZ(CONCAT(date), '+00:00','$user->timezone:00') <= '$endDate'");

        if (!empty($sortKey)) {
            $convertSort = filter_var($sortValue, FILTER_VALIDATE_BOOLEAN);

            if (!$convertSort)
                $sorting = 'ASC';
            else
                $sorting = 'DESC';

            $getCustomerNotes = $getCustomerNotes->orderBy($sortKey, $sorting);
        } else {
            $getCustomerNotes = $getCustomerNotes->orderBy('id', 'DESC');
        }

        $getCustomerNotes = $getCustomerNotes->paginate($limit);

        # Data Optimization
        $getCustomerNotes->getCollection()->transform(function ($value) use ($user) {
            $admin = [
                'id' => $value->admin_id,
                'username' => $value->admin_id > 0 ? ($value->user->username ?? null) : null
            ];

            $players = [
                'id' => $value->customer_id,
                'username' => $value->customer_id > 0 ? ($value->customer->username ?? null) : null
            ];

            $value['admin'] = $admin;
            $value['player'] = $players;
            $value['create_date'] = $this->timezone($value->create_date, $user->timezone);

            unset($value['customer_id']);
            unset($value['customer']);
            unset($value['user']);
            unset($value['admin_id']);

            return $value;
        });

        return response()->json([
            'status' => true,
            'message' => 'success',
            'list' => $getCustomerNotes
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function detail($id): JsonResponse
    {
        $user = auth()->user();

        $getCustomerNote = CustomerNote::where('id', $id)
            ->where('site_id', $this->siteId)
            ->first();

        if (empty($getCustomerNote))
            return response()->json([
                'status' => false,
                'message' => 'No data'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => [
                'id' => $getCustomerNote->id,
                'message' => $getCustomerNote->message,
                'create_date' => $this->timezone($getCustomerNote->date, $user->timezone),
                'admin' => [
                    'id' => $getCustomerNote->admin_id,
                    'username' => $getCustomerNote->admin_id > 0 ? ($getCustomerNote->user->username ?? null) : null
                ],
                'player' => [
                    'id' => $getCustomerNote->customer_id,
                    'username' => $getCustomerNote->customer_id > 0 ? ($getCustomerNote->customer->username ?? null) : null
                ]
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $user = auth()->user();
        $data = $request->only(
            'customer_id',
            'message'
        );

        $validator = Validator::make($data, [
            'customer_id' => 'required|integer',
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $createCustomerNote = CustomerNote::create([
            'site_id' => $this->siteId,
            'admin_id' => $user->id,
            'customer_id' => $request->input('customer_id'),
            'message' => $request->input('message'),
            'date' => Carbon::now()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer note created successfully',
            'detail' => $createCustomerNote
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $data = $request->only(
            'message'
        );

        $validator = Validator::make($data, [
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updateCustomerNote = CustomerNote::where('id', $id)
            ->where('site_id', $this->siteId)
            ->update([
                'message' => $request->input('message'),
                'date' => Carbon::now()
            ]);

        if (!$updateCustomerNote)
            return response()->json([
                'status' => false,
                'message' => 'Customer note not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer note updated successfully'
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function delete($id, Request $request): JsonResponse
    {
        $deleteCustomerNote = CustomerNote::where('id', $id)
            ->where('site_id', $this->siteId)
            ->delete();

        # Check if delete for Customer Note
        if (!$deleteCustomerNote)
            return response()->json([
                'status' => false,
                'message' => 'Customer note not deleted'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer note deleted successfully'
        ]);
    }
}
