<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $title ?></title>


    <link rel="apple-touch-icon" sizes="180x180" href="/public/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/public/img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/public/img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/public/img/favicons/safari-pinned-tab.svg" color="#006df0">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap -->
    <link href="/assets/components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

    <link href="/assets/components/chosen-bootstrap/chosen.bootstrap.min.css" rel="stylesheet">
    <link href="/assets/components/star-rating/rating.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container-fluid">

      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
              <img alt="Mediatik" src="<?= $app_logo_url ?>" height="20" width="20" class="pull-left" style="margin-right: 4px" /> <?= $app_name ?>
            </a>
          </div>


          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if($user_is_logged_in): ?>
            <ul class="nav navbar-nav">
              <li><a href="/index.php/auth/index">Utenti</a></li>
              <li><a href="/index.php/journalists">Giornalisti</a></li>
              <li><a href="/index.php/journalistic-heads">Testate</a></li>
              <li><a href="/index.php/categories">Categorie</a></li>
              <li><a href="/index.php/media-types">Media</a></li>
              <!-- <li><a href="/index.php/news">Notizie</a></li> -->
            </ul>
            <?php endif; ?>
            <ul class="nav navbar-nav navbar-right">
              <?php
                if($user_is_logged_in) {
              ?>
                <li><a href="/index.php/auth/logout">Logout</a></li>
              <?php }
                else { ?>
                <li><a href="/index.php/auth/login">Login</a></li>
              <?php } ?>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-info"> <?= $this->session->flashdata('message') ?> </div>
      <?php } ?>
      <?php if ($this->session->flashdata('success_message')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success_message') ?> </div>
      <?php } ?>
      <?php if ($this->session->flashdata('error_message')) { ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('error_message') ?> </div>
      <?php } ?>

      <?php if($title): ?>
      <div class="page-header">
          <h1><?= $title ?></h1>
      </div>
      <?php endif; ?>
