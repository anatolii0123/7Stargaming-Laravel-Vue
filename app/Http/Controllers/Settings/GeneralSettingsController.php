<?php
/**
 * Created by PhpStorm.
 * Filename: GeneralSettingsController.php
 * User: Orhan BAHAR
 * Date: 22.07.2021
 * Time: 11:57
 */

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralSettingsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $getGeneralSettings = Site::select([
            'name',
            'title',
            'address',
            'description',
            'keywords',
            'timezone',
            'multilang as multi_lang_status',
            'email',
            'auto_forwading as auto_forwarding',
            'home_forwading as home_forwarding',
            'lang',
            'currency',
            'logo_url',
            'favicon_url',
            'https as ssl_status',
            'bettingstatus as betting_status',
            'casinostatus as casino_status',
            'slotstatus as slot_status',
            'newcustomerbettingstatus as new_customer_betting_status',
            'newcustomercasinostatus as new_customer_casino_status',
            'newcustomerslotstatus as new_customer_slot_status',
            'betslip_logo_url',
            'betslip_signature'
        ])
            ->where('id', $this->siteId)
            ->first();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => $getGeneralSettings
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $data = $request->only(
            'name',
            'title',
            'address',
            'description',
            'keywords',
            'timezone',
            'multi_lang_status',
            'email',
            'auto_forwarding',
            'home_forwarding',
            'lang',
            'currency',
            'logo_url',
            'favicon_url',
            'ssl_status',
            'betting_status',
            'casino_status',
            'slot_status',
            'new_customer_betting_status',
            'new_customer_casino_status',
            'new_customer_slot_status',
            'betslip_logo_url',
            'betslip_signature'
        );

        $validator = Validator::make($data, [
            'name' => 'required',
            'title' => 'required',
            'address' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'timezone' => 'required',
            'multi_lang_status' => 'required|integer',
            'email' => 'required',
            'auto_forwarding' => 'integer',
            'lang' => 'required',
            'currency' => 'required',
            'logo_url' => 'required',
            'favicon_url' => 'required',
            'ssl_status' => 'required|integer',
            'betting_status' => 'required|integer',
            'casino_status' => 'required|integer',
            'slot_status' => 'required|integer',
            'new_customer_betting_status' => 'required|integer',
            'new_customer_casino_status' => 'required|integer',
            'new_customer_slot_status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updateGeneralSettings = Site::where('id', $this->siteId)
            ->update([
                'name' => $request->input('name'),
                'title' => $request->input('title'),
                'address' => $request->input('address'),
                'description' => $request->input('description'),
                'keywords' => $request->input('keywords'),
                'timezone' => $request->input('timezone'),
                'multilang' => $request->input('multi_lang_status'),
                'email' => $request->input('email'),
                'auto_forwading' => $request->input('auto_forwarding'),
                'home_forwading' => $request->input('home_forwarding') ?? '',
                'lang' => $request->input('lang'),
                'currency' => $request->input('currency'),
                'logo_url' => $request->input('logo_url'),
                'favicon_url' => $request->input('favicon_url'),
                'https' => $request->input('ssl_status'),
                'bettingstatus' => $request->input('betting_status'),
                'casinostatus' => $request->input('casino_status'),
                'slotstatus' => $request->input('slot_status'),
                'newcustomerbettingstatus' => $request->input('new_customer_betting_status'),
                'newcustomercasinostatus' => $request->input('new_customer_casino_status'),
                'newcustomerslotstatus' => $request->input('new_customer_slot_status'),
                'betslip_logo_url' => $request->input('betslip_logo_url') ?? '',
                'betslip_signature' => $request->input('betslip_signature') ?? ''
            ]);

        if (!$updateGeneralSettings)
            return response()->json([
                'status' => false,
                'message' => 'General settings not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'General settings updated successfully'
        ]);
    }
}
