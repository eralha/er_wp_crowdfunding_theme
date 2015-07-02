<!doctype html>
<?php 
  global $_account;
  global $_carrinho;
?>
<!--[if IE 7]>    <html class="oldie ie7" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="oldie ie8" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="pt"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
  <title><?php bloginfo('name'); ?><?php wp_title (); ?></title>
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="description" content="">
  
  <!-- fb opengraph -->
  <meta property="og:title" content="">
  <meta property="og:description" content="">
  <meta property="og:image" content="">
  
  <!-- favicon -->
  

  <meta name="viewport" content="width=device-width">
  <!-- <link rel="stylesheet" href="css/style.css">-->

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <!-- Bootcards CSS for desktop: -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootcards/1.0.0/css/bootcards-desktop.min.css">

  <!-- [production] remove -->
  <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet/less" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/style.css?v=2">
  <script src="<?php echo get_stylesheet_directory_uri();?>/js/libs/less.js"></script>

  <link href="<?php echo get_stylesheet_directory_uri();?>/css/summernote.css?v=1" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="/js/libs/jquery-1.7.2.min.js"><\/script>')</script>
  
  <!-- [production] minify - http://jscompress.com/ -->
  <script src="<?php echo get_stylesheet_directory_uri();?>/js/plugins.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri();?>/js/main.js"></script>

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script src="<?php echo get_stylesheet_directory_uri();?>/js/summernote.min.js"></script>

  

</head>
<body><div>
<!--[if lt IE 7]>  
  <div class="chromeframe">O seu browser de internet é <b>muito</b> antigo. <a href="http://browsehappy.com/">Actualize para um mais recente</a> ou <a href="http://www.google.com/chromeframe/?redirect=true&hl=pt-PT&quickenable=true">instale a Google Chrome Frame</a> para uma melhor experiência.</div><![endif]-->

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><i class="fa fa-users"></i> Crowdfunding Social</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

          <?php
              require_once('wp_nav_walker.php');
              wp_nav_menu( array(
                  'menu'              => 'primary',
                  'theme_location'    => 'primary-menu',
                  'depth'             => 2,
                  'menu_class'        => 'nav navbar-nav',
                  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                  'walker'            => new wp_bootstrap_navwalker())
              );
          ?>
          
          <div class="navbar-right">
            <?php
              $uinfo = get_userdata(get_current_user_id());

              if(!is_user_logged_in()){
            ?>
              <form class="navbar-form" name="loginform" id="loginform" action="<?php echo get_bloginfo('url'); ?>/wp-login.php" method="post">
                <div class="form-group">
                  <input type="text" name="log" id="user_login" placeholder="Utilizador" size="20" tabindex="10" class="form-control">
                </div>
                <div class="form-group">
                  <input type="password" name="pwd" id="user_pass" size="20" tabindex="20" placeholder="Password" class="form-control">
                  <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                </div>
                <button type="submit" name="wp-submit" id="wp-submit" class="btn btn-success">Entrar</button>
                <a href="<?php echo $_account->path;?>"><div type="submit" class="btn btn-info">Registo</div></a>
              </form>

            <?php }else{?>
              <div class="navbar-form">
                <a href="<?php echo $_account->path;?>"><button type="submit" class="btn btn-info">A minha conta</button></a>
                <a href="<?php echo $_carrinho->path;?>"><button type="submit" class="btn btn-info">Doações</button></a>
                <a href='<?php echo wp_logout_url(get_home_url());?>'><button type="submit" class="btn btn-info">Sair</button></a>
              </div>
            <?php }?>
          </div><!--/.nav-right-->

        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
      </div>
    </div>