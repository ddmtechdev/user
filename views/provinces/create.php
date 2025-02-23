<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var ddmtechdev\user\models\Barangays $model */

$this->title = 'Create Province';
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => ['/user/admin']];
$this->params['breadcrumbs'][] = ['label' => 'Provinces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provinces-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
