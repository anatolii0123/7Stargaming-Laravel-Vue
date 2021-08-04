<?php
/**
 * Created by PhpStorm.
 * Filename: CustomerGroupsController.php
 * User: Orhan BAHAR
 * Date: 21.07.2021
 * Time: 18:49
 */

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\CustomerGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerGroupsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function customerGroups(): JsonResponse
    {
        $responseData = [
            'status' => true,
            'message' => 'success',
            'list' => []
        ];

        $getCustomerGroups = CustomerGroup::select([
            'id',
            'name',
            'status',
            'color',
            'icon',
            'locked',
            'note',
            'deposit_floor',
            'deposit_discount_access',
            'withdraw_amount',
            'withdraw_discount_remove',
            'discount_day',
            'discount_floor'
        ])
            ->where('site_id', $this->siteId)
            ->where('status', 1)
            ->get();

        $responseData['list'] = $getCustomerGroups;

        return response()->json($responseData);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getCustomerGroup($id): JsonResponse
    {
        $responseData = [
            'status' => true,
            'message' => 'success',
            'list' => []
        ];

        $geCustomerGroup = CustomerGroup::select([
            'id',
            'name',
            'status',
            'color',
            'icon',
            'locked',
            'note',
            'deposit_floor',
            'deposit_discount_access',
            'withdraw_amount',
            'withdraw_discount_remove',
            'discount_day',
            'discount_floor'
        ])
            ->where('id', $id)
            ->where('site_id', $this->siteId)
            ->where('status', 1)
            ->first();

        $responseData['list'] = $geCustomerGroup;

        return response()->json($responseData);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeCustomerGroup(Request $request): JsonResponse
    {
        $data = $request->only(
            'name',
            'status',
            'note',
            'color',
            'icon',
            'deposit_floor',
            'deposit_discount_access',
            'withdraw_amount',
            'withdraw_discount_remove',
            'discount_day',
            'discount_floor'
        );

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'note' => 'required|string',
            'color' => 'required|string',
            'icon' => 'required|string',
            'deposit_floor' => 'required|integer',
            'deposit_discount_access' => 'required|integer',
            'withdraw_amount' => 'required',
            'withdraw_discount_remove' => 'required|integer',
            'discount_day' => 'required|integer',
            'discount_floor' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $createCustomerGroup = CustomerGroup::create([
            'site_id' => $this->siteId,
            'name' => $request->input('name'),
            'color' => $request->input('color'),
            'icon' => $request->input('icon'),
            'note' => $request->input('note'),
            'status' => 1,
            'deposit_floor' => $request->input('deposit_floor'),
            'deposit_discount_access' => $request->input('deposit_discount_access'),
            'withdraw_amount' => $request->input('withdraw_amount'),
            'withdraw_discount_remove' => $request->input('withdraw_discount_remove'),
            'discount_day' => $request->input('discount_day'),
            'discount_floor' => $request->input('discount_floor'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer group created successfully',
            'detail' => $createCustomerGroup
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateCustomerGroup($id, Request $request): JsonResponse
    {
        $data = $request->only(
            'name',
            'status',
            'note',
            'color',
            'icon',
            'deposit_floor',
            'deposit_discount_access',
            'withdraw_amount',
            'withdraw_discount_remove',
            'discount_day',
            'discount_floor'
        );

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'note' => 'required|string',
            'color' => 'required|string',
            'icon' => 'required|string',
            'deposit_floor' => 'required|integer',
            'deposit_discount_access' => 'required|integer',
            'withdraw_amount' => 'required|integer',
            'withdraw_discount_remove' => 'required|integer',
            'discount_day' => 'required|integer',
            'discount_floor' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updateCustomerGroup = CustomerGroup::where('id', $id)
            ->where('site_id', $this->siteId)
            ->update([
                'name' => $request->input('name'),
                'color' => $request->input('color'),
                'icon' => $request->input('icon'),
                'note' => $request->input('note'),
                'status' => 1,
                'deposit_floor' => $request->input('deposit_floor'),
                'deposit_discount_access' => $request->input('deposit_discount_access'),
                'withdraw_amount' => $request->input('withdraw_amount'),
                'withdraw_discount_remove' => $request->input('withdraw_discount_remove'),
                'discount_day' => $request->input('discount_day'),
                'discount_floor' => $request->input('discount_floor'),
            ]);

        # Check if update for customer group
        if (!$updateCustomerGroup)
            return response()->json([
                'status' => false,
                'message' => 'Customer group not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer group updated successfully'
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteCustomerGroup($id): JsonResponse
    {
        $deleteCustomerGroup = CustomerGroup::where('id', $id)
            ->where('site_id', $this->siteId)
            ->update([
                'status' => 0
            ]);

        # Check if delete for customer group
        if (!$deleteCustomerGroup)
            return response()->json([
                'status' => false,
                'message' => 'Customer group not deleted'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer group deleted successfully'
        ]);
    }
}
