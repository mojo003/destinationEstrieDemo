<?php
get_header();
?>

<div class="wrapper">
  <p class="where">Vous êtes sur single.php</p>

  <?php

    if ( have_posts()) {
      // Load posts loop.
      while (have_posts()) {
        the_post(); ?>

        <div class="article-extrait">
          <h2><?php the_title(); ?></h2>
          <p><?php the_content(); ?></p>
          <hr />
        </div>
      <?php  
      }
    } else {
      echo "Pas d'article :'(";
    } 
  ?>
</div>

  <?php wp_footer(); get_footer(); ?>
