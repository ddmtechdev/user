<?php
namespace ddmtechdev\user\controllers;

use Yii;
use yii\web\Controller;
use ddmtechdev\user\models\LoginForm;
use ddmtechdev\user\models\SignupForm;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->redirect(['login']);
        }

        return $this->render('signup', ['model' => $model]);
    }
}
