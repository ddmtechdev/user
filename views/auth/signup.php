<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Signup';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>
