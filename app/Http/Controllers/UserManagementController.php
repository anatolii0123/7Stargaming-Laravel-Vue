<?php
/**
 * Created by PhpStorm.
 * Filename: UserManagementController.php
 * User: Orhan BAHAR
 * Date: 11.07.2021
 * Time: 23:35
 */

namespace App\Http\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Customer;

class UserManagementController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUsers(Request $request): JsonResponse
    {
        $user = auth()->user();
        $startDate = Carbon::now()->addMinutes('-2');
        $endDate = Carbon::now()->addMinutes('+2');
        $userId = $request->input('id');
        $username = $request->input('username');
        $phoneNumber = $request->input('phone_number');
        $email = $request->input('email');
        $identityNumber = $request->input('identity_number');
        $ipAddress = $request->input('ip_address');
        $createDate = $request->input('create_date');
        $affiliateId = $request->input('affiliate_id');
        $groupId = $request->input('group_id');
        $sortKey = $request->input('sort_key');
        $sortValue = $request->input('sort_value');

        $responseData = [
            'status' => true,
            'message' => 'success',
            'list' => []
        ];

        $getUsers = new Customer();
        $getUsers = $getUsers->select([
            'id',
            'status',
            'balance',
            'currency',
            'create_date',
            'online_date',
            'name',
            'surname',
            'username',
            'tckimlik as identity_number',
            'group_id',
            'affilate_id as affiliate_id'
        ]);
        $getUsers = $getUsers->where('site_id', $this->siteId);

        if (!empty($userId))
            $getUsers = $getUsers->where('id', $userId);

        if (!empty($username))
            $getUsers = $getUsers->where('username', $username);

        if (!empty($phoneNumber))
            $getUsers = $getUsers->where('phone', 'LIKE', '%' . $phoneNumber . '%');

        if (!empty($email))
            $getUsers = $getUsers->where('email', $email);

        if (!empty($identityNumber))
            $getUsers = $getUsers->where('tckimlik', $identityNumber);

        if (!empty($ipAddress))
            $getUsers = $getUsers->where('last_login_ip_address', $ipAddress);

        if (!empty($createDate))
            $getUsers = $getUsers->whereDate('create_date', $createDate);

        if (!empty($affiliateId))
            $getUsers = $getUsers->where('affilate_id', $affiliateId);

        if (!empty($groupId))
            $getUsers = $getUsers->where('group_id', $groupId);

        if (!empty($sortKey)) {
            $convertSort = filter_var($sortValue, FILTER_VALIDATE_BOOLEAN);

            if (!$convertSort)
                $sorting = 'ASC';
            else
                $sorting = 'DESC';

            $getUsers = $getUsers->orderBy($sortKey, $sorting);
        } else {
            $getUsers = $getUsers->orderBy('id', 'DESC');
        }

        $getUsers = $getUsers->paginate(25);

        # Data Optimization
        $getUsers->getCollection()->transform(function ($value) use ($user, $startDate, $endDate) {
            $value['group_name'] = $value->group_id > 0 ? $value->group->name : null;
            $value['group_color'] = $value->group_id > 0 ? $value->group->color : null;
            $value['group_icon'] = $value->group_id > 0 ? $value->group->icon : null;
            $value['affiliate_name'] = $value->affiliate_id > 0 ? ($value->affiliate->username ?? null) : null;

            if ($value->online_date > $startDate && $value->online_date < $endDate) {
                $value['online'] = 1;
            } else {
                $value['online'] = 0;
            }

            $value['create_date'] = $this->timezone($value->create_date, $user->timezone);
            $value['online_date'] = $this->timezone($value->online_date, $user->timezone);

            unset($value['group']);
            unset($value['affiliate']);

            return $value;
        });

        $responseData['list'] = $getUsers;

        return response()->json($responseData);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getMultiIps(Request $request): JsonResponse
    {
        $user = auth()->user();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (empty($startDate)) {
            $startDate = Carbon::today();
        }

        if (empty($endDate)) {
            $endDate = Carbon::now()->addHours($user->timezone);
        }

        $getMultiIps = Customer::select([
                'customer.id',
                'username',
                'last_login_ip_address',
                'user_id',
                'last_login_date',
                'customer.site_id'
            ])
            ->join('logs', function ($join) use ($startDate, $endDate, $user) {
                $join->on('logs.user_id', '!=', 'customer.id');
                $join->whereRaw('logs.ip_address = last_login_ip_address');
                $join->where('last_login_ip_address', '!=', '');
                $join->where('customer.site_id', $this->siteId);
                $join->where('logs.site_id', $this->siteId);
                $join->where('logs.user_id', '>', 0);
                //$join->where('customer.last_login_date', '>=', '2021-07-16 00:00:00');
                $join->whereRaw("CONVERT_TZ(CONCAT(customer.last_login_date), '+00:00','$user->timezone:00') >= '$startDate'");
                $join->whereRaw("CONVERT_TZ(CONCAT(customer.last_login_date), '+00:00','$user->timezone:00') <= '$endDate'");
            })
            ->orderBy('customer.username', 'ASC')
            ->groupBy(['last_login_ip_address'])
            ->paginate(25);

        # Data Optimization
        $getMultiIps->getCollection()->transform(function ($value) use ($user) {
            $getMultiAccounts = Log::countByMultiIp($value->site_id, $value->last_login_ip_address);

            $value['count'] = count($getMultiAccounts);
            $value['accounts'] = $getMultiAccounts;
            $value['last_login_date'] = $this->timezone($value->last_login_date, $user->timezone);

            return $value;
        });

        return response()->json(['status' => true, 'message' => 'success', 'list' => $getMultiIps]);
    }

    /**
     * @return JsonResponse
     */
    public function onlineCustomers(): JsonResponse
    {
        $user = auth()->user();
        $startDate = Carbon::now()->addMinutes('-2');
        $endDate = Carbon::now()->addMinutes('+2');

        $responseData = [
            'status' => true,
            'message' => 'success',
            'list' => []
        ];

        $getOnlineUsers = Customer::select([
            'id',
            'status',
            'balance',
            'currency',
            'create_date',
            'online_date',
            'name',
            'surname',
            'username',
            'tckimlik',
            'group_id',
            'affilate_id as affiliate_id'
        ])
            ->where('site_id', $this->siteId)
            ->where('online_date', '>', $startDate)
            ->where('online_date', '<', $endDate)
            ->orderBy('id', 'DESC')
            ->paginate(25);

        # Data Optimization
        $getOnlineUsers->getCollection()->transform(function ($value) use ($user) {
            $value['group_name'] = $value->group_id > 0 ? $value->group->name : null;
            $value['group_color'] = $value->group_id > 0 ? $value->group->color : null;
            $value['group_icon'] = $value->group_id > 0 ? $value->group->icon : null;
            $value['affiliate_name'] = $value->affilate_id > 0 ? $value->affiliate->username : null;
            $value['create_date'] = $this->timezone($value->create_date, $user->timezone);
            $value['online_date'] = $this->timezone($value->online_date, $user->timezone);
            return $value;
        });

        $responseData['list'] = $getOnlineUsers;

        return response()->json($responseData);
    }
}
