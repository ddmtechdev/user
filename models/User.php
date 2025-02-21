<?php
namespace ddmtechdev\user\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->auth_key = Yii::$app->security->generateRandomString(); // Generate auth_key
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
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}
