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
            <?= Html::img('https://img.freepik.com/premium-vector/account-login-password-data-protection-cyber-security-online-registration-confidentiality_501813-2095.jpg', [
              'class' => 'img-fluid d-block mx-auto p-1',
              'alt' => 'Sample image',
              'width' => '300'
            ]) ?>
          </div>
          <div class="col-md-12">
            <div data-mdb-input-init class="form-outline">
              <?= $form->field($model, 'username')->textInput() ?>
            </div>
            <div class="position-relative">
              <?= $form->field($model, 'password', [
                'template' => '{label}{input}<i id="togglePassword" class="fa fa-eye password-toggle float-end"></i>{error}{hint}'
              ])->passwordInput(['id' => 'passwordInput', 'class' => 'form-control pr-5']) ?>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <?= $form->field($model, 'rememberMe')->checkbox() ?>
              <?= Html::a('Forgot password?', ['/user/auth/forgot-password'], ['class' => 'text-body']) ?>
            </div>
            <div class="text-center text-lg-start">
              <?= Html::submitButton('Login', ['class' => 'btn btn-primary px-4']) ?>
              <p class="small fw-bold mt-2 pt-1 pb-3">Don't have an account? <?= Html::a('Register', 'signup', ['class' => 'link-danger']) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?> 
</section>
<style>
.password-toggle {
    position: absolute;
    right: 10px;
    top: 52px; 
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
    color: #888;
}
.password-toggle:hover {
    color: #333;
}
</style>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    let passwordInput = document.getElementById('passwordInput');
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
});
</script>