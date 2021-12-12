<main class="form-signin">
    <a href="/">
      <img class="mb-4" src="<?= $this->getPublicDir(); ?>img/bootstrap-logo.svg" alt="" width="72" height="57">
    </a>
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <hr>

    <!-- <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div> -->


  <?php $form = App\Core\Forms\Form::begin('', 'post'); ?>
    <?= $form->input($model, 'email')->emailInput();?>
    <?= $form->input($model, 'password')->passwordInput();?> 

    <div class="checkbox mb-3">
      dont have an account?
      <a href="/register">Register here!</a>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  <?php $form::end(); ?>
</main>