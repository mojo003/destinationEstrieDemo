<?php get_header(); ?>                        <!--appel à la fonction get_header() -->
 
<div class="wrapper">
  <p class="where"> Vous êtes sur l'index.php</p>
  <?php
    if ( have_posts() ) {                       //Vérifie s’il y a des articles à afficher.
      // Load posts loop.
      while ( have_posts() ) {                  //Tant qu'il y a des articles à afficher.
        the_post();                            //Charge l’article
        ?> 
          <div class ='article-extrait'>
              <h2><?php the_title(); ?></h2>
              <p><?php  the_content(); ?></p>    <!--Affiche l’extrait de l’article -->
               <?php 
            $image = get_field('image');
            if( !empty( $image ) ): 
              ?>
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
              <?php 
            endif; 
          ?>
              
          </div>
        <?php   
      }
    } else {
      echo "Pas d'article :'(";                   //Si pas d’article…
    } ?>
    <?php
  
  if ( is_front_page() ) :
    // The Query
    $args = array('post_type' => 'evenement', 'posts_per_page' => 3);
    $the_query = new WP_Query( $args );
 
    if ( $the_query->have_posts() ) {                       //Vérifie s’il y a des articles à afficher.
      // Load posts loop.
      while ( $the_query->have_posts() ) {                  //Tant qu'il y a des articles à afficher.
        $the_query->the_post();                            //Charge l’article
        ?> 
        <hr />

         
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
 
  
        </div>
          
        <?php   
      }
 
    } else {
      echo "Pas d'article :'(";                   //Si pas d’article…
    } ?>
 
    <a class="button" href="http://localhost/wptp/evenement/">Voir tous les événements</a>
    <?php   
  else :
    
  endif;
  
  ?>
  
 
</div>
 
<?php get_footer(); ?>                          <!--appel à la fonction get_footer() -->