<?php use App\Core\Application; ?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">

    <!-- Bootstrap core CSS -->
<link href="<?= $this->getPublicDir(); ?>lib/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="icon" href="<?= $this->getPublicDir(); ?>img/favicon.ico">
<meta name="theme-color" content="#7952b3">

  <!-- Custom styles for this template -->
  <link href="<?= $this->getPublicDir(); ?>css/style.css" rel="stylesheet">
  <title><?= $this->title; ?></title>

</head>

<body class="d-flex h-100 text-center text-white bg-dark">
    
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <div>
        <h3 class="float-md-start mb-0">Rasoul Bassami</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
          <a class="nav-link" href="/contact">Contact</a>
          <?php if(Application::isGuest()): ?>
            <a class="nav-link" href="/login">login</a>
          <?php else: ?>
            <a class="nav-link" href="/profile">
              <?= Application::$app->user->displayName(); ?>
            </a>
            <a class="nav-link" href="/logout">Logout</a>
          <?php endif; ?>
        </nav>
      </div>
    </header>