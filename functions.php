<?php

//add_filter( 'show_admin_bar', '__return_false' );

function mt_enqueue_styles() {
    // Registrera huvud stylesheet
    wp_enqueue_style( 'mt-style', get_stylesheet_uri() );

}

add_action( 'wp_enqueue_scripts', 'mt_enqueue_styles' );


function mt_register_my_menu() {
    register_nav_menu('header-menu', __( 'Header Menu' ));
}
add_action( 'init', 'mt_register_my_menu' );

function mt_create_form() {

    $options = '<option value="23">Ris</option>
    <option value="25">Lax</option>';
    $products = apply_filters('create_form_products', array(23 => __('Ris', 'mt'), 25 => __('Lax', 'mt')));
    $options = apply_filters('create_form_html_options', $options, $products);

    $fields = ' <input name="title" />
                <textarea name="description"></textarea>
                <select name="products[]" multiple>
                    '.$options.'
                </select>
                <input type="submit" />';
    
                $fields = apply_filters('create_form_html_field', $fields);


    $output = '<form method="'.apply_filters('create_form_html_form_method', 'POST').'" action="'.apply_filters('create_form_html_form_action', '').'">
               '.$fields.'
            </form>';

    $output = apply_filters('create_form_html', $output);

    echo($output);
}

add_action('create_form', 'mt_create_form');

function mt_output_create_form() {
    do_action('before_create_form');
    do_action('create_form');
    do_action('after_create_form');
}

add_action('output_create_form', 'mt_output_create_form');