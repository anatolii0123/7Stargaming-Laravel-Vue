<?php
/**
 * Created by PhpStorm.
 * Filename: SiteController.php
 * User: Orhan BAHAR
 * Date: 13.07.2021
 * Time: 18:42
 */

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Site;

class SiteController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getLimits(): JsonResponse
    {
        if (auth()->check()) {
            $getSiteInfo = Site::select([
                'id',
                'currency',
                'sportlimit',
                'slotlimit',
                'casinolimit'
            ])->where('id', $this->siteId)->first();

            $responseData = [
                'currency' => (string)$getSiteInfo->currency,
                'sport' => (double)$getSiteInfo->sportlimit,
                'slot' => (double)$getSiteInfo->slotlimit,
                'casino' => (double)$getSiteInfo->casinolimit
            ];

            return response()->json($responseData);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
