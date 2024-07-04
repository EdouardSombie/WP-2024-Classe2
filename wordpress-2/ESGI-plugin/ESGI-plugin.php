<?php
/*
Plugin Name: Extension ESGI
Plugin URI: https:esgi.fr
Description: Petit module de démo (ajout d'un type de publication "Projet")
Author: ESGI Team
Version: 1.0
Author URI: https:esgi.fr
*/

class ESGIPlugin
{

    public function __construct()
    {
        // Ajout d'un type de post custom
        // Callback à l'intérieur d'une classe sous forme de tableau [class, method]
        add_action('init', ['ESGIPlugin', 'registerProject']);
    }

    public static function registerProject()
    {
        $labelsProject = array(
            'name' => __('Projets'),
            'singular_name' => __('Projet'),
            'all_items' => __('Tous les projets'),
            'add_new' => __('Ajouter un projet', 'Projets'),
            'add_new_item' => __('Ajouter un projet'),
            'edit_item' => __('Modifier un projet'),
            'new_item' => __('Nouveau projet'),
            'view_item' => __('Voir le projet'),
            'search_items' => __('Rechercher parmi les projets'),
            'not_found' => __('Aucun projet trouvé'),
            'not_found_in_trash' => __('Aucun projet trouvé dans la corbeille'),
            'parent_item_colon' => ''
        );

        $argsProject = array(
            'labels' => $labelsProject,
            'public' => true,
            'has_archive' => true, // Set to false hides Archive Pages
            'menu_icon' => 'dashicons-media-code', //pick one here ~> https://developer.wordpress.org/resource/dashicons/
            'rewrite' => array('slug' => 'projet'),
            //'taxonomies' => array( 'post_tag' ),
            'query_var' => true,
            'menu_position' => 1,
            'publicly_queryable' => true, // Set to false hides Single Pages
            'supports' => array('thumbnail', 'title', 'editor', 'custom-fields'),
            'show_in_rest' => true
        );

        register_post_type('project', $argsProject);
    }
}

$plugin = new ESGIPlugin();
