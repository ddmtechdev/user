<?php
use yii\helpers\Html;

/* @var $user app\models\User */
$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['user/auth/verify-email', 'token' => $user->verification_token]);
?>

<p>Hello <?= Html::encode($user->username) ?>,</p>
<p>Click the link below to verify your email:</p>
<p><?= Html::a('Verify Email', $verifyLink) ?></p>
