<?php
get_header();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mon premier thème</title>
  <?php wp_head(); ?>
</head>
<body>
 
<div class="wrapper">
  <p class="where">Vous êtes sur archive-evenement.php</p>
 
  <?php
 
    if ( have_posts()) {
      // Load posts loop.
      while (have_posts()) {
        the_post(); ?>
 
            <div class="article-extrait">
            <h2 class="titre-evenement"><?php the_title(); ?></h2>
              <a href="<?php the_permalink(); ?>"><p class="excerpt_event"><?php the_post_thumbnail('medium'); ?></p></a>
              <p><?php the_excerpt(); ?></p>
              <p><?php the_field('date'); ?></p>
              <p><?php the_field('lieu'); ?></p>
              <p><?php the_field('limite_admission'); ?> personne maximum.</p>
              <p><?php the_field('est-ce_payant'); ?></p>
              <p><?php the_field('prix'); ?>$</p>
              <a href="<?php the_permalink(); ?>">En savoir plus</a>
 
          <hr />
        </div>
      <?php  
      }
    } else {
      echo "Pas d'article :'(";
    } 
  ?>
</div>
 
  <?php get_footer(); ?>
</body>
</html>