<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var ddmtechdev\rbac\models\AuthRule $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="barangays-form">
    <div class="container mt-3">
        <div class="">
            <h5 class="mb-3"><?= $this->title ?></h5>
        </div>
        <div class="card shadow-lg" style="border-top: 7px solid #747474;">
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'region_id')->textInput() ?>

                <?= $form->field($model, 'province_id')->textInput() ?>

                <?= $form->field($model, 'city_id')->textInput() ?>

                <?= $form->field($model, 'barangay_name')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
