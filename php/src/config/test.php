<?php
$params = require(__DIR__ . '/params.php');
$dbParams = require(__DIR__ . '/testDb.php');

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),    
    'language' => 'en-US',
    'bootstrap' => ['log', 'wiki'],
    'layout' => 'admin-standard',
    'defaultRoute' => 'game/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'db' => $dbParams,
        'dbGame' => require(__DIR__ . '/testDbGame.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'health' => 'site/health'
            ],
        ],
        's3assets' => [
            'class' => 'app\components\S3Assets',
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'useCookies' => true,
        ],
        's3' => [
            'class' => 'frostealth\yii2\aws\s3\Service',
            'credentials' => [
                'key' => 'AKIAJVUROJYRGB4A55VA',
                'secret' => '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',
            ],
            'region' => 'us-east-1',
            'defaultBucket' => 'quickfire-assets',
            'defaultAcl' => 'public-read',
        ],
        'spacesAssets' => [
            'class' => 'app\components\s3\Service',
            'endpoint' => 'https://nyc3.digitaloceanspaces.com',
            'credentials' => [
                'key' => '22U6TN77G6JOEOI4LVCS',
                'secret' => 'EbuPDfkauFa2tzqJWgF2Ain3pVAT8vpnzzM6Kjdv2Uo'
            ],
            'defaultBucket' => 'quickfire',
            'defaultAcl' => 'public-read',
            'region' => 'us'
        ],
        'spacesUserAssets' => [
            'class' => 'app\components\s3\Service',
            'endpoint' => 'https://sfo2.digitaloceanspaces.com',
            'credentials' => [
                'key' => '22U6TN77G6JOEOI4LVCS',
                'secret' => 'EbuPDfkauFa2tzqJWgF2Ain3pVAT8vpnzzM6Kjdv2Uo'
            ],
            'defaultBucket' => 'quickfire-user-uploads',
            'defaultAcl' => 'public-read',
            'region' => 'us'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => YII_DEBUG ? [
            'class' => 'yii\caching\FileCache'
        ] : [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => 'quickfire-memcache.quickfire.svc.cluster.local'
                ]
            ],
            'useMemcached' => true
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'targets' => [
                // writes to php-fpm output stream
                [
                    'class' => 'codemix\streamlog\Target',
                    'url' => 'php://stdout',
                    'levels' => ['info', 'trace'],
                    'logVars' => [],
                    'enabled' => YII_DEBUG,
                ],
                [
                    'class' => 'codemix\streamlog\Target',
                    'url' => 'php://stderr',
                    'levels' => ['error', 'warning'],
                    'logVars' => [],
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],        
    ],
    'modules' => [
        'redactor' => 'yii\redactor\RedactorModule',
        'apiv1' => [
            'class' => 'app\modules\apiv1\Module',
        ],
        'wiki' => [
            'class' => 'app\modules\wiki\Module',
        ],
    ],
    'params' => $params,
];
