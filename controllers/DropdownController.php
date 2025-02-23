<?php

namespace ddmtechdev\user\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use ddmtechdev\user\components\DependentDropdown;

class DropdownController extends Controller
{
    protected $dropdownService;

    public function __construct($id, $module, DependentDropdown $dropdownService, $config = [])
    {
        $this->dropdownService = $dropdownService;
        parent::__construct($id, $module, $config);
    }

    public function actionProvinces($region_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->dropdownService->getProvinces($region_id);
    }

    public function actionCitiesByRegion($region_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->dropdownService->getCitiesByRegion($region_id);
    }

    public function actionCitiesByProvince($province_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->dropdownService->getCitiesByProvince($province_id);
    }

    public function actionBarangays($city_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->dropdownService->getBarangays($city_id);
    }
}