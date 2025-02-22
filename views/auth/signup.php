<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

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
                <?= $form->field($model, 'barangay')->textInput(['placeholder' => 'Enter barangay']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'city')->textInput(['placeholder' => 'Enter city']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'province')->textInput(['placeholder' => 'Enter province']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'region')->textInput(['placeholder' => 'Enter region']) ?>
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
