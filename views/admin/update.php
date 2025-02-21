<?php
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Change Password';
?>

<div class="user-update">
    <h5><?= Html::encode($this->title) ?></h5>

    <div class="card shadow-lg" style="border-top: 7px solid #747474;">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'username')->textInput(['disabled' => true]) ?></div>
                <div class="col-md-6">
                    <?= $form->field($model, 'email')->input('email', ['disabled' => true]) ?>
                </div>
            </div>

            <!-- Old Password Field -->
            <?= $form->field($model, 'old_password')->passwordInput(['autocomplete' => 'off']) ?>

            <!-- New Password Field -->
            <?= $form->field($model, 'new_password')->passwordInput(['id' => 'new-password', 'autocomplete' => 'off']) ?>

            <!-- Confirm Password -->
            <?= $form->field($model, 'confirm_password')->passwordInput(['autocomplete' => 'off']) ?>

            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
