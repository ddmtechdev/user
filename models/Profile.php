<?php

namespace ddmtechdev\user\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Profile model
 */
class Profile extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%profile}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name', 'birthdate', 'gender','barangay_id', 'city_id', 'region_id', 'email', 'contact_number'], 'required'],
            [['middle_name','street', 'province_id'], 'safe'],
            [['user_id'], 'integer'],
            [['birthdate'], 'date', 'format' => 'php:Y-m-d'],
            [['first_name', 'middle_name', 'last_name', 'suffix', 'street', 'barangay_id', 'city_id', 'province_id', 'region_id', 'email', 'contact_number'], 'string', 'max' => 255],
            [['gender'], 'in', 'range' => ['Male', 'Female', 'Other']],
            [['email'], 'email'],
            [['contact_number'], 'match', 'pattern' => '/^[0-9\-\(\)\/\+\s]*$/'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getFullname()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
