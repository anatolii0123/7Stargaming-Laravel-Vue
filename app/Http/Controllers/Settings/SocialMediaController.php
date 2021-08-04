<?php
/**
 * Created by PhpStorm.
 * Filename: SocialMediaController.php
 * User: Orhan BAHAR
 * Date: 21.07.2021
 * Time: 18:58
 */

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialMediaController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $getSocialMedia = Site::select([
            'facebook',
            'twitter',
            'youtube',
            'instagram',
            'pinterest',
            'whatsapp',
            'telegram',
            'messenger'
        ])
            ->where('id', $this->siteId)
            ->first();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => $getSocialMedia
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $data = $request->only(
            'facebook',
            'twitter',
            'youtube',
            'instagram',
            'pinterest',
            'whatsapp',
            'telegram',
            'messenger'
        );

        $validator = Validator::make($data, [
            'facebook' => 'string',
            'twitter' => 'string',
            'youtube' => 'string',
            'instagram' => 'string',
            'pinterest' => 'string',
            'whatsapp' => 'string',
            'telegram' => 'string',
            'messenger' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updateSocialMedia = Site::where('id', $this->siteId)
            ->update([
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'youtube' => $request->input('youtube'),
                'instagram' => $request->input('instagram'),
                'pinterest' => $request->input('pinterest'),
                'whatsapp' => $request->input('whatsapp'),
                'telegram' => $request->input('telegram'),
                'messenger' => $request->input('messenger')
            ]);

        if (!$updateSocialMedia)
            return response()->json([
                'status' => false,
                'message' => 'Social media not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Social media updated successfully'
        ]);
    }
}
