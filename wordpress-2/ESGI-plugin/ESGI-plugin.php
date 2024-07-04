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

        // Définition des templates par défaut
        add_filter('template_include', ['ESGIPlugin', 'setTemplate']);

        // Déclaration des shortcodes
        add_shortcode('skills-list', ['ESGIPlugin', 'showSkills']);
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
            'taxonomies' => array('skill'),
            'query_var' => true,
            'menu_position' => 1,
            'publicly_queryable' => true, // Set to false hides Single Pages
            'supports' => array('thumbnail', 'title', 'editor', 'custom-fields'),
            'show_in_rest' => true
        );

        register_post_type('project', $argsProject);

        // Définition d'une taxonomie custom
        $labelsTaxonomy = array(
            'name'              => 'Skills',
            'singular_name'     => 'Skill',
            'search_items'      => 'Rechercher parmi les skills',
            'all_items'         => 'Tous les skills',
            'edit_item'         => 'Modifier le skill',
            'update_item'       => 'Mettre à jour',
            'add_new_item'      => 'Nouveau skill',
            'menu_name'         => 'Skills',
        );

        $argsTaxonomy = array(
            'hierarchical'      => true,
            'labels'            => $labelsTaxonomy,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'skill'),
            'show_in_rest'      => true
        );

        register_taxonomy('skill', 'project', $argsTaxonomy);
    }

    public static function setTemplate($template)
    {
        if (is_single() && get_queried_object()->post_type == 'project') {
            if (!file_exists(get_template_directory() . '/single-project.php')) {
                $template = __DIR__ . '/templates/project.php';
            }
        }


        if (is_tax() && get_queried_object()->taxonomy == 'skill') {
            $template = __DIR__ . '/templates/skill.php';
        }

        return $template;
    }

    public static function showSkills($args)
    {
        $html = '';
        if (!empty($args['title'])) {
            $html .= '<h3>' . $args['title'] . '</h3>';
        }
        $args = [
            'taxonomy'   => 'skill',
            'hide_empty' => false,
        ];
        $skills = get_terms($args);
        if (!empty($skills)) {
            $html .= '<ul>';
            foreach ($skills as $s) {
                $html .= '<li><a href="' . get_term_link($s) . '">' . $s->name . '</a></li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }
}

$plugin = new ESGIPlugin();
