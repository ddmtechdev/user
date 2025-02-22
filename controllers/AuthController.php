<?php
namespace ddmtechdev\user\controllers;

use Yii;
use yii\web\Controller;
use ddmtechdev\user\models\LoginForm;
use ddmtechdev\user\models\SignupForm;
use ddmtechdev\user\models\ForgotPasswordForm;
use ddmtechdev\user\models\ResetPasswordForm;
use ddmtechdev\user\models\ChangePasswordForm;
use ddmtechdev\user\models\User;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $this->layout = 'login.php';
        if(!Yii::$app->user->isGuest){$this->goHome();}
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionSignup()
    {
        $this->layout = 'signup.php';
        if(Yii::$app->user->can('admin')){}
        else if(!Yii::$app->user->isGuest){
            $this->goHome();
        }
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
        if(!Yii::$app->user->isGuest){$this->goHome();}
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
        if(!Yii::$app->user->isGuest){$this->goHome();}
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

    public function actionChangePassword($id = null)
    {
        if ($id !== null && Yii::$app->user->can('admin')) { 
            // Admin changing another user's password
            $user = User::findOne($id);
            $isAdmin = true;
        } else {
            // Regular user changing their own password
            $user = Yii::$app->user->identity;
            $isAdmin = false;
        }

        if (!$user) {
            throw new NotFoundHttpException('User not found.');
        }

        $model = new ChangePasswordForm($user, $isAdmin);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            Yii::$app->session->setFlash('success', 'Password changed successfully.');
            return $this->redirect(['profile']); // Redirect after success
        }

        return $this->render('change-password', ['model' => $model, 'isAdmin' => $isAdmin]);
    }
    
    public function actionVerifyEmail($token)
    {
        $user = User::findOne(['verification_token' => $token, 'status' => User::STATUS_INACTIVE]);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'Invalid or expired verification link.');
            return $this->redirect(['auth/login']);
        }

        $user->verifyEmail();
        Yii::$app->session->setFlash('success', 'Your email has been verified. You can now log in.');
        return $this->redirect(['auth/login']);
    }
}
