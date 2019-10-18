<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [ 
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'cookieValidationKey' => 'qchoZwcucgeaz6uXAykPzf1KgoKzkwPM',
        ],       
        'user' => [
            'identityClass' => 'api\common\models\User',
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'trace'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/user',
                    'tokens' => [
                        '{id}' => '<id:\w+>'
                    ],
                    'extraPatterns' => [
                        'GET milan' => 'milan'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/register',
                    'pluralize' => false,
                    'patterns' => [
                        'POST /' => 'register'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/login',
                    'pluralize' => false,
                    'patterns' => [
                        'POST /' => 'login'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule', 
                    'controller' => 'v1/company',
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\w+>'
                    ]
                ]

                
            ],        
        ],
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => 'cKCjIx9ovK3nk72sh4HTlu8zumTrZ3UJ'
        ],
        
    ],
    'params' => $params,
];



