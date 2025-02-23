<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ddmtechdev\user\models\Barangays $model */

$this->title = 'Update Region: ' . $model->region_name;
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['/user/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="regions-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
