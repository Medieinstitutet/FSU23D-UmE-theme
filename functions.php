<?php

//add_filter( 'show_admin_bar', '__return_false' );

function mt_enqueue_styles() {
    // Registrera huvud stylesheet
    wp_enqueue_style( 'mt-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'mt_enqueue_styles' );