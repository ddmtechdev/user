<h4>Installation</h4>

<code>1. php composer require ddmtechdev/user:@dev
2. Run migration: php yii migrate/up --migrationPath=@vendor/ddmtechdev/user/migrations
3.  Open common/config/main.php and add this inside the modules array:
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'ddmtechdev\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/auth/login']
        ],
        ............
    ],
    'modules' => [
        'user' => [
            'class' => 'ddmtechdev\user\Module',
        ],
        ............
    ],
4.  Open composer.json and add this inside the modules array:: 
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ddmtechdev/rbac.git"
        }
    ]
</code>