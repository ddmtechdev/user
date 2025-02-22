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
        <div class="row">
          <div class="col-md-12">
            <?= \yii\helpers\Html::img('https://img.freepik.com/premium-vector/account-login-password-data-protection-cyber-security-online-registration-confidentiality_501813-2095.jpg', [
              'class' => 'img-fluid d-block mx-auto p-1',
              'alt' => 'Sample image',
              'width' => '300'
            ]) ?>
          </div>
          <div class="col-md-12">
            <div data-mdb-input-init class="form-outline">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="text-center text-lg-start mt-4 pt-2">
              <?= Html::submitButton('Send Reset Link', ['class' => 'btn btn-primary px-4']) ?>
              <p class="small fw-bold mt-2 pt-1 pb-3">Go <?= \yii\helpers\Html::a('Back', 'login', ['class' => 'link-primary']) ?> to login page</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?> 
</section>