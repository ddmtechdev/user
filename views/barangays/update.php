<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ddmtechdev\user\models\Barangays $model */

$this->title = 'Update Barangay: ' . $model->barangay_name;
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['/user/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Barangays', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="barangays-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
