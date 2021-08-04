<?php
/**
 * Created by PhpStorm.
 * Filename: GameProviderController.php
 * User: Orhan BAHAR
 * Date: 28.07.2021
 * Time: 13:36
 */

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\GameProvider;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameProviderController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $type = $request->input('type');
        $siteProviders = Site::select('provider_list')->where('id', $this->siteId)->first();

        if (!empty($type)) {
            $getProviders = GameProvider::where('type', $type)->where('status', 1)->get();
        } else {
            $getProviders = GameProvider::where('status', 1)->get();
        }

        $dataResponse = [];
        foreach ($getProviders as $provider) {
            $dataResponse[] = [
                'main_provider' => $provider->main_provider,
                'name' => $provider->name,
                'code' => $provider->code,
                'logo' => $provider->logo,
                'type' => $provider->type,
                'status' => $this->checkStatusProviderBySite(
                    $siteProviders->provider_list,
                    $provider->code,
                    $provider->type
                )
            ];
        }

        return response()->json([
            'status' => true,
            'message' => 'success',
            'list' => $dataResponse
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $code = $request->input('code');
        $type = $request->input('type');
        $status = $request->input('status');
        $data = $request->only(
            'code',
            'type'
        );

        $validator = Validator::make($data, [
            'code' => 'required|string',
            'type' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        # Get Providers By Site
        $siteProviders = Site::select('provider_list')->where('id', $this->siteId)->first();

        # JSON Converter
        $json = json_decode($siteProviders->provider_list, true);

        # List Providers and Match Data
        foreach ($json as $key => $value) {
            if ($value['provider'] == $code && $value['live'] == $type) {
                if ($status == 0)
                    unset($json[$key]);
            }
        }

        # Add Provider
        if ($status == 1) {
            $json[] = [
                'live' => $type,
                'main_provider' => 'BetAPI',
                'provider' => $code
            ];
        }

        $updateGameProvider = Site::where('id', $this->siteId)
            ->update([
                'provider_list' => json_encode($json)
            ]);

        if (!$updateGameProvider)
            return response()->json([
                'status' => false,
                'message' => 'Game provider not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Game provider updated successfully'
        ]);
    }

    /**
     * @param $data
     * @param $code
     * @param $type
     * @return int
     */
    private function checkStatusProviderBySite($data, $code, $type): int
    {
        $json = json_decode($data);

        foreach ($json as $value) {
            if ($value->provider == $code && $value->live == $type) {
                return 1;
            }
        }

        return 0;
    }
}
