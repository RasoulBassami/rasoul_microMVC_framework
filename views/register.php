<main class="container col-12 col-md-6 text-left">

  <div class="text-center mb-4">
    <a href="/">
      <img class="mb-4" src="<?= $this->getPublicDir(); ?>img/bootstrap-logo.svg" alt="" width="72" height="57">
    </a>
    <h1 class="h3 fw-normal">Register Form</h1>
    <hr>
  </div>


  <?php $form = App\Core\Forms\Form::begin('', 'post'); ?>

    <div class="row g-3">
      <div class="col-sm-6">
        <?= $form->input($model, 'firstName');?>
      </div>
      <div class="col-sm-6">
        <?= $form->input($model, 'lastName');?>
      </div>
    </div>

    <?= $form->input($model, 'email')->emailInput();?>
    <?= $form->input($model, 'password')->passwordInput();?> 
    <?= $form->input($model, 'confirmPassword')->passwordInput();?>

    <button class="w-100 mt-3 btn btn-primary btn-lg" type="submit">Register Now</button>
  <?php $form::end(); ?>
</main>