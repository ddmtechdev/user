<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use ddmtechdev\user\components\DependentDropdown;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var ddmtechdev\rbac\models\AuthRule $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cities-form">
    <div class="container mt-3">
        <div class="">
            <h5 class="mb-3"><?= $this->title ?></h5>
        </div>
        <div class="card shadow-lg" style="border-top: 7px solid #747474;">
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <!-- Region Select2 -->
                <?= $form->field($model, 'region_id')->widget(Select2::class, [
                    'data' => DependentDropdown::getRegions(),
                    'options' => ['placeholder' => 'Select Region', 'id' => 'region-dropdown'],
                    'pluginOptions' => ['allowClear' => true]
                ]) ?>

                <!-- Province Select2 -->
                <?= $form->field($model, 'province_id')->widget(Select2::class, [
                    'data' => [],
                    'options' => ['placeholder' => 'Select Province', 'id' => 'province-dropdown'],
                    'pluginOptions' => ['allowClear' => true]
                ]) ?>

                <?= $form->field($model, 'city_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'category_class')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php
$script = <<< JS
$(document).ready(function() {
    // Load Provinces and Cities when Region changes
    $('#region-dropdown').change(function() {
        var regionId = $(this).val();
        // Provinces
        $.get("/user/dropdown/provinces", { region_id: regionId }, function(data) {
            $('#province-dropdown').empty().append('<option value="">Select Province</option>');
            $.each(data, function(index, item) {
                $('#province-dropdown').append($('<option>', { value: '', text: '' }));
                $('#province-dropdown').append($('<option>', { value: item.id, text: item.text }));
            });
        }, 'json');
        
        // Cities
        $.get("/user/dropdown/cities-by-region", { region_id: regionId }, function(data) {
            $('#city-dropdown').empty().append('<option value="">Select City</option>');
            $.each(data, function(index, item) {
                $('#city-dropdown').append($('<option>', { value: '', text: '' }));
                $('#city-dropdown').append($('<option>', { value: item.id, text: item.text }));
            });
        }, 'json');
    });
});
JS;
$this->registerJs($script);
?>