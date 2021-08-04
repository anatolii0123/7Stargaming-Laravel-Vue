<?php
/**
 * Created by PhpStorm.
 * Filename: ChartController.php
 * User: Orhan BAHAR
 * Date: 27.07.2021
 * Time: 15:49
 */

namespace App\Http\Controllers\UserManagement\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ChartController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function financial(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => [
                'deposit' => 1000.00,
                'withdraw' => 300.00,
                'bonus' => 0,
                'discount' => 0,
                'freebet' => 0,
                'profit' => 700.00
            ]
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function earnings(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => [
                'sport' => [
                    'bet' => 0,
                    'win' => 0,
                    'profit' => 0
                ],
                'casino' => [
                    'bet' => 0,
                    'win' => 0,
                    'profit' => 0
                ],
                'slot' => [
                    'bet' => 0,
                    'win' => 0,
                    'profit' => 0
                ],
                'virtual' => [
                    'bet' => 0,
                    'win' => 0,
                    'profit' => 0
                ]
            ]
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function games(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'success',
            'detail' => [
                [
                    'name' => 'Kupon',
                    'amount' => 100.00,
                    'percent' => 20
                ],
                [
                    'name' => 'Evolution Gaming',
                    'amount' => 200.00,
                    'percent' => 30
                ],
                [
                    'name' => 'EGT',
                    'amount' => 300.00,
                    'percent' => 50
                ]
            ]
        ]);
    }
}
