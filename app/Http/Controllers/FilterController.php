<?php
/**
 * Created by PhpStorm.
 * Filename: FilterController.php
 * User: Orhan BAHAR
 * Date: 14.07.2021
 * Time: 03:00
 */

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\CustomerGroup;
use App\Models\Log;
use Illuminate\Http\JsonResponse;

class FilterController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function affiliates(): JsonResponse
    {
        if (auth()->check()) {
            $getAffiliates = Affiliate::select([
                'id',
                'username',
            ])
                ->where('site_id', $this->siteId)
                ->where('status', 1)
                ->get();

            if ($getAffiliates) {
                $responseData = [
                    'status' => true,
                    'message' => 'success',
                    'list' => $getAffiliates
                ];
            } else {
                $responseData = [
                    'status' => false,
                    'message' => 'no data',
                    'list' => []
                ];
            }

            return response()->json($responseData);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * @return JsonResponse
     */
    public function customerGroups(): JsonResponse
    {
        if (auth()->check()) {
            $getCustomerGroups = CustomerGroup::select([
                'id',
                'name',
            ])
                ->where('site_id', $this->siteId)
                ->get();

            if ($getCustomerGroups) {
                $responseData = [
                    'status' => true,
                    'message' => 'success',
                    'list' => $getCustomerGroups
                ];
            } else {
                $responseData = [
                    'status' => false,
                    'message' => 'no data',
                    'list' => []
                ];
            }

            return response()->json($responseData);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * @return JsonResponse
     */
    public function customerLogsType(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'success',
            'list' => Log::select('type')->groupBy('type')->get()
        ]);
    }
}
