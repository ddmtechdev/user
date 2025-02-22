<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>
<section class="vh-100">
<?php $form = ActiveForm::begin(); ?>
  <div class="container-fluid h-custom">
    <div class="pt-5 pb-5">
      <div class="col-md-12 col-lg-12 col-xl-4 offset-xl-4 p-3 card shadow-lg" style="border-top: 7px solid #0d6efd">
        <h6>Change Password <?php if(Yii::$app->user->can('manageUsers') && Yii::$app->request->get('id')){
            echo 'for: '. $model->getUsername(Yii::$app->request->get('id'));
        } ?></h6><hr>
        <div class="row">
            <?php if (!$isAdmin): ?>  
                <?= $form->field($model, 'current_password')->passwordInput() ?>
            <?php endif; ?>
            <?= $form->field($model, 'new_password')->passwordInput() ?>
            <?= $form->field($model, 'confirm_password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Cancel', Yii::$app->request->referrer, ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?> 
</section>