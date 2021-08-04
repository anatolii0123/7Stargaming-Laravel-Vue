<?php
/**
 * Created by PhpStorm.
 * Filename: DashBoardController.php
 * User: Orhan BAHAR
 * Date: 11.07.2021
 * Time: 11:06
 */

namespace App\Http\Controllers;

use App\Models\SiteCurrency;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;

class DashBoardController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getStatistics(Request $request): JsonResponse
    {
        $user = auth()->user();
        $startMonth = $this->startMonth($user->timezone);
        $startDay = $this->startDay($user->timezone);
        $nowDate = Carbon::now()->format('Y-m-d H:i:s');
        $defaultCurrency = $user->currency;
        $defaultCurrencyDetails = currency()->getCurrency($defaultCurrency);
        $getCurrencies = SiteCurrency::getCurrenciesBySiteId($this->siteId);

        # Customer
        $dailyUser = Customer::getDailyUserCount($this->siteId, $startDay, $nowDate);
        $dailyActive = Customer::getDailyActiveUserCount($this->siteId, $startDay, $nowDate);
        $instantActive = Customer::getInstantActiveUserCount($this->siteId);

        # Coupons
        $dailyCoupon = Coupon::getCouponsForDashBoard($this->siteId, $startDay, $nowDate);
        $monthlyCoupon = Coupon::getCouponsForDashBoard($this->siteId, $startMonth, $nowDate);

        # Customers Count and Vault (All Customer Balances)
        $getCustomers = Customer::getCustomersForDashBoard($this->siteId);

        # Transactions
        $dailyDepositTransactions = Transaction::getFinanceTransactionsForDashBoard(
            $this->siteId,
            ('deposit'),
            $startDay,
            $nowDate
        );
        $dailyWithdrawTransactions = Transaction::getFinanceTransactionsForDashBoard(
            $this->siteId,
            ('withdraw'),
            $startDay,
            $nowDate
        );
        $monthlyDepositTransactions = Transaction::getFinanceTransactionsForDashBoard(
            $this->siteId,
            ('deposit'),
            $startMonth,
            $nowDate
        );
        $monthlyWithdrawTransactions = Transaction::getFinanceTransactionsForDashBoard(
            $this->siteId,
            ('withdraw'),
            $startMonth,
            $nowDate
        );

        # Game Transactions
        $dailyGameTransactions = Transaction::getGameTransactionsForDashBoard(
            $this->siteId,
            $startDay,
            $nowDate
        );
        $monthlyGameTransactions = Transaction::getGameTransactionsForDashBoard(
            $this->siteId,
            $startMonth,
            $nowDate
        );

        $responseData = [
            'status' => true,
            'message' => 'success',
            'counter_statistics' => [
                'daily_user' => (int)$dailyUser,
                'instant_active' => (int)$instantActive,
                'daily_active' => (int)$dailyActive,
                'total_members' => 0,
                'total_member_vault' => 0,
                'monthly_coupon' => 0,
                'monthly_waiting_coupon' => 0,
                'daily_coupon' => 0,
                'daily_waiting_coupon' => 0
            ],
            'last_updated' => Carbon::now()->addMinutes('-4')->format('Y-m-d H:i:s'),
            'currency' => $defaultCurrency,
            'currencies' => [],
            'currency_last_updated' => $defaultCurrencyDetails['updated_at'],
            'daily_deposit' => [
                'amount' => 0,
                'piece' => 0,
                'methods' => []
            ],
            'daily_withdraw' => [
                'amount' => 0,
                'piece' => 0,
                'methods' => []
            ],
            'monthly_deposit' => [
                'amount' => 0,
                'piece' => 0,
                'methods' => []
            ],
            'monthly_withdraw' => [
                'amount' => 0,
                'piece' => 0,
                'methods' => []
            ],
            'reports' => [
                'daily' => [
                    'coupon' => [
                        'bet' => 0,
                        'win' => 0,
                        'profit' => 0
                    ],
                    'slot' => [
                        'bet' => 0,
                        'win' => 0,
                        'profit' => 0,
                        'games' => []
                    ],
                    'casino' => [
                        'bet' => 0,
                        'win' => 0,
                        'profit' => 0,
                        'games' => []
                    ]
                ],
                'monthly' => [
                    'coupon' => [
                        'bet' => 0,
                        'win' => 0,
                        'profit' => 0
                    ],
                    'slot' => [
                        'bet' => 0,
                        'win' => 0,
                        'profit' => 0,
                        'games' => []
                    ],
                    'casino' => [
                        'bet' => 0,
                        'win' => 0,
                        'profit' => 0,
                        'games' => []
                    ]
                ]
            ]
        ];

        # Customers Count and Vault
        $customerData = $this->userBalances($getCustomers, $defaultCurrency);
        $responseData['counter_statistics']['total_members'] = $customerData['count'];
        $responseData['counter_statistics']['total_member_vault'] = $customerData['vault'];

        # Daily Coupon
        $dailyCouponData = $this->couponReport($dailyCoupon, $defaultCurrency);
        $responseData['counter_statistics']['daily_coupon'] = $dailyCouponData['count']['total'];
        $responseData['counter_statistics']['daily_waiting_coupon'] = $dailyCouponData['count']['waiting'];
        $responseData['reports']['daily']['coupon']['bet'] = $dailyCouponData['bet'];
        $responseData['reports']['daily']['coupon']['win'] = $dailyCouponData['win'];
        $responseData['reports']['daily']['coupon']['profit'] = $dailyCouponData['profit'];

        # Monthly Coupon
        $monthlyCouponData = $this->couponReport($monthlyCoupon, $defaultCurrency);
        $responseData['counter_statistics']['monthly_coupon'] = $monthlyCouponData['count']['total'];
        $responseData['counter_statistics']['monthly_waiting_coupon'] = $monthlyCouponData['count']['waiting'];
        $responseData['reports']['monthly']['coupon']['bet'] = $monthlyCouponData['bet'];
        $responseData['reports']['monthly']['coupon']['win'] = $monthlyCouponData['win'];
        $responseData['reports']['monthly']['coupon']['profit'] = $monthlyCouponData['profit'];

        # Daily Deposit
        $dailyDepositMethods = $this->paymentMethods($dailyDepositTransactions, $defaultCurrency);
        $responseData['daily_deposit']['amount'] = $dailyDepositMethods['total']['amount'];
        $responseData['daily_deposit']['piece'] = $dailyDepositMethods['total']['piece'];
        $responseData['daily_deposit']['methods'] = $dailyDepositMethods['methods'];

        # Daily Withdraw
        $dailyWithdrawMethods = $this->paymentMethods($dailyWithdrawTransactions, $defaultCurrency);
        $responseData['daily_withdraw']['amount'] = $dailyWithdrawMethods['total']['amount'];
        $responseData['daily_withdraw']['piece'] = $dailyWithdrawMethods['total']['piece'];
        $responseData['daily_withdraw']['methods'] = $dailyWithdrawMethods['methods'];

        # Monthly Deposit
        $monthlyDepositMethods = $this->paymentMethods($monthlyDepositTransactions, $defaultCurrency);
        $responseData['monthly_deposit']['amount'] = $monthlyDepositMethods['total']['amount'];
        $responseData['monthly_deposit']['piece'] = $monthlyDepositMethods['total']['piece'];
        $responseData['monthly_deposit']['methods'] = $monthlyDepositMethods['methods'];

        # Monthly Withdraw
        $monthlyWithdrawMethods = $this->paymentMethods($monthlyWithdrawTransactions, $defaultCurrency);
        $responseData['monthly_withdraw']['amount'] = $monthlyWithdrawMethods['total']['amount'];
        $responseData['monthly_withdraw']['piece'] = $monthlyWithdrawMethods['total']['piece'];
        $responseData['monthly_withdraw']['methods'] = $monthlyWithdrawMethods['methods'];

        # Daily Game
        $dailyGameData = $this->gameReport($dailyGameTransactions, $defaultCurrency);
        $responseData['reports']['daily']['casino']['bet'] = $dailyGameData['casino']['bet'];
        $responseData['reports']['daily']['casino']['win'] = $dailyGameData['casino']['win'];
        $responseData['reports']['daily']['casino']['profit'] = $dailyGameData['casino']['profit'];
        $responseData['reports']['daily']['casino']['games'] = $dailyGameData['casino']['games'];
        $responseData['reports']['daily']['slot']['bet'] = $dailyGameData['slot']['bet'];
        $responseData['reports']['daily']['slot']['win'] = $dailyGameData['slot']['win'];
        $responseData['reports']['daily']['slot']['profit'] = $dailyGameData['slot']['profit'];
        $responseData['reports']['daily']['slot']['games'] = $dailyGameData['slot']['games'];

        # Monthly Game
        $monthlyGameData = $this->gameReport($monthlyGameTransactions, $defaultCurrency);
        $responseData['reports']['monthly']['casino']['bet'] = $monthlyGameData['casino']['bet'];
        $responseData['reports']['monthly']['casino']['win'] = $monthlyGameData['casino']['win'];
        $responseData['reports']['monthly']['casino']['profit'] = $monthlyGameData['casino']['profit'];
        $responseData['reports']['monthly']['casino']['games'] = $monthlyGameData['casino']['games'];
        $responseData['reports']['monthly']['slot']['bet'] = $monthlyGameData['slot']['bet'];
        $responseData['reports']['monthly']['slot']['win'] = $monthlyGameData['slot']['win'];
        $responseData['reports']['monthly']['slot']['profit'] = $monthlyGameData['slot']['profit'];
        $responseData['reports']['monthly']['slot']['games'] = $monthlyGameData['slot']['games'];

        # Currencies
        foreach ($getCurrencies as $currency) {
            $responseData['currencies'][$currency->currency] = $this->numberFormat(
                currency(1, $currency->currency, $defaultCurrency, false)
            );
        }

        return response()->json($responseData, 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * @param $data
     * @param $defaultCurrency
     * @return array
     */
    private function userBalances($data, $defaultCurrency): array
    {
        $structure = [
            'count' => 0,
            'vault' => 0
        ];

        foreach ($data as $customer) {
            # Counter
            $structure['count']++;

            if ($customer->balance <= 0)
                continue;

            #echo '<pre>'; print_r($customer);print_r($customer->site); die;

            # Check Currency
            $customerCurrency = $customer->currency;
            $activeCurrency = !empty($customerCurrency) ? $customerCurrency : $customer->site->currency;

            # Balance Calculator and Convert Currency
            $structure['vault'] += currency($customer->balance, $activeCurrency, $defaultCurrency, false);
        }

        # Vault Number Format
        $structure['vault'] = $this->numberFormat($structure['vault']);

        return $structure;
    }

    /**
     * @param $data
     * @param $defaultCurrency
     * @return array
     */
    private function gameReport($data, $defaultCurrency): array
    {
        $dataResponse = [
            'casino' => [
                'count' => 0,
                'bet' => 0,
                'win' => 0,
                'profit' => 0,
                'games' => []
            ],
            'slot' => [
                'count' => 0,
                'bet' => 0,
                'win' => 0,
                'profit' => 0,
                'games' => []
            ],
            'virtual' => [
                'count' => 0,
                'bet' => 0,
                'win' => 0,
                'profit' => 0,
                'games' => []
            ]
        ];

        $dataProviders = [
            'casino' => [],
            'slot' => [],
            'virtual' => []
        ];

        foreach ($data as $transaction) {
            $gameType = $this->checkGameType($transaction->game->live ?? 0);
            $gameProvider = $transaction->game->provider ?? null;

            # Check Currency
            if (empty($transaction->currency)) {
                $customerCurrency = $transaction->customer->currency;
                $transactionCurrency = !empty($customerCurrency) ? $customerCurrency : $transaction->site->currency;
            } else {
                $transactionCurrency = $transaction->currency;
            }

            # Add New Provider on Array
            if (empty($dataProviders[$gameType][$gameProvider])) {
                $dataProviders[$gameType][$gameProvider] = [
                    'name' => $gameProvider,
                    'amount' => 0
                ];
            }

            # Casino Play
            if ($transaction->type == 'casinoPlay') {
                $dataResponse[$gameType]['count']++;
                $dataResponse[$gameType]['bet'] +=
                    currency($transaction->amount, $transactionCurrency, $defaultCurrency, false);

                # for Detail
                $dataProviders[$gameType][$gameProvider]['amount'] +=
                    currency($transaction->amount, $transactionCurrency, $defaultCurrency, false);
            }

            # Casino Win
            if ($transaction->type == 'casinoWin') {
                $dataResponse[$gameType]['win'] +=
                    currency($transaction->amount, $transactionCurrency, $defaultCurrency, false);

                # for Detail
                $dataProviders[$gameType][$gameProvider]['amount'] -=
                    currency($transaction->amount, $transactionCurrency, $defaultCurrency, false);
            }

            # Casino Cancel
            if ($transaction->type == 'casinoCancel') {
                $dataResponse[$gameType]['win'] +=
                    currency($transaction->amount, $transactionCurrency, $defaultCurrency, false);

                # for Detail
                $dataProviders[$gameType][$gameProvider]['amount'] -=
                    currency($transaction->amount, $transactionCurrency, $defaultCurrency, false);
            }
        }

        # Profit Calculator for Casino
        $dataResponse['casino']['bet'] = $this->numberFormat($dataResponse['casino']['bet']);
        $dataResponse['casino']['win'] = $this->numberFormat($dataResponse['casino']['win']);
        $dataResponse['casino']['profit'] = $this->numberFormat(
            $dataResponse['casino']['bet'] - $dataResponse['casino']['win']
        );

        # Profit Calculator for Slot
        $dataResponse['slot']['bet'] = $this->numberFormat($dataResponse['slot']['bet']);
        $dataResponse['slot']['win'] = $this->numberFormat($dataResponse['slot']['win']);
        $dataResponse['slot']['profit'] = $this->numberFormat(
            $dataResponse['slot']['bet'] - $dataResponse['slot']['win']
        );

        # Profit Calculator for Virtual
        $dataResponse['virtual']['bet'] = $this->numberFormat($dataResponse['virtual']['bet']);
        $dataResponse['virtual']['win'] = $this->numberFormat($dataResponse['virtual']['win']);
        $dataResponse['virtual']['profit'] = $this->numberFormat(
            $dataResponse['virtual']['bet'] - $dataResponse['virtual']['win']
        );

        # Add Providers Data on Array
        $dataResponse['casino']['games'] = $this->convertLoopData($dataProviders['casino']);
        $dataResponse['slot']['games'] = $this->convertLoopData($dataProviders['slot']);
        $dataResponse['virtual']['games'] = $this->convertLoopData($dataProviders['virtual']);

        return $dataResponse;
    }

    /**
     * @param $data
     * @param $defaultCurrency
     * @return array
     */
    private function paymentMethods($data, $defaultCurrency): array
    {
        $dataMethods = [];
        $dataResponse = [
            'total' => [
                'amount' => 0,
                'piece' => 0
            ],
            'methods' => []
        ];

        foreach ($data as $transaction) {
            if (empty($transaction->currency)) {
                $customerCurrency = $transaction->customer->currency;
                $transactionCurrency = !empty($customerCurrency) ? $customerCurrency : $transaction->site->currency;
            } else {
                $transactionCurrency = $transaction->currency;
            }

            if (empty($dataMethods[$transaction->payment_id]))
                $dataMethods[$transaction->payment_id] = [
                    'name' => $transaction->paymentMethod->paymentGroup->name,
                    'amount' => 0
                ];

            # for Total
            $dataResponse['total']['piece']++;
            $dataResponse['total']['amount'] +=
                currency($transaction->amount, $transactionCurrency, $defaultCurrency, false);

            # for Detail
            $dataMethods[$transaction->payment_id]['amount'] +=
                currency($transaction->amount, $transactionCurrency, $defaultCurrency, false);
        }

        $dataResponse['methods'] = $this->convertLoopData($dataMethods);

        return $dataResponse;
    }

    /**
     * @param $data
     * @param $defaultCurrency
     * @return array
     */
    private function couponReport($data, $defaultCurrency): array
    {
        $structure = [
            'count' => [
                'total' => 0,
                'waiting' => 0,
                'lose' => 0,
                'win' => 0,
                'cancel' => 0
            ],
            'bet' => 0,
            'win' => 0,
            'profit' => 0
        ];

        # Loop Data
        foreach ($data as $coupon) {
            $customerCurrency = $coupon->customer->currency;
            $couponCurrency = !empty($customerCurrency) ? $customerCurrency : $coupon->site->currency;

            $structure['count']['total']++;
            $structure['bet'] += $this->convertAmountForDashBoard(
                $coupon->amount,
                $couponCurrency,
                $defaultCurrency
            );

            # Waiting
            if ($coupon->status == 1) {
                $structure['count']['waiting']++;
            }

            # Lose
            if ($coupon->status == 2) {
                $structure['count']['lose']++;
            }

            # Win
            if ($coupon->status == 3) {
                $structure['count']['win']++;
                $structure['win'] += $this->convertAmountForDashBoard(
                    $coupon->win,
                    $couponCurrency,
                    $defaultCurrency
                );
            }

            # Cancel
            if ($coupon->status == 4) {
                $structure['count']['cancel']++;
                $structure['win'] += $this->convertAmountForDashBoard(
                    $coupon->amount,
                    $couponCurrency,
                    $defaultCurrency
                );
            }
        }

        # Profit Calculator
        $structure['profit'] = $this->numberFormat($structure['bet'] - $structure['win']);
        $structure['bet'] = $this->numberFormat($structure['bet']);
        $structure['win'] = $this->numberFormat($structure['win']);

        return $structure;
    }

    /**
     * @param $amount
     * @param $from
     * @param $to
     * @return array|string|string[]
     */
    private function convertAmountForDashBoard($amount, $from, $to)
    {
        return $this->numberFormat(
            currency($this->numberFormat($amount), $from, $to, false)
        );
    }

    /**
     * @param $type
     * @return string
     */
    private function checkGameType($type): string
    {
        if ($type == 1) {
            return 'casino';
        } else if ($type == 2) {
            return 'virtual';
        } else {
            return 'slot';
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeUserCurrency(Request $request): JsonResponse
    {
        $user = auth()->user();
        $data = $request->only(
            'currency'
        );

        $validator = Validator::make($data, [
            'currency' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()]);
        }

        $updateCurrency = User::updateCurrency($user->id, $request->input('currency'));

        if (!$updateCurrency)
            return response()->json([
                'status' => false,
                'message' => 'User currency not updated'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'User currency updated successfully'
        ]);
    }
}
