<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
?>

<?= $form->field($model, 'username')->textInput() ?>
<?= $form->field($model, 'email')->input('email') ?>
<?= $form->field($model, 'password_hash')->passwordInput() ?>
<?= $form->field($model, 'status')->dropDownList([10 => 'Active', 0 => 'Blocked']) ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
