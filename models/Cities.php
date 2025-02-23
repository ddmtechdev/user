<?php

namespace ddmtechdev\user\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property int $region_id
 * @property int|null $province_id
 * @property string $city_code
 * @property string $city_name
 * @property string $category_class
 * @property string $created_at
 *
 * @property Barangays[] $barangays
 * @property Provinces $province
 * @property Regions $region
 */
class Cities extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id'], 'default', 'value' => null],
            [['region_id', 'city_name', 'category_class'], 'required'],
            [['region_id', 'province_id'], 'integer'],
            [['created_at'], 'safe'],
            [['city_name'], 'string', 'max' => 255],
            [['category_class'], 'string', 'max' => 50],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::class, 'targetAttribute' => ['province_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::class, 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region',
            'province_id' => 'Province',
            'city_name' => 'City Name',
            'category_class' => 'Category Class',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Barangays]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarangays()
    {
        return $this->hasMany(Barangays::class, ['city_id' => 'id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Provinces::class, ['id' => 'province_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Regions::class, ['id' => 'region_id']);
    }

}
