<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/auth/reset-password', 'token' => $user->password_reset_token]);
?>

<p>Hello <?= Html::encode($user->username) ?>,</p>

<p>Click the link below to reset your password:</p>

<p><?= Html::a('Reset Password', $resetLink) ?></p>
