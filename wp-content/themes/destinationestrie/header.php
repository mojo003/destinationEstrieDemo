<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <?php wp_head(); ?>
</head>
<body>
  <header>
    <h1>Bienvenue sur Destination Estrie !</h1>
      <nav id="navigation"> 
      <?php
        wp_nav_menu( 
          array(
              'theme_location' => 'main-menu', 
              'menu_id' => 'primary-menu',
          ) 
        ); 
      ?> 
    </nav>

  </header>
