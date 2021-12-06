<main class="container col-12 col-md-6 text-left">
    <div class="text-center mb-4">
      <a href="/">
        <img class="mb-4" src="<?= $this->getPublicDir(); ?>img/bootstrap-logo.svg" alt="" width="72" height="57">
      </a>
      <h1 class="h3 fw-normal">Register Form</h1>
      <hr>
    </div>

  <form action="" method="post">
    <div class="row g-3">
      <div class="col-sm-6">
        <label class="form-label">First name</label>
        <input type="text" name="firstName" class="form-control" placeholder="" value="" required="">
        <div class="invalid-feedback">
          Valid first name is required.
        </div>
      </div>

      <div class="col-sm-6">
        <label class="form-label">Last name</label>
        <input type="text" name="lastName" class="form-control" placeholder="" value="" required="">
        <div class="invalid-feedback">
          Valid last name is required.
        </div>
      </div>

      <div class="col-12">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="you@example.com">
        <div class="invalid-feedback">
          Please enter a valid email address for shipping updates.
        </div>
      </div>

      <div class="col-12">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required="">
        <div class="invalid-feedback">
          Please enter your Password.
        </div>
      </div>

      <div class="col-12">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control" required="">
        <div class="invalid-feedback">
          Please enter your Password.
        </div>
      </div>

    <button class="w-100 btn btn-primary btn-lg" type="submit">register</button>
  
  </form>
</main>