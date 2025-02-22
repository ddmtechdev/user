<?php
namespace ddmtechdev\user\models;

use Yii;
use yii\base\Model;
use ddmtechdev\user\models\User;

class ChangePasswordForm extends Model
{
    public $current_password;
    public $new_password;
    public $confirm_password;
    public $isAdmin = false; // Flag to check if admin is changing password

    private $_user;

    public function __construct($user, $isAdmin = false, $config = [])
    {
        $this->_user = $user;
        $this->isAdmin = $isAdmin;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['new_password', 'confirm_password'], 'required'],
            [['current_password'], 'required', 'when' => function ($model) {
                return !$model->isAdmin; // Require current password only for non-admin users
            }, 'whenClient' => "function (attribute, value) {
                return !$('#isAdmin').val();
            }"],
            [['new_password'], 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'message' => 'Passwords do not match.'],
            ['current_password', 'validateCurrentPassword'],
        ];
    }

    public function validateCurrentPassword($attribute, $params)
    {
        if (!$this->isAdmin && !Yii::$app->security->validatePassword($this->current_password, $this->_user->password_hash)) {
            $this->addError($attribute, 'Incorrect current password.');
        }
    }

    public function changePassword()
    {
        if ($this->validate()) {
            $this->_user->setPassword($this->new_password);
            $this->_user->generateAuthKey();
            return $this->_user->save(false);
        }
        return false;
    }

    public function getUsername($user_id)
    {
        $user = User::findOne($user_id);
        return $user ? $user->username : '';
    }
}
