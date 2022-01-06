<?php
/*
Plugin Name: Evenements
Plugin URI: https://www.destination.com
Description: Des evenements de l'Estrie
Author: Jonathan Moreau, Emilia Ashraghi, Valérie Larouche, Marko Drca
Version: 1.0
Author URI: https://www.destination.com
*/


add_action('init', 'registerCPTEvenement');

function registerCPTEvenement(){
    $labels = array( 
        'name' => 'Evenement',
        'all_items' => 'Toutes les evenements', 
        'singular_name' => 'Evenement',
        'add_new_item' => 'Ajouter un evenement',
        'edit_item' => 'Modifier un evenement',
        'menu_name' => 'Evenement Menu' );

        

    $args = array(  
        'labels' => $labels,                          // Voir tableau ci-dessus
        'public' => true,                             // Permet l’affichage de ce type de contenu (pas juste backend)
        'show_in_rest' => true,                       // Ajoute le CPT à l’API et permet l’utilisation de Gutengerg
        'has_archive' => true,                        // true = type article
        'supports' => array( 'title', 'editor', 'thumbnail'),     // Ce que le CPT inclus
        'menu_position' => 5,                         // Emplacement dans le menu WP
        'menu_icon' => 'dashicons-clipboard',);
        
    register_post_type( 'evenement', $args );

    add_theme_support( 'post-thumbnails' );

    flush_rewrite_rules();
}


 
/**
 * Activate the plugin.
 */
function evenement_activate() { 
    global $wpdb;
    $wpdb->query("CREATE TABLE IF NOT EXISTS `wp_event_subscriber` (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `id_event` bigint(20) unsigned DEFAULT NULL,
        `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
        `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
        `courriel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
        PRIMARY KEY (`ID`),
        KEY `fk_event` (`id_event`),
        CONSTRAINT `fk_event` FOREIGN KEY (`id_event`) REFERENCES `wp_posts` (`ID`) ON UPDATE CASCADE
       ) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
}

register_activation_hook( __FILE__, 'evenement_activate' );

/**
 * Deactivate the plugin.
 */
function evenement_deactivate() { 
    //global $wpdb;
    //$wpdb->query($wpdb->prepare("DROP TABLE {$wpdb->prefix}quizz")); 
}

register_deactivation_hook( __FILE__, 'evenement_deactivate' );


/* À ajouter dans labo */
add_filter('single_template', 'my_custom_template');
add_filter('archive_template', 'my_custom_template1');
 
function my_custom_template1($archive) {
 
    global $post;
 
    /* Checks for single template by post type */
    if ( $post->post_type == 'evenement' && !locate_template( array( 'archive-evenement.php' ) ) !== $archive  ) {
        if ( file_exists(plugin_dir_path( __FILE__ ) . 'template/archive-evenement.php' ) ) {
            return plugin_dir_path( __FILE__ ) . 'template/archive-evenement.php';
        }
    }
 
    return $archive;
    
}
function my_custom_template($single) {

    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'evenement' && locate_template( array( 'single-evenement.php' ) ) !== $single  ) {
        if ( file_exists(plugin_dir_path( __FILE__ ) . 'template/single-evenement.php' ) ) {
            return plugin_dir_path( __FILE__ ) . 'template/single-evenement.php';
        }
    }

    return $single;

}

