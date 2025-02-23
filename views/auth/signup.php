<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use ddmtechdev\user\components\DependentDropdown;

$this->title = 'Account Registration';
?>

<div class="container p-3">
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="card shadow-lg" style="border-top: 7px solid #0d6efd">
        <div class="card-body">
            <?php $form = ActiveForm::begin(['options' => ['class' => 'row']]); ?>

            <div class="col-md-4">
                <?= $form->field($model, 'username', ['options' => ['class' => '']])
                    ->textInput(['placeholder' => 'Enter username'])
                    ->label('Username', ['class' => 'form-label']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'email', ['options' => ['class' => '']])
                    ->input('email', ['placeholder' => 'Enter email'])
                    ->label('Email', ['class' => 'form-label']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'password', ['options' => ['class' => '']])
                    ->passwordInput(['placeholder' => 'Enter password'])
                    ->label('Password', ['class' => 'form-label']) ?>
            </div>

            <div class="col-md-12"><hr></div>

            <div class="col-md-4">
                <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'Enter first name']) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'middle_name')->textInput(['placeholder' => 'Enter middle name']) ?>
            </div>

            <div class="col-md-3">
                <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Enter last name']) ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'suffix')->textInput(['placeholder' => 'e.g. Jr, Sr, III']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'birthdate')->input('date', ['class' => 'form-control']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'gender')->dropDownList(
                    ['Male' => 'Male', 'Female' => 'Female'],
                    ['class' => 'form-select', 'placeholder' => 'Select Gender']
                ) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'contact_number')->textInput(['placeholder' => 'Enter contact number']) ?>
            </div>

            <div class="col-md-12"><hr></div>

            <div class="col-md-4">
                <?= $form->field($model, 'street')->textInput(['placeholder' => 'Enter street']) ?>
            </div>

            <div class="col-md-4">
                <!-- Region Select2 -->
                <?= $form->field($model, 'region_id')->widget(Select2::class, [
                    'data' => DependentDropdown::getRegions(),
                    'options' => ['placeholder' => 'Select Region', 'id' => 'region-dropdown'],
                    'pluginOptions' => ['allowClear' => true]
                ]) ?>
            </div>
            <div class="col-md-4">
                <!-- Province Select2 -->
                <?= $form->field($model, 'province_id')->widget(Select2::class, [
                    'data' => [],
                    'options' => ['placeholder' => 'Select Province', 'id' => 'province-dropdown'],
                    'pluginOptions' => ['allowClear' => true]
                ]) ?>
            </div>
            <div class="col-md-4">
                <!-- City Select2 -->
                <?= $form->field($model, 'city_id')->widget(Select2::class, [
                    'data' => [],
                    'options' => ['placeholder' => 'Select City', 'id' => 'city-dropdown'],
                    'pluginOptions' => ['allowClear' => true]
                ]) ?>
            </div>
            <div class="col-md-4">
                <!-- City Select2 -->
                <?= $form->field($model, 'barangay_id')->widget(Select2::class, [
                    'data' => [],
                    'options' => ['placeholder' => 'Select Barangay', 'id' => 'barangay-dropdown'],
                    'pluginOptions' => ['allowClear' => true]
                ]) ?>
            </div>

            <div class="col-12 mt-4">
                <?= Html::submitButton('Register', ['class' => 'btn btn-success px-4']) ?>
                <?php if(Yii::$app->user->can('manageUsers')) : ?>
                    <?= Html::a('Cancel', '/user/admin', ['class' => 'btn btn-secondary']) ?>
                <?php else : ?>
                    <p class="small fw-bold mt-2 pt-1 pb-3">Already have an account? <?= Html::a('Login', 'login', ['class' => 'link-danger']) ?></p>
                <?php endif; ?>
            </div>

            <?php ActiveForm::end(); ?>
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

    // Load Cities when Province changes
    $('#province-dropdown').change(function() {
        var provinceId = $(this).val();
        $.get("/user/dropdown/cities-by-province", { province_id: provinceId }, function(data) {
            $('#city-dropdown').empty().append('<option value="">Select City</option>');
            $.each(data, function(index, item) {
                $('#city-dropdown').append($('<option>', { value: '', text: '' }));
                $('#city-dropdown').append($('<option>', { value: item.id, text: item.text }));
            });
        }, 'json');
    });

    // Load Barangays when City changes
    $('#city-dropdown').change(function() {
        var cityId = $(this).val();
        $.get("/user/dropdown/barangays", { city_id: cityId }, function(data) {
            $('#barangay-dropdown').empty().append('<option value="">Select Barangay</option>');
            $.each(data, function(index, item) {
                $('#barangay-dropdown').append($('<option>', { value: '', text: '' }));
                $('#barangay-dropdown').append($('<option>', { value: item.id, text: item.text }));
            });
        }, 'json');
    });
});
JS;
$this->registerJs($script);
?>