<main class="px-3 mt-1 mb-3 text-left">
  <h1 class="mb-2">Feel free to contact us!</h1>
  <hr>

  <?php $form = App\Core\Forms\Form::begin('', 'post'); ?>
    <div class="mb-3">
      <?= $form->input($model, 'subject');?>
    </div>
    <div class="mb-3">
      <?= $form->input($model, 'email')->emailInput();?>
    </div>
    <div class="mb-3">
      <?= $form->textarea($model, 'body');?>
    </div>

    <button type="submit" class="btn btn-lg btn-secondary fw-bold border-white bg-white mt-2">Submit</button>
  <?php $form::end(); ?>
<!-- <form action="" method="post">

  <div class="mb-3">
    <label class="form-label">Subject</label>
    <input type="text" name="subject" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Body</label>
    <textarea name="body" class="form-control"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form> -->


</main>