<?php
  if( !is_admin() ) {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css');
  }

  register_setting('mes_options', 'my_font_option');

  add_theme_support( 'menu' );

  add_action ( 'after_setup_theme', 'register_my_menu' );

  add_theme_support('title-tag');

  add_action( 'admin_menu', 'addMenu' );

  add_action('admin_init', 'registerMySettings');

  add_action( 'wp_head', 'fontChange', );

  add_action('wp_head', 'addMyBanner');

  add_action('admin_menu', 'addMenuInscriptions');

//Hook permettant d'ajouter l'action qui enregistre les données de la personne qui s'inscrit à un événement
  add_action('wp_head', 'saveSubscriber');


//Ajouter mes options dans la barre WP. 
  function addMenu() {
    add_menu_page( 'Mes options', 'Mes options', 'manage_options', 'mes_options', 'createMesOptionsPage' );
  }

  function addMenuInscriptions() {
    add_menu_page( 'Inscriptions', 'Inscriptions', 'manage_options', 'Inscriptions', 'createInscriptionsPage'); 
  };

  function createMesOptionsPage() {
    ?>
      <h1>Paramètres du site</h1>
      <form action="options.php" method="POST">
        <?php
          settings_fields( 'mes_options' );
          do_settings_sections( 'mes_options' );
          submit_button();

        ?>
      </form>
    <?php  
  }

  function register_my_menu() {
    register_nav_menu ('main-menu', 'Menu principal' );
  }

  // Ajouter la page qui liste toutes les inscriptions aux événements

  function createInscriptionsPage() { 
    ?> 
      <h1>Inscriptions aux événements</h1>
    <?php
  global $wpdb;
  $results = $wpdb->get_results($wpdb->prepare("SELECT post_title, prenom, nom, courriel FROM wp_event_subscriber LEFT JOIN wp_posts ON wp_event_subscriber.id_event = wp_posts.id;", $output = ARRAY_A));
 


  ?> 
  <table id="inscript">
        <thead>
          <tr>
            <th>Evénement</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Courriel</th>
            <th>Supprimer</th>
          </tr>
        </thead>
        <tbody>
  <?php
  foreach($results as $result) {
    $post_title = $result->post_title;
    $nom = $result->nom;
    $prenom = $result->prenom;
    $courriel = $result->courriel;
    ?>
              <tr>
                <td>
                  <?=$post_title ?>
                </td>
                <td>
                  <?=$prenom ?>
                </td>
                <td>
                  <?=$nom ?>
                </td>
                <td>
                  <?=$courriel ?>
                </td>
                <td>
                  <a
                    onclick="return confirm('Voulez-vous vraiment supprimer cette inscription ?')"
                  href="<?=$nom ?>"
                  >
                  ❌
                </td>
              </tr>
          <?php
          } 
      ?>
  </tbody>
    </table>
    <style>
              table {
          width: 80%;
        }
        
        th {
          text-align: left;
        }
        
        tr {
          height: 2em;
        }
        
        thead {
          background-color: #1D2327;
          color: white;
        }
        
        tbody tr:nth-child(odd) {
          background-color:#A7AAAD;
        }
        
        tbody tr:nth-child(even) {
          background-color: #F0F0F1;
        }
    </style>
            <?php 
  }

//Action permettant d'enregistrer les données de la personne qui s'inscrit à un événement
function saveSubscriber() {
  if (isset($_POST['nom']) && 
    isset($_POST['prenom']) && 
    isset($_POST['courriel'])) {  
    global $wpdb;
    $event = get_the_ID(); 
    $wpdb ->insert('wp_event_subscriber', array('prenom' =>$_POST['prenom'], 'nom' => $_POST['nom'], 'courriel' => $_POST['courriel'], 'id_event' => $event));
  } else {
    return;
  }
}

//Enregistrer des fonctions dans 'Mes options'
  function registerMySettings() {
    //*************************************Il va falloir ajouter "URL image en bannière", "URL Facebook" et "Police générale"
    register_setting('mes_options', 'url_image_banniere'); 
    register_setting('mes_options', 'url_facebook');


    add_settings_section( 'mes_options_parametres_section', 'Paramètres', 'createMySection', 'mes_options' );

    add_settings_field( 'my_font_option', 'Police générale', 'changeMyFont', 'mes_options', 'mes_options_parametres_section');
  
    add_settings_section('mes_options_parametres_section', 'Paramètres', 'createMySection', 'mes_options'); 
 
    add_settings_field('url_image_banniere', "URL de l'image en bannière", 'createMyFieldBanner', 'mes_options', 'mes_options_parametres_section' ); 
    
    add_settings_field('url_facebook', "URL Facebook", 'createMyFieldFacebook', 'mes_options', 'mes_options_parametres_section' ); 
  }

  function createMySection() {
    echo "Complétez les paramètres de votre site ici."; 
  }

  function createMyFieldBanner() { 
    ?> 
      <input type="text" name="url_image_banniere", value="<?=get_option('url_image_banniere')?>" style="width:100%" /> 
    <?php 
  }

  function createMyFieldFacebook() { 
    ?> 
      <input type="text" name="url_facebook", value="<?=get_option('url_facebook')?>" style="width:100%" /> 
    <?php 
  }

  function addMyBanner(){
    ?>
      <style class=banner>
          header {
              background-image:url(<?= get_option('url_image_banniere'); ?>);
          }
      </style>
    <?php
  }

  function changeMyFont() {
    ?>
        <select name="my_font_option" id="font">
          <option value="calibri" name="my_font_option">Calibri</option>
          <option value="arial" name="my_font_option">Arial</option>
          <option value="cambria" name="my_font_option">Cambria</option>
          <option value="<?=get_option('my_font_option');?>" name="my_font_option" selected disabled hidden><?=get_option('my_font_option');?></option>
      </select>
    <?php
  }

  function fontChange() {
    ?>
      <style>
        body:not(.wp-admin) { font-family: <?=get_option('my_font_option');?> }
      </style>
  <?php
  }