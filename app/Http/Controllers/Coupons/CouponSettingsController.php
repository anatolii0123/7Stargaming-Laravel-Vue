<?php
/**
 * Created by PhpStorm.
 * Filename: CouponSettingsController.php
 * User: Orhan BAHAR
 * Date: 22.07.2021
 * Time: 11:22
 */

namespace App\Http\Controllers\Coupons;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\SiteLimit;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponSettingsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $getSiteCouponSettings = Site::select([
            'live_football_close',
            'odds_balance',
            'live_coupon_wait',
            'cashout',
            'cashout_status'
        ])
            ->where('id', $this->siteId)
            ->first();

        if (empty($getSiteCouponSettings))
            return response()->json([
                'status' => false,
                'message' => 'No data'
            ]);

        $getSiteLimits = SiteLimit::where('site_id', $this->siteId)->first();

        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => [
                'settings' => [
                    'odds_balance' => $getSiteCouponSettings->odds_balance,
                    'live_coupon_waiting' => $getSiteCouponSettings->live_coupon_wait,
                    'live_football_close' => $getSiteCouponSettings->live_football_close,
                    'cashout' => [
                        'commission' => $getSiteCouponSettings->cashout,
                        'status' => $getSiteCouponSettings->cashout_status
                    ]
                ],
                'limits' => [
                    'pre_match' => [
                        'min_coupon_amount' => $getSiteLimits->pre_min_coupon ?? null,
                        'max_coupon_amount' => $getSiteLimits->pre_max_coupon ?? null,
                        'max_coupon_earning' => $getSiteLimits->pre_max_win ?? null,
                        'max_bet_event' => $getSiteLimits->pre_max_event ?? null,
                        'max_bet_league' => $getSiteLimits->pre_max_league ?? null,
                        'max_bet_odd_type' => $getSiteLimits->pre_max_oddtype ?? null,
                        'min_single_odd' => $getSiteLimits->pre_min_single_odd ?? null,
                        'min_combine_odd' => $getSiteLimits->pre_min_combine_odd ?? null,
                        'min_combine_single_odd' => $getSiteLimits->pre_min_combine_single_odd ?? null,
                        'max_combine_event' => $getSiteLimits->pre_max_combine_event ?? null
                    ],
                    'live' => [
                        'min_coupon_amount' => $getSiteLimits->live_min_coupon ?? null,
                        'max_coupon_amount' => $getSiteLimits->live_max_coupon ?? null,
                        'max_coupon_earning' => $getSiteLimits->live_max_win ?? null,
                        'max_bet_event' => $getSiteLimits->live_max_event ?? null,
                        'max_bet_league' => $getSiteLimits->live_max_league ?? null,
                        'max_bet_odd_type' => $getSiteLimits->live_max_oddtype ?? null,
                        'min_single_odd' => $getSiteLimits->live_min_single_odd ?? null,
                        'min_combine_odd' => $getSiteLimits->live_min_combine_odd ?? null,
                        'min_combine_single_odd' => $getSiteLimits->live_min_combine_single_odd ?? null,
                        'max_combine_event' => $getSiteLimits->live_max_combine_event ?? null
                    ],
                ]
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
            'odds_balance',
            'live_coupon_waiting',
            'live_football_close',
            'cashout_commission',
            'cashout_status',
            'pre_min_coupon_amount',
            'pre_max_coupon_amount',
            'pre_max_coupon_earning',
            'pre_max_bet_event',
            'pre_max_bet_league',
            'pre_max_bet_odd_type',
            'pre_min_single_odd',
            'pre_min_combine_odd',
            'pre_min_combine_single_odd',
            'pre_max_combine_event',
            'live_min_coupon_amount',
            'live_max_coupon_amount',
            'live_max_coupon_earning',
            'live_max_bet_event',
            'live_max_bet_league',
            'live_max_bet_odd_type',
            'live_min_single_odd',
            'live_min_combine_odd',
            'live_min_combine_single_odd',
            'live_max_combine_event'
        );

        $validator = Validator::make($data, [
            'odds_balance' => 'required',
            'live_coupon_waiting' => 'required',
            'live_football_close' => 'required',
            'cashout_commission' => 'required',
            'cashout_status' => 'required|integer',
            'pre_min_coupon_amount' => 'required',
            'pre_max_coupon_amount' => 'required',
            'pre_max_coupon_earning' => 'required',
            'pre_max_bet_event' => 'required',
            'pre_max_bet_league' => 'required',
            'pre_max_bet_odd_type' => 'required',
            'pre_min_single_odd' => 'required',
            'pre_min_combine_odd' => 'required',
            'pre_min_combine_single_odd' => 'required',
            'pre_max_combine_event' => 'required',
            'live_min_coupon_amount' => 'required',
            'live_max_coupon_amount' => 'required',
            'live_max_coupon_earning' => 'required',
            'live_max_bet_event' => 'required',
            'live_max_bet_league' => 'required',
            'live_max_bet_odd_type' => 'required',
            'live_min_single_odd' => 'required',
            'live_min_combine_odd' => 'required',
            'live_min_combine_single_odd' => 'required',
            'live_max_combine_event' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        # Coupon Settings Update
        Site::where('id', $this->siteId)
            ->update([
                'odds_balance' => $request->input('odds_balance'),
                'live_coupon_wait' => $request->input('live_coupon_waiting'),
                'live_football_close' => $request->input('live_football_close'),
                'cashout' => $request->input('cashout_commission'),
                'cashout_status' => $request->input('cashout_status'),
            ]);

        $checkSiteLimit = SiteLimit::where('site_id', $this->siteId)->first();

        if (!empty($checkSiteLimit)) {
            SiteLimit::where('id', $checkSiteLimit->id)
                ->where('site_id', $this->siteId)
                ->update([
                    'pre_min_coupon' => $request->input('pre_min_coupon_amount'),
                    'pre_max_coupon' => $request->input('pre_max_coupon_amount'),
                    'pre_max_win' => $request->input('pre_max_coupon_earning'),
                    'pre_max_event' => $request->input('pre_max_bet_event'),
                    'pre_max_league' => $request->input('pre_max_bet_league'),
                    'pre_max_oddtype' => $request->input('pre_max_bet_odd_type'),
                    'pre_min_single_odd' => $request->input('pre_min_single_odd'),
                    'pre_min_combine_odd' => $request->input('pre_min_combine_odd'),
                    'pre_min_combine_single_odd' => $request->input('pre_min_combine_single_odd'),
                    'pre_max_combine_event' => $request->input('pre_max_combine_event'),
                    'live_min_coupon' => $request->input('live_min_coupon_amount'),
                    'live_max_coupon' => $request->input('live_max_coupon_amount'),
                    'live_max_win' => $request->input('live_max_coupon_earning'),
                    'live_max_event' => $request->input('live_max_bet_event'),
                    'live_max_league' => $request->input('live_max_bet_league'),
                    'live_max_oddtype' => $request->input('live_max_bet_odd_type'),
                    'live_min_single_odd' => $request->input('live_min_single_odd'),
                    'live_min_combine_odd' => $request->input('live_min_combine_odd'),
                    'live_min_combine_single_odd' => $request->input('live_min_combine_single_odd'),
                    'live_max_combine_event' => $request->input('live_max_combine_event')
                ]);
        } else {
            SiteLimit::create([
                'site_id' => $this->siteId,
                'pre_min_coupon' => $request->input('pre_min_coupon_amount'),
                'pre_max_coupon' => $request->input('pre_max_coupon_amount'),
                'pre_max_win' => $request->input('pre_max_coupon_earning'),
                'pre_max_event' => $request->input('pre_max_bet_event'),
                'pre_max_league' => $request->input('pre_max_bet_league'),
                'pre_max_oddtype' => $request->input('pre_max_bet_odd_type'),
                'pre_min_single_odd' => $request->input('pre_min_single_odd'),
                'pre_min_combine_odd' => $request->input('pre_min_combine_odd'),
                'pre_min_combine_single_odd' => $request->input('pre_min_combine_single_odd'),
                'pre_max_combine_event' => $request->input('pre_max_combine_event'),
                'live_min_coupon' => $request->input('live_min_coupon_amount'),
                'live_max_coupon' => $request->input('live_max_coupon_amount'),
                'live_max_win' => $request->input('live_max_coupon_earning'),
                'live_max_event' => $request->input('live_max_bet_event'),
                'live_max_league' => $request->input('live_max_bet_league'),
                'live_max_oddtype' => $request->input('live_max_bet_odd_type'),
                'live_min_single_odd' => $request->input('live_min_single_odd'),
                'live_min_combine_odd' => $request->input('live_min_combine_odd'),
                'live_min_combine_single_odd' => $request->input('live_min_combine_single_odd'),
                'live_max_combine_event' => $request->input('live_max_combine_event')
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Coupon settings updated successfully'
        ]);
    }
}
