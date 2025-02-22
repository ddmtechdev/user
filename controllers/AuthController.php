<?php
namespace ddmtechdev\user\controllers;

use Yii;
use yii\web\Controller;
use ddmtechdev\user\models\LoginForm;
use ddmtechdev\user\models\SignupForm;
use ddmtechdev\user\models\ForgotPasswordForm;
use ddmtechdev\user\models\ResetPasswordForm;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $this->layout = 'login.php';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionSignup()
    {
        $this->layout = 'signup.php';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['login']);
        }
        return $this->render('signup', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(Yii::$app->homeUrl); // Redirect to homepage after logout
    }

    public function actionForgotPassword()
    {
        $this->layout = 'login.php';
        $model = new ForgotPasswordForm();

        if ($model->load(Yii::$app->request->post())) {
            if($model->sendResetLink()){
                Yii::$app->session->setFlash('success', 'A password reset link has been sent to your email.');
                return $this->redirect(['login']);
            }
        }

        return $this->render('forgot-password', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        $this->layout = 'login.php';
        $model = new ResetPasswordForm();

        if (!$model->validateToken($token)) {
            throw new NotFoundHttpException('Invalid or expired reset token.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Your password has been reset.');
            return $this->redirect(['login']);
        }

        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }
}
