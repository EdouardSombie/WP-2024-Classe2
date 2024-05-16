<?php
// Logique du thème

// Intégrer la feuille de style principale
add_action('wp_enqueue_scripts', 'esgi_enqueue_assets');
function esgi_enqueue_assets()
{
    wp_enqueue_style('main', get_stylesheet_uri());
}



// Ajout des supports au thème
add_action('after_setup_theme', 'esgi_theme_setup');
function esgi_theme_setup()
{
    add_theme_support('custom-logo');
}


add_action('after_setup_theme', 'esgi_register_nav_menu', 0);
function esgi_register_nav_menu()
{
    register_nav_menus([
        'primary_menu' => __('Primary Menu', 'ESGI'),
        'footer_menu'  => __('Footer Menu', 'ESGI'),
    ]);
}
