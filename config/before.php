<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 02.09.2015
 * Time: 16:22
 */

$id = 'ra-site';
$name = 'RA panel based site';
$email = 'no-reply@' . str_replace('www.', $_SERVER['HTTP_HOST'], $_SERVER['HTTP_HOST']);

$config = [
    'id' => $id,
    'name' => $name,
    'sourceLanguage' => 'en-US',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'image/_<type>/<name>' => 'image/index',
                '<m_:(rapanel|ra)>' => 'rapanel/default/index',
            ],
        ],
        'authManager' => [
            'class' => 'ra\components\AuthManager',
        ],
        'view' => [
            'theme' => [
                'basePath' => '@webroot/theme',
                'baseUrl' => '/theme',
                'pathMap' => [
                    '@app/views' => '@webroot/theme/views',
                    '@app/widgets/views' => '@webroot/theme/views/widgets',
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'messageConfig' => [
                'from' => [$email],
                'charset' => 'UTF-8',
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'messageTable' => '{{%message_translate}}',
                    'sourceMessageTable' => '{{%message}}',
                    'on missingTranslation' => ['ra\components\Translation', 'handleMissingTranslation'],
                ],
            ],
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'timeout' => 3600 * 24 * 30,
            'useCookies' => true,
        ],
    ],
    'params' => [
        'adminEmail' => 'webmaster@rere-design.ru',
        'fromEmail' => $email,
    ],
];

if (YII_ENV_DEV) {
    $allowedIPs = ['192.168.1.*', '78.159.225.99', '10.*.*.*'];
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['bootstrap'][] = 'gii';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => $allowedIPs,
    ];
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => $allowedIPs,
    ];
}

return $config;