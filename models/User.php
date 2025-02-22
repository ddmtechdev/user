<?php
namespace ddmtechdev\user\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\rbac\Role;

class User extends ActiveRecord implements IdentityInterface
{
    public $old_password;
    public $new_password;
    public $confirm_password;
    public $granted_access;

    const STATUS_ACTIVE = 10;
    const STATUS_BLOCKED = 0;

    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
            [['password_reset_token'], 'string', 'max' => 255],
            [['password_reset_token'], 'safe'],
            [['status'], 'integer'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],

            ['username', 'unique', 'on' => self::SCENARIO_DEFAULT], 
            ['email', 'unique', 'on' => self::SCENARIO_DEFAULT], 

            [['old_password'], 'required', 'when' => function ($model) {
                return !empty($model->new_password);
            }, 'whenClient' => "function (attribute, value) {
                return $('#new-password').val().length > 0;
            }"],
            ['old_password', 'validateOldPassword'],
            [['new_password', 'confirm_password'], 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password'],
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->auth_key = Yii::$app->security->generateRandomString(); // Generate auth_key
        }

        if (!empty($this->new_password)) {
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->new_password);
        }
        
        return parent::beforeSave($insert);
    }
    
    public function beforeValidate(){
        if (parent::beforeValidate()) {
            $errors = [];

            if (self::find()->where(['username' => $this->username])->exists()) {
                $errors['username'] = 'This username is already taken.';
            }

            if (self::find()->where(['email' => $this->email])->exists()) {
                $errors['email'] = 'This email is already registered.';
            }

            if (!empty($errors)) {
                $this->addErrors($errors);
                return false; // Prevent saving
            }
            return true;
        }
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['username', 'email', 'status']; // No unique validation here
        return $scenarios;
    }

    public function validateOldPassword($attribute, $params)
    {
        if (!$this->hasErrors() && !empty($this->new_password)) {
            if (!Yii::$app->security->validatePassword($this->old_password, $this->password_hash)) {
                $this->addError($attribute, 'Incorrect old password.');
            }
        }
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function getRole()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser($this->id);
        return !empty($roles) ? reset($roles)->name : null;
    }

    public function assignRole($roleName)
    {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($this->id); // Remove existing roles
        $role = $auth->getRole($roleName);
        
        if ($role) {
            return $auth->assign($role, $this->id);
        }

        return false;
    }
    
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
