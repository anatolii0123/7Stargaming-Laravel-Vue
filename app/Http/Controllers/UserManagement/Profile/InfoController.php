<?php
/**
 * Created by PhpStorm.
 * Filename: InfoController.php
 * User: Orhan BAHAR
 * Date: 26.07.2021
 * Time: 23:05
 */

namespace App\Http\Controllers\UserManagement\Profile;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Log;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;

class InfoController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     */
    public function index($id): JsonResponse
    {
        $checkCustomer = Customer::where('id', $id)->where('site_id', $this->siteId)->first();

        if (empty($checkCustomer))
            return response()->json([
                'status' => false,
                'message' => 'no have customer'
            ]);

        $groupDetail = $checkCustomer->group ?? null;
        $getMultiAccounts = Log::countByMultiIp($checkCustomer->site_id, $checkCustomer->last_login_ip_address);

        $dataResponse = [
            'id' => $checkCustomer->id,
            'first_name' => $checkCustomer->name,
            'last_name' => $checkCustomer->surname,
            'username' => $checkCustomer->username,
            'balance' => $checkCustomer->balance,
            'currency' => $checkCustomer->currency,
            'group' => [
                'id' => $groupDetail->id ?? null,
                'name' => $groupDetail->name ?? null,
                'color' => $groupDetail->color ?? null,
                'icon' => $groupDetail->icon ?? null,
            ],
            'multi_ip' => [
                'count' => count($getMultiAccounts),
                'accounts' => $getMultiAccounts
            ],
            'identity_verification' => $checkCustomer->confirm_tckimlik,
            'phone_verification' => $checkCustomer->confirm_phone,
            'document_verification' => $checkCustomer->confirm_document,
            'email_verification' => $checkCustomer->confirm_email
        ];

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => $dataResponse
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function information($id): JsonResponse
    {
        $checkCustomer = Customer::where('id', $id)->where('site_id', $this->siteId)->first();

        if (empty($checkCustomer))
            return response()->json([
                'status' => false,
                'message' => 'no have customer'
            ]);

        $groupDetail = $checkCustomer->group ?? null;
        $affiliateDetail = $checkCustomer->affiliate ?? null;
        $lastDeposit = Transaction::getLastDepositForCustomer($this->siteId, $checkCustomer->id);
        $lastWithdraw = Transaction::getLastWithdrawForCustomer($this->siteId, $checkCustomer->id);

        $dataResponse = [
            'id' => $checkCustomer->id,
            'first_name' => $checkCustomer->name,
            'last_name' => $checkCustomer->surname,
            'username' => $checkCustomer->username,
            'balance' => $checkCustomer->balance,
            'currency' => $checkCustomer->currency,
            'status' => $checkCustomer->status,
            'email' => $checkCustomer->email,
            'gender' => $checkCustomer->gender,
            'birthday' => $checkCustomer->birthday,
            'country' => $checkCustomer->country,
            'phone_number' => $checkCustomer->phone_number,
            'city' => $checkCustomer->city,
            'address' => $checkCustomer->address,
            'identity_number' => $checkCustomer->tckimlik,
            'online_date' => $checkCustomer->online_date,
            'create_date' => $checkCustomer->create_date,
            'last_login_date' => $checkCustomer->last_login_date,
            'last_login_ip_address' => $checkCustomer->last_login_ip_address,
            'group' => [
                'id' => $groupDetail->id ?? null,
                'name' => $groupDetail->name ?? null,
                'color' => $groupDetail->color ?? null,
                'icon' => $groupDetail->icon ?? null,
            ],
            'affiliate' => [
                'id' => $affiliateDetail->id ?? null,
                'username' => $affiliateDetail->username ?? null
            ],
            'identity_verification' => $checkCustomer->confirm_tckimlik,
            'phone_verification' => $checkCustomer->confirm_phone,
            'document_verification' => $checkCustomer->confirm_document,
            'email_verification' => $checkCustomer->confirm_email,
            'main_vault_cycle' => 0,
            'bonus_cycle' => 0,
            'last_deposit' => [
                'amount' => $lastDeposit->amount ?? null,
                'date' => $lastDeposit->date ?? null
            ],
            'last_withdraw' => [
                'amount' => $lastWithdraw->amount ?? null,
                'date' => $lastWithdraw->date ?? null
            ],
        ];

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => $dataResponse
        ]);
    }
}
