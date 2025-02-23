<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ddmtechdev\user\models\Barangays $model */

$this->title = 'Create Region';
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['/user/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
