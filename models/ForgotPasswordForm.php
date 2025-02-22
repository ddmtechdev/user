<?php
namespace ddmtechdev\user\models;

use Yii;
use yii\base\Model;
use ddmtechdev\user\models\User;

class ForgotPasswordForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'exist', 'targetClass' => User::class, 'targetAttribute' => 'email', 'message' => 'There is no user with this email address.'],
        ];
    }

    public function sendResetLink()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            return false;
        }

        // Generate a password reset token
        $user->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
        if ($user->save(false)) {}
        else{
            return false;
        }

        // Send email
        // echo Yii::$app->params['adminEmail'];
        // exit;
        return Yii::$app->mailer->compose(['html' => 'passwordReset'], ['user' => $user])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->email)
            ->setSubject('Password Reset Request')
            ->send();
    }
}
