<?php
/**
 * Created by PhpStorm.
 * Filename: PaymentMethodsController.php
 * User: Orhan BAHAR
 * Date: 22.07.2021
 * Time: 00:30
 */

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\PaymentGroup;
use App\Models\PaymentMethod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentMethodsController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $methodType = $request->input('method_type');
        $sortKey = $request->input('sort_key');
        $sortValue = $request->input('sort_value');

        $getPaymentMethods = new PaymentMethod();
        $getPaymentMethods = $getPaymentMethods->select([
            'id',
            'form',
            'lang',
            'group_id',
            'description',
            'priority',
            'status',
            'deposit',
            'withdraw',
            'min_deposit',
            'min_withdraw',
            'max_deposit',
            'max_withdraw',
            'image',
            'fee',
            'time',
            'address',
            'blank',
            'session_id',
            'api_id',
            'api_key'
        ]);
        $getPaymentMethods = $getPaymentMethods->where('site_id', $this->siteId);

        if (!empty($methodType) && $methodType == 1) {
            $getPaymentMethods = $getPaymentMethods->where('deposit', 1);
        }

        if (!empty($methodType) && $methodType == 2) {
            $getPaymentMethods = $getPaymentMethods->where('withdraw', 1);
        }

        if (!empty($sortKey)) {
            $convertSort = filter_var($sortValue, FILTER_VALIDATE_BOOLEAN);

            if (!$convertSort)
                $sorting = 'ASC';
            else
                $sorting = 'DESC';

            $getPaymentMethods = $getPaymentMethods->orderBy($sortKey, $sorting);
        } else {
            $getPaymentMethods = $getPaymentMethods->orderBy('id', 'DESC');
        }

        $getPaymentMethods = $getPaymentMethods->get();

        if (!empty($getPaymentMethods)) {
            foreach ($getPaymentMethods as $paymentMethod) {
                $paymentMethod['group'] = [
                    'id' => $paymentMethod->group_id,
                    'name' => $paymentMethod->paymentGroup->{$paymentMethod->lang}
                ];

                $paymentMethod['form'] = json_decode($paymentMethod->form);

                unset($paymentMethod['paymentGroup']);
                unset($paymentMethod['group_id']);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'success',
            'list' => $getPaymentMethods
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function detail($id): JsonResponse
    {
        $getPaymentMethod = PaymentMethod::where('id', $id)
            ->where('site_id', $this->siteId)
            ->first();

        if (empty($getPaymentMethod))
            return response()->json([
                'status' => false,
                'message' => 'No data'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => [
                'id' => $getPaymentMethod->id,
                'form' => json_decode($getPaymentMethod->form),
                'lang' => $getPaymentMethod->lang,
                'description' => $getPaymentMethod->description,
                'priority' => $getPaymentMethod->priority,
                'status' => $getPaymentMethod->status,
                'deposit' => $getPaymentMethod->deposit,
                'withdraw' => $getPaymentMethod->withdraw,
                'min_deposit' => $getPaymentMethod->min_deposit,
                'min_withdraw' => $getPaymentMethod->min_withdraw,
                'max_deposit' => $getPaymentMethod->max_deposit,
                'max_withdraw' => $getPaymentMethod->max_withdraw,
                'image' => $getPaymentMethod->image,
                'fee' => $getPaymentMethod->fee,
                'time' => $getPaymentMethod->time,
                'address' => $getPaymentMethod->address,
                'blank' => $getPaymentMethod->blank,
                'session_id' => $getPaymentMethod->session_id,
                'api_id' => $getPaymentMethod->api_id,
                'api_key' => $getPaymentMethod->api_key,
                'group' => [
                    'id' => $getPaymentMethod->group_id,
                    'name' => $getPaymentMethod->paymentGroup->{$getPaymentMethod->lang} ?? null
                ]
            ]
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateStatus($id, Request $request): JsonResponse
    {
        $data = $request->only(
            'status'
        );

        $validator = Validator::make($data, [
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updatePaymentMethodStatus = PaymentMethod::where('id', $id)
            ->where('site_id', $this->siteId)
            ->update([
                'status' => $request->input('status')
            ]);

        if (!$updatePaymentMethodStatus)
            return response()->json([
                'status' => false,
                'message' => 'Payment method status not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Payment method status updated successfully'
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->only(
            'form',
            'lang',
            'group_id',
            'description',
            'deposit',
            'withdraw',
            'min_deposit',
            'min_withdraw',
            'max_deposit',
            'max_withdraw',
            'image',
            'fee',
            'time',
            'session_id',
            'api_id',
            'api_key',
            'blank',
            'priority'
        );

        $validator = Validator::make($data, [
            'lang' => 'string',
            'group_id' => 'required|integer',
            'description' => 'string',
            'deposit' => 'required|integer',
            'withdraw' => 'required|integer',
            'min_deposit' => 'required',
            'min_withdraw' => 'required',
            'max_deposit' => 'required',
            'max_withdraw' => 'required',
            'image' => 'string',
            'fee' => 'string',
            'time' => 'string',
            'session_id' => 'string',
            'api_id' => 'integer',
            'api_key' => 'string',
            'blank' => 'required|integer',
            'priority' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $createPaymentMethod = PaymentMethod::create([
            'site_id' => $this->siteId,
            'status' => 1,
            'form' => $request->input('form') ?? '',
            'lang' => $request->input('lang'),
            'group_id' => $request->input('group_id'),
            'description' => $request->input('description'),
            'deposit' => $request->input('deposit'),
            'withdraw' => $request->input('withdraw'),
            'min_deposit' => $request->input('min_deposit'),
            'min_withdraw' => $request->input('min_withdraw'),
            'max_deposit' => $request->input('max_deposit'),
            'max_withdraw' => $request->input('max_withdraw'),
            'image' => $request->input('image'),
            'fee' => $request->input('fee'),
            'time' => $request->input('time'),
            'address' => '',
            'session_id' => $request->input('session_id'),
            'api_id' => $request->input('api_id'),
            'api_key' => $request->input('api_key'),
            'blank' => $request->input('blank'),
            'priority' => $request->input('priority')
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Payment method created successfully',
            'detail' => $createPaymentMethod
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
            'form',
            'lang',
            'group_id',
            'description',
            'deposit',
            'withdraw',
            'min_deposit',
            'min_withdraw',
            'max_deposit',
            'max_withdraw',
            'image',
            'fee',
            'time',
            'session_id',
            'api_id',
            'api_key',
            'blank',
            'status',
            'priority'
        );

        $validator = Validator::make($data, [
            'lang' => 'string',
            'group_id' => 'required|integer',
            'description' => 'string',
            'deposit' => 'required|integer',
            'withdraw' => 'required|integer',
            'min_deposit' => 'required',
            'min_withdraw' => 'required',
            'max_deposit' => 'required',
            'max_withdraw' => 'required',
            'image' => 'string',
            'fee' => 'string',
            'time' => 'string',
            'session_id' => 'string',
            'api_id' => 'integer',
            'api_key' => 'string',
            'blank' => 'required|integer',
            'status' => 'required|integer',
            'priority' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updatePaymentMethod = PaymentMethod::where('id', $id)
            ->where('site_id', $this->siteId)
            ->update([
                'site_id' => $this->siteId,
                'status' => $request->input('status'),
                'form' => $request->input('form') ?? '',
                'lang' => $request->input('lang'),
                'group_id' => $request->input('group_id'),
                'description' => $request->input('description'),
                'deposit' => $request->input('deposit'),
                'withdraw' => $request->input('withdraw'),
                'min_deposit' => $request->input('min_deposit'),
                'min_withdraw' => $request->input('min_withdraw'),
                'max_deposit' => $request->input('max_deposit'),
                'max_withdraw' => $request->input('max_withdraw'),
                'image' => $request->input('image'),
                'fee' => $request->input('fee'),
                'time' => $request->input('time'),
                'session_id' => $request->input('session_id'),
                'api_id' => $request->input('api_id'),
                'api_key' => $request->input('api_key'),
                'blank' => $request->input('blank'),
                'priority' => $request->input('priority')
            ]);

        if (!$updatePaymentMethod)
            return response()->json([
                'status' => false,
                'message' => 'Payment method not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Payment method updated successfully'
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function groups(): JsonResponse
    {
        $getPaymentGroups = PaymentGroup::all();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'list' => $getPaymentGroups
        ]);
    }
}
