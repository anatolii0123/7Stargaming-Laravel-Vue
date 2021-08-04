<?php
/**
 * Created by PhpStorm.
 * Filename: CustomCssController.php
 * User: Orhan BAHAR
 * Date: 21.07.2021
 * Time: 18:17
 */

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomCssController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $getCustomCss = Site::select([
            'custom_css_web as web',
            'custom_css_mobile as mobile'
        ])
            ->where('id', $this->siteId)
            ->first();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => [
                'web' => html_entity_decode($getCustomCss->web, ENT_QUOTES),
                'mobile' => html_entity_decode($getCustomCss->mobile, ENT_QUOTES)
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

        $updateCustomCss = Site::where('id', $this->siteId)
            ->update([
                'custom_css_web' => htmlentities($request->input('web'), ENT_QUOTES),
                'custom_css_mobile' => htmlentities($request->input('mobile'), ENT_QUOTES)
            ]);

        if (!$updateCustomCss)
            return response()->json([
                'status' => false,
                'message' => 'Custom css not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Custom css updated successfully'
        ]);
    }
}
