<?php

function init_template(){

    add_theme_support('post-thumbnails'); /* dentro de una entrada de pagina poner una destacada */
    add_theme_support( 'title-tag'); /* título de pestaña */

    //Barra de menú
    register_nav_menus(
        array(
            'top_menu' => 'Menú principal'
        )
    );
}

/* img  880 x 860 */ 
add_action( 'after_setup_theme', 'init_template' ); /* hooks, porque no se puede modificar codigo de wordpress, ejecute las opciones */

function assets(){ //Función para cargar librerías

    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', '', '5.3.2', 'all');/* Librerias */
    wp_register_style( 'Josefin Sans', 'https://fonts.googleapis.com/css2?family=Delius&family=Josefin+Sans:wght@300&display=swap', '', '1.0', 'all');

    wp_enqueue_style( 'estilos', get_stylesheet_uri(), array('bootstrap', 'Josefin Sans'), '1.0', 'all');

    wp_register_script('popper','https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js','','2.11.6',true);/* true, para que se ejecute en el footer */

    wp_enqueue_script('bootstraps','https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',array('popper'),'5.3.2',true);

    wp_enqueue_script('custom',get_template_directory_uri().'/assets/js/custom.js','1.0.0',true);

};

add_action('wp_enqueue_scripts', 'assets');

function sidebar(){
    register_sidebar(
        array(
            'name' => 'Pie de página',
            'id' => 'footer', 
            'description' => 'Zona de Widgets',
            'before_title' => '<p>',
            'after_title' => '</p>',
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>'
        )
    );
};

add_action('widgets_init', 'sidebar');

function productos_type(){

    $labels = array(
        'name' => 'Productos',
        'singular_name' => 'Producto',
        'menu_name' => 'Productos'
    );
    $args = array(
        'label' => 'Productos',
        'description' => 'Productos de Tienda Zafiro',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'public' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'can_export' => true,
        'publicly_queryable' => true,
        'rewrite' => true,
        'show_in_rest' => true
    );
    register_post_type('producto', $args);
}

add_action('init', 'productos_type');






