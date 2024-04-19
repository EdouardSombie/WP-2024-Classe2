<?php
// Logique du thème

// Intégrer la feuille de style principale

/**
 * Proper way to enqueue scripts and styles
 */
function esgi_enqueue_assets()
{
    wp_enqueue_style('main', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'esgi_enqueue_assets');
