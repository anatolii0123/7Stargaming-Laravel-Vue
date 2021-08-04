<?php
/**
 * Created by PhpStorm.
 * Filename: CustomJsController.php
 * User: Orhan BAHAR
 * Date: 21.07.2021
 * Time: 18:46
 */

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomJsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $getCustomJs = Site::select([
            'custom_js_web as web',
            'custom_js_mobile as mobile'
        ])
            ->where('id', $this->siteId)
            ->first();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => [
                'web' => html_entity_decode($getCustomJs->web, ENT_QUOTES),
                'mobile' => html_entity_decode($getCustomJs->mobile, ENT_QUOTES)
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $data = $request->only(
            'web',
            'mobile'
        );

        $validator = Validator::make($data, [
            'web' => 'string',
            'mobile' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updateCustomJs = Site::where('id', $this->siteId)
            ->update([
                'custom_js_web' => htmlentities($request->input('web'), ENT_QUOTES),
                'custom_js_mobile' => htmlentities($request->input('mobile'), ENT_QUOTES)
            ]);

        if (!$updateCustomJs)
            return response()->json([
                'status' => false,
                'message' => 'Custom javascript not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Custom javascript updated successfully'
        ]);
    }
}
