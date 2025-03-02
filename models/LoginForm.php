<?php
namespace ddmtechdev\user\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    const STATUS_BLOCKED = 0;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        $user = User::findOne(['username' => $this->username]);

        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect username or password.');
        }
    }

    public function login()
    {
        if ($this->validate()) {
            $user = User::findOne(['username' => $this->username]);

            if ($user && $user->status == LoginForm::STATUS_BLOCKED) {
                $this->addError('username', 'Your account is blocked. Please contact the administrator.');
                return false; // Stop login process
            }

            if ($user && $user->status == User::STATUS_INACTIVE) {
                $this->addError('username', 'Your account is not verified. Please check your email.');
                return false;
            }

            return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 5 : 0);
            // return Yii::$app->user->login($model);
        }

        return false;
    }
}
