<?php

namespace ddmtechdev\user\models;

use Yii;

/**
 * This is the model class for table "provinces".
 *
 * @property int $id
 * @property int $region_id
 * @property string $province_code
 * @property string $province_name
 * @property string $created_at
 *
 * @property Cities[] $cities
 * @property Regions $region
 */
class Provinces extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provinces';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'province_name'], 'required'],
            [['region_id'], 'integer'],
            [['created_at'], 'safe'],
            [['province_name'], 'string', 'max' => 255],
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
            'province_name' => 'Province Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::class, ['province_id' => 'id']);
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
