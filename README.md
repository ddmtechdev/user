<h4>Installation</h4>

1. composer require ddmtechdev/user:@dev
2. Run migration: php yii migrate/up --migrationPath=@vendor/ddmtechdev/user/migrations
3. Open common/config/main.php and add this inside the modules array:
<code>
    'components' => [
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'ddmtechdev\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/auth/login']
        ],
        ...
    ],
    'modules' => [
        'user' => [
            'class' => 'ddmtechdev\user\Module',
        ],
        ...
    ],
</code>
4.  Open composer.json and add this inside:
<code>
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ddmtechdev/rbac.git"
        }
        ...
    ]
</code>