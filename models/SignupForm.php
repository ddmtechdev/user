<?php
namespace ddmtechdev\user\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $suffix;
    public $birthdate;
    public $gender;
    public $street;
    public $barangay_id;
    public $city_id;
    public $province_id;
    public $region_id;
    public $contact_number;

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'first_name', 'last_name', 'birthdate', 'gender','barangay_id', 'city_id', 'region_id', 'contact_number'], 'required'],
            [['middle_name','province_id','street','suffix'], 'string'],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 6],
            [['birthdate'], 'date', 'format' => 'php:Y-m-d'],
            [['gender'], 'in', 'range' => ['Male', 'Female', 'Other']],
            [['contact_number'], 'match', 'pattern' => '/^[0-9\-\(\)\/\+\s]*$/'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region',
            'province_id' => 'Province',
            'city_id' => 'City',
            'barangay_id' => 'Barangay',
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        // $user->generateAuthKey();
        $user->generateEmailVerificationToken(); 
        $user->status = User::STATUS_INACTIVE;

        if ($user->save()) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->first_name = $this->first_name;
            $profile->middle_name = $this->middle_name;
            $profile->last_name = $this->last_name;
            $profile->suffix = $this->suffix;
            $profile->birthdate = $this->birthdate;
            $profile->gender = $this->gender;
            $profile->street = $this->street;
            $profile->barangay_id = $this->barangay_id;
            $profile->city_id = $this->city_id;
            $profile->province_id = $this->province_id;
            $profile->region_id = $this->region_id;
            $profile->contact_number = $this->contact_number;
            $profile->email = $this->email;
            if($profile->save()){
                $this->sendEmailVerification($user);
                return $user;
            }
            else{
                return null;
            }
        }else{
            if ($user->errors) {
                if (ArrayHelper::keyExists('username', $user->errors)) {
                    $this->addError('username', 'This username is already taken.');
                }
                if (ArrayHelper::keyExists('email', $user->errors)) {
                    $this->addError('email', 'This email is already registered.');
                }
            }
        }

        return null;
    }
    
    protected function sendEmailVerification($user)
    {
        return Yii::$app->mailer->compose(['html' => 'emailVerify'], ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => 'Admin'])
            ->setTo($user->email)
            ->setSubject('Email Verification')
            ->send();
    }
}
