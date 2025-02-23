<?php

namespace ddmtechdev\user\components;

use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use ddmtechdev\user\models\Regions;
use ddmtechdev\user\models\Provinces;
use ddmtechdev\user\models\Cities;
use ddmtechdev\user\models\Barangays;

class DependentDropdown extends Component
{
    public static function getRegions()
    {
        return ArrayHelper::map(Regions::find()->all(), 'id', 'region_name');
    }

    public static function getProvinces($region_id)
    {
        return array_map(function($province) {
            return ['id' => $province->id, 'text' => $province->province_name];
        }, Provinces::find()->where(['region_id' => $region_id])->all());
    }

    public static function getCitiesByRegion($region_id)
    {
        return array_map(function($city) {
            return ['id' => $city->id, 'text' => $city->city_name];
        }, Cities::find()->where(['region_id' => $region_id, 'province_id' => NULL])->all());
    }

    public static function getCitiesByProvince($province_id)
    {
        return array_map(function($city) {
            return ['id' => $city->id, 'text' => $city->city_name];
        }, Cities::find()->where(['province_id' => $province_id])->all());
    }

    public static function getBarangays($city_id)
    {
        return array_map(function($barangay) {
            return ['id' => $barangay->id, 'text' => $barangay->barangay_name];
        }, Barangays::find()->where(['city_id' => $city_id])->all());
    }
}
