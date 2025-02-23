<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ddmtechdev\user\models\Barangays $model */

$this->title = 'Update Province: ' . $model->province_name;
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['/user/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Provinces', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="provinces-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
