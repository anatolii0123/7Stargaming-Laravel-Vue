<?php
/**
 * Created by PhpStorm.
 * Filename: IpBanController.php
 * User: Orhan BAHAR
 * Date: 21.07.2021
 * Time: 18:48
 */

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\IpBan;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IpBanController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getIpBans(Request $request): JsonResponse
    {
        $user = auth()->user();
        $ipAddress = $request->input('ip_address');

        $getIpBans = new IpBan();
        $getIpBans = $getIpBans->select([
            'id',
            'admin_id',
            'ip_address',
            'description',
            'date as create_date',
        ]);
        $getIpBans = $getIpBans->where('site_id', $this->siteId);

        if (!empty($ipAddress))
            $getIpBans = $getIpBans->where('ip_address', $ipAddress);

        $getIpBans = $getIpBans->orderBy('id', 'DESC');
        $getIpBans = $getIpBans->paginate(25);

        # Data Optimization
        $getIpBans->getCollection()->transform(function ($value) use ($user) {
            $admin = [
                'id' => $value->admin_id,
                'username' => $value->admin_id > 0 ? ($value->user->username ?? 'Unknown') : null
            ];

            $value['admin'] = $admin;
            $value['create_date'] = $this->timezone($value->create_date, $user->timezone);

            unset($value['user']);
            unset($value['admin_id']);

            return $value;
        });

        return response()->json([
            'status' => true,
            'message' => 'success',
            'list' => $getIpBans
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getIpBan($id): JsonResponse
    {
        $user = auth()->user();

        $getIpBan = IpBan::where('id', $id)
            ->where('site_id', $this->siteId)
            ->first();

        if (empty($getIpBan))
            return response()->json([
                'status' => false,
                'message' => 'No data'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => [
                'id' => $getIpBan->id,
                'ip_address' => $getIpBan->ip_address,
                'description' => $getIpBan->description,
                'create_date' => $this->timezone($getIpBan->date, $user->timezone),
                'admin' => [
                    'id' => $getIpBan->admin_id,
                    'username' => $getIpBan->admin_id > 0 ? ($getIpBan->user->username ?? null) : null
                ]
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeIpBan(Request $request): JsonResponse
    {
        $user = auth()->user();
        $data = $request->only(
            'ip_address',
            'description'
        );

        $validator = Validator::make($data, [
            'ip_address' => 'required|string',
            'description' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $createIpBan = IpBan::create([

            'site_id' => $this->siteId,
            'admin_id' => $user->id,
            'ip_address' => $request->input('ip_address'),
            'description' => $request->input('description'),
            'date' => Carbon::now()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Ip Ban created successfully',
            'detail' => $createIpBan
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateIpBan($id, Request $request): JsonResponse
    {
        $data = $request->only(
            'ip_address',
            'description'
        );

        $validator = Validator::make($data, [
            'ip_address' => 'required|string',
            'description' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updateIpBan = IpBan::where('id', $id)
            ->where('site_id', $this->siteId)
            ->update([
                'ip_address' => $request->input('ip_address'),
                'description' => $request->input('description'),
                'date' => Carbon::now()
            ]);

        if (!$updateIpBan)
            return response()->json([
                'status' => false,
                'message' => 'Ip Ban not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Ip Ban updated successfully'
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteIpBan($id, Request $request): JsonResponse
    {
        $deleteIpBan = IpBan::where('id', $id)
            ->where('site_id', $this->siteId)
            ->delete();

        # Check if delete for IP Ban
        if (!$deleteIpBan)
            return response()->json([
                'status' => false,
                'message' => 'Ip ban not deleted'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Ip ban deleted successfully'
        ]);
    }
}
