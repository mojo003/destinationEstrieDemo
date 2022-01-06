<?php
get_header();
$id = get_the_ID();
?>

<div class="wrapper">
  <p class="where">Vous êtes sur single-evenement.php</p>

  <?php
  $value = get_field( "limite_admission" );
  global $wpdb;
  $limite = $wpdb->get_results($wpdb->prepare("SELECT count(*) as subscriptions FROM wp_event_subscriber where id_event = $id", $output = ARRAY_A));
  $subscr = $limite[0]->subscriptions;

    if ( have_posts()) {
      // Load posts loop.
      while (have_posts()) {
        the_post(); ?>

        <div class="article-extrait">
        <div class="single-center">
          <h2><?php the_title(); ?></h2>
          
          <p><?php the_content(); ?></p>
          <h3>Détail de l'événement:</h3></div>
          <ul>
        
            <li>Date: <?php the_field('date'); ?></li>
        
            <li>Lieu: <?php the_field('lieu'); ?></li>
        
            <li>Limite admission: <?php the_field('limite_admission'); ?></li>
        
            <li>Coût: <?php the_field('prix'); ?>$</li>
    
          </ul>

          <hr />

        </div>
      <?php  
      if( $value > $subscr) {
        global $wpdb;
        $limite = $wpdb->get_results($wpdb->prepare("SELECT count(*) FROM wp_event_subscriber where id_event = $id", $output = ARRAY_A));
        ?>
        <div id="form">
          <h2>M'inscrire à l'événement</h2>
          <form action="" method="POST" class="form" onsubmit="setTimeout(function(){window.location.reload();},10);">
            <label for="prenom">Prenom:</label>
            <input type="text" name="prenom" id="prenom" />
            <br />
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" />
            <br />
            <label for="courriel">Courriel:</label>
            <input type="email" name="courriel" id="courriel" />
            <br />
            <input type="submit" value="Confirmer" onclick="saveSubscriber()"/> 
          </form>
        </div>
      <?php
      if (isset ($_POST['submit'])) {
        $nom = (! empty($_POST['nom'])) ? sanitize_text_field( $_POST['nom'] ) : '';
        $prenom = (! empty($_POST['prenom'])) ? sanitize_text_field( $_POST['prenom']) : '';
        $courriel = (! empty($_POST['courriel'])) ? sanitize_text_field( $POST['courriel']) : '';
        $id = get_the_ID();
      }
      } else {
        echo "<h2>M'inscrire à l'événement</h2>";
        echo "<p>Désolé les inscriptions sont fermées</p>";
        }
  }
    } else {
      echo "Pas d'article :'(";
    } 
  ?>
</div>
  <?php get_footer(); ?>
</body>
</html>