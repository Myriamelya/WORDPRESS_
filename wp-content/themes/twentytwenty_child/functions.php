<?php

// Action qui permet de charger des scripts dans le thème child
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles() {
    // Chargement du style.css du thème parent Twenty Twenty
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');    
    //Chargement de theme.css pour la personnalistion css
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
}



/***** HOOK MENU *****/


function add_admin_menu_item($items, $args) 
{
    // Vérifie si c'est le bon menu
    if ( $args->theme_location == 'primary' ) {
    // SI l'utilisateur est un administrateur
    if ( current_user_can ('administrator') ) {
        
        $menu_items = explode ('</li>', $items); // Divise les items en tableau (soit Nous rencontrer = 0,et Commander = 1) avec '</li>' comme point de rupture, donc le 1er item
        $menu_items = array_filter ($menu_items); // !Supprime les éléments vides dus à l'explosion!
        $menu_items_count = count ($menu_items); // !Je suppose; Donne la valeur numérique aux items!
        $middle_index = ceil ($menu_items_count / 2); // Calcule le milieu du menu

        $new_item = '<li class="admin"><a href="#">Admin</a></li>'; // Construit le nouvel item

        array_splice ($menu_items, $middle_index, 0, $new_item); // Insère le nouvel item au milieu du menu
        $items = implode ('</li>', $menu_items) . '</li>'; // Fusionne les parties du menu pour former le nouveau
    }
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_admin_menu_item', 10, 2);
