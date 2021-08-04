<?php
/**
 * Created by PhpStorm.
 * Filename: SearchController.php
 * User: Orhan BAHAR
 * Date: 21.07.2021
 * Time: 12:35
 */

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Promotion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $q = $request->input('q');
        $data = [];
        $totalCount = 0;

        # Customers
        $getCustomers = Customer::where(function ($query) use ($q) {
            $query->where('username', 'LIKE', '%' . $q . '%')
                ->orWhere('id', $q)
                ->orWhere('name', 'LIKE', '%' . $q . '%')
                ->orWhere('surname', 'LIKE', '%' . $q . '%')
                ->orWhere('last_login_ip_address', 'LIKE', '%' . $q . '%')
                ->orWhere('email', 'LIKE', '%' . $q . '%')
                ->orWhere('tckimlik', 'LIKE', '%' . $q . '%');
        })
            ->where('site_id', $this->siteId)
            ->limit(10)
            ->get();

        $customerData = [];
        foreach ($getCustomers as $customer) {
            $customerData[] = [
                'url' => '/users/' . $customer->id . '/detail',
                'text' => $customer->username . ' - ' . $customer->name . ' ' . $customer->surname
            ];
        }

        if (count($getCustomers) > 0) {
            $data[] = [
                'text' => 'Customers',
                'children' => $customerData
            ];
        }

        # Coupons
        $getCoupons = Coupon::where('id', $q)->where('site_id', $this->siteId)->limit(10)->get();
        $couponData = [];

        foreach ($getCoupons as $coupon) {
            $couponData[] = [
                'id' => '/coupons/list',
                'parameters' => [
                    'id' => $coupon->id
                ],
                'text' => '#' . $coupon->id . ' - ' . ($coupon->customer->username ?? null)
            ];
        }

        if (count($getCoupons) > 0) {
            $data[] = [
                'text' => 'Coupons',
                'children' => $couponData
            ];
        }

        # Bank Accounts

        # Transactions

        # Pages
        $pageData = [];
        $getPages = Content::where('site_id', $this->siteId)
            ->where('name', 'LIKE', '%' . $q . '%')
            ->limit(10)
            ->get();

        foreach ($getPages as $page) {
            $pageData[] = [
                'id' => '/web-management/pages/' . $page->id . '/update',
                'text' => $page->name
            ];
        }

        if (count($getPages) > 0) {
            $data[] = [
                'text' => 'Pages',
                'children' => $pageData
            ];
        }

        # Promotions
        $promotionData = [];
        $getPromotions = Promotion::where('site_id', $this->siteId)
            ->where('name', 'LIKE', '%' . $q . '%')
            ->limit(10)
            ->get();

        foreach ($getPromotions as $promotion) {
            $promotionData[] = [
                'id' => '/web-management/promotions/' . $promotion->id . '/update',
                'text' => $promotion->name
            ];
        }

        if (count($getPromotions) > 0) {
            $data[] = [
                'text' => 'Promotions',
                'children' => $promotionData
            ];
        }

        # Logs

        return response()->json([
            'status' => true,
            'message' => 'success',
            'results' => $data,
            'total_count' => $totalCount
        ]);
    }
}
