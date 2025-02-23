<?php

namespace ddmtechdev\user\models;

use Yii;

/**
 * This is the model class for table "regions".
 *
 * @property int $id
 * @property string $region_code
 * @property string $region_name
 * @property string $created_at
 *
 * @property Cities[] $cities
 * @property Provinces[] $provinces
 */
class Regions extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_code', 'region_name'], 'required'],
            [['created_at'], 'safe'],
            [['region_code'], 'string', 'max' => 10],
            [['region_name'], 'string', 'max' => 255],
            [['region_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_code' => 'Region Code',
            'region_name' => 'Region Name',
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
        return $this->hasMany(Cities::class, ['region_id' => 'id']);
    }

    /**
     * Gets query for [[Provinces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvinces()
    {
        return $this->hasMany(Provinces::class, ['region_id' => 'id']);
    }

}
