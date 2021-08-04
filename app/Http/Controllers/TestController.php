<?php
/**
 * Created by PhpStorm.
 * Filename: TestController.php
 * User: Orhan BAHAR
 * Date: 26.06.2021
 * Time: 15:37
 */

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function menu()
    {
        $naw = array(
            [
                'name' => 'userManagementCustom',
                'title' => 'Kullanıcı Yönetimi',
                'path' => 'users',
                'component' => 'users',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
                'children' => [
                    [
                        'name' => 'usersList',
                        'title' => 'Oyuncular',
                        'path' => 'users/list',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'customerGroups',
                        'title' => 'Oyuncu Grupları',
                        'path' => 'users/customer-groups',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'customerBankAccounts',
                        'title' => 'Oyuncu Banka Hesapları',
                        'path' => 'users/bank-accounts',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'customerOnline',
                        'title' => 'Online Oyuncular',
                        'path' => 'users/online-customers',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'customerNotes',
                        'title' => 'Oyuncu Notları',
                        'path' => 'users/customer-notes',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'customerLogs',
                        'title' => 'Oyuncu İşlemleri',
                        'path' => 'users/customer-logs',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'operator',
                        'title' => 'Operatorler',
                        'path' => 'users/operator',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'customerMultiIp',
                        'title' => 'Çoklu IP',
                        'path' => 'users/multi-ip',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'customerIpBans',
                        'title' => 'IP Ban',
                        'path' => 'users/ip-bans',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                ]
            ], // kullanıcı
            [
                'name' => 'finance',
                'title' => 'Finansal',
                'path' => 'finance',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
                'children' => [
                    [
                        'name' => 'financeDeposit',
                        'title' => 'Para Yatırma',
                        'path' => 'finance/deposit',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'financeWithdraw',
                        'title' => 'Para Çekme',
                        'path' => 'finance/withdraw',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'financeAccounting',
                        'title' => 'Muhasebe',
                        'path' => 'finance/accounting',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                ]
            ], // finansal
            [
                'name' => 'report',
                'title' => 'Rapor',
                'path' => '',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
            ], // rapor
            [
                'name' => 'invoices',
                'title' => 'Fatura',
                'path' => 'fatura',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users',
                    'menu' => false
                ],
                'children' => [
                    [
                        'name' => 'invoices',
                        'title' => 'Faturalar',
                        'path' => 'invoices/list',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'paymentTransactions',
                        'title' => 'Ödeme İşlemleri',
                        'path' => 'invoices/payment-transactions',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'limitRequests',
                        'title' => 'Limit Talepleri',
                        'path' => 'invoices/limit-requests',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                ]
            ], // faturalar
            [
                'name' => 'coupons',
                'title' => 'Kuponlar',
                'path' => '',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
                'children' => [
                    [
                        'name' => 'couponsList',
                        'title' => 'Kupon Listsi',
                        'path' => 'coupons/list',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'couponsSettings',
                        'title' => 'Kupon Ayarları',
                        'path' => 'coupons/settings',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                ]
            ], // Kuponlar
            [
                'name' => 'riskManagement',
                'title' => 'Risk',
                'path' => '',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
                'children' => [
                    [
                        'name' => 'liveStreaming',
                        'title' => 'Canlı Akış',
                        'path' => 'risk-management/live-streaming',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'couponsRisk',
                        'title' => 'Kupon Riskleri',
                        'path' => 'risk-management/coupons-risk',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'couponsRemainingForOneSpade',
                        'title' => 'Tek Maça Kalan Kuponlar',
                        'path' => 'risk-management/coupons-remaining-for-one-spade',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'openBets',
                        'title' => 'Açık Bahisler',
                        'path' => 'risk-management/open-bets',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                ]
            ], // Risk Yönetimi
            [
                'name' => 'sportsBookManagement',
                'title' => 'SportsBook',
                'path' => '',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
                'children' => [
                    [
                        'name' => 'resulting',
                        'title' => 'Sonuçlandırma',
                        'path' => 'sportsbook/resulting',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],

                ]
            ], // SportsBook Yönetimi
            [
                'name' => 'sites',
                'title' => 'Siteler',
                'path' => '',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
                'children' => [
                    [
                        'name' => 'sites',
                        'title' => 'Sitelerim',
                        'path' => 'sites/my-sites',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'createSite',
                        'title' => 'Site Oluştur',
                        'path' => 'sites/create-site',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'siteDomains',
                        'title' => 'Alan Adları',
                        'path' => 'sites/domains',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                ]
            ], // Web Yönetimi
            [
                'name' => 'webManagement',
                'title' => 'CMS',
                'path' => '',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
                'children' => [
                    [
                        'name' => 'announcements',
                        'title' => 'Duyurular',
                        'path' => 'web-management/announcements',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'pages',
                        'title' => 'Sayfalar',
                        'path' => 'web-management/pages',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'promotions',
                        'title' => 'Promosyonlar',
                        'path' => 'web-management/promotions',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'slider',
                        'title' => 'Slider',
                        'path' => 'web-management/slider',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'background',
                        'title' => 'Arka Plan',
                        'path' => 'web-management/background',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'gameProviderVisuals',
                        'title' => 'Oyun/Sağlayıcı Görselleri',
                        'path' => 'web-management/game-provider-visuals',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'fileManager',
                        'title' => 'Dosya Yöneticisi',
                        'path' => 'web-management/file-manager',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                ]
            ], // Siteler
            [
                'name' => 'siteSettings',
                'title' => 'Site Ayarları',
                'path' => '',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
                'children' => [
                    [
                        'name' => 'generalSettings',
                        'title' => 'Genel Ayarlar',
                        'path' => 'site-settings/general',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'socialMedia',
                        'title' => 'Sosyal Medya',
                        'path' => 'site-settings/social-media',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'customCss',
                        'title' => 'Custom CSS',
                        'path' => 'site-settings/custom-css',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'customJavaScript',
                        'title' => 'Custom JavaScript',
                        'path' => 'site-settings/custom-javascript',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'currencies',
                        'title' => 'Para Birimleri',
                        'path' => 'site-settings/currencies',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'gameProviders',
                        'title' => 'Oyun Sağlayıcıları',
                        'path' => 'site-settings/game-providers',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'paymentMethods',
                        'title' => 'Ödeme Yöntemleri',
                        'path' => 'site-settings/payment-methods',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'translates',
                        'title' => 'Çeviriler',
                        'path' => 'site-settings/translates',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                    [
                        'name' => 'bonuses',
                        'title' => 'Bonuslar',
                        'path' => 'site-settings/bonuses',
                        'meta' => [
                            'auth' => 'true',
                            'icon' => 'fe-users'
                        ],
                    ],
                ]
            ], // Site Ayarları
            [
                'name' => 'affiliates',
                'title' => 'Bayilik',
                'path' => 'affiliates',
                'meta' => [
                    'auth' => 'true',
                    'icon' => 'fe-users'
                ],
            ], // Bayilik

        );
        return response()->json($naw);
    }
}
