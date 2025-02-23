<?php

namespace ddmtechdev\user\models;

use Yii;

/**
 * This is the model class for table "barangays".
 *
 * @property int $id
 * @property int $city_id
 * @property string $barangay_code
 * @property string $barangay_name
 * @property string $created_at
 *
 * @property Cities $city
 */
class Barangays extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barangays';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'region_id', 'barangay_name'], 'required'],
            [['city_id', 'province_id', 'region_id'], 'integer'],
            [['created_at'], 'safe'],
            [['barangay_name'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City',
            'province_id' => 'Province',
            'region_id' => 'Region',
            'barangay_name' => 'Barangay Name',
            'created_at' => 'Created At',
        ];
    }

    public function getProvince()
    {
        return $this->hasOne(Provinces::class, ['id' => 'province_id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Regions::class, ['id' => 'region_id']);
    }

    public function getCity()
    {
        return $this->hasOne(Cities::class, ['id' => 'city_id']);
    }

}
