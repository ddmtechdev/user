<?php
namespace ddmtechdev\user\models;

use Yii;
use yii\base\Model;
use ddmtechdev\user\models\User;

class ResetPasswordForm extends Model
{
    public $password;
    public $token;
    
    private $_user;

    public function rules()
    {
        return [
            [['password'], 'required'],
            [['password'], 'string', 'min' => 6],
        ];
    }

    public function validateToken($token)
    {
        $this->_user = User::findOne(['password_reset_token' => $token]);

        if (!$this->_user) {
            return false;
        }

        return true;
    }

    public function resetPassword()
    {
        if (!$this->_user) {
            return false;
        }

        $this->_user->setPassword($this->password);
        $this->_user->password_reset_token = null; // Clear token
        return $this->_user->save(false);
    }
}
