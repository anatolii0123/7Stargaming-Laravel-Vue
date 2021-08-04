<?php
/**
 * Created by PhpStorm.
 * Filename: CurrencyController.php
 * User: Orhan BAHAR
 * Date: 26.07.2021
 * Time: 18:42
 */

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\SiteCurrency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $dataResponse = [];
        $getCurrencies = SiteCurrency::where('site_id', $this->siteId)->get();

        foreach ($getCurrencies as $currency) {
            $currencyDetail = $currency->currencies;

            $dataResponse[] = [
                'id' => $currency->id,
                'name' => $currencyDetail->name,
                'code' => $currency->currency,
                'symbol' => $currencyDetail->symbol,
                'format' => $currencyDetail->format,
                'exchange_rate' => $currencyDetail->exchange_rate,
                'status' => $currency->status
            ];
        }

        return response()->json([
            'status' => true,
            'message' => 'success',
            'list' => $dataResponse
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function availableCurrencies(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'success',
            'list' => currency()->getActiveCurrencies()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->only(
            'currency'
        );

        $validator = Validator::make($data, [
            'currency' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $existCurrency = SiteCurrency::where('site_id', $this->siteId)
            ->where('currency', $request->input('currency'))
            ->count();

        if ($existCurrency > 0)
            return response()->json([
                'status' => false,
                'message' => 'This currency already exists.'
            ]);

        $createCurrency = SiteCurrency::create([
            'site_id' => $this->siteId,
            'currency' => $request->input('currency'),
            'status' => 1
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Currency created successfully',
            'detail' => $createCurrency
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
            'status'
        );

        $validator = Validator::make($data, [
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updateCurrency = SiteCurrency::where('id', $id)
            ->where('site_id', $this->siteId)
            ->update([
                'status' => $request->input('status')
            ]);

        if (!$updateCurrency)
            return response()->json([
                'status' => false,
                'message' => 'Currency not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Currency updated successfully'
        ]);
    }
}
