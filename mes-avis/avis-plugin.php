<?php

declare(strict_types=1);
/*
Plugin Name: Mon Plugin d'Avis
Description: Ajoute un type de contenu "Avis" personnalisé à WordPress.
Version: 1.0
Author: Votre Nom
*/

function creer_type_de_contenu_avis()
{
    $labels = [
        'name'               => 'mes avis',
        'singular_name'      => 'Avis',
        'plural_name'        => 'mes avis',
        'menu_name'          => 'Mes avis',
        'add_new'            => 'Ajouter un avis',
        'add_new_item'       => 'Ajouter un nouvel avis',
        'edit_item'          => 'Modifier l\'avis',
        'new_item'           => 'Nouvel avis',
        'view_item'          => 'Voir l\'avis',
        'view_items'         => 'Voir les avis',
        'search_items'       => 'Rechercher des avis',
        'not_found'          => 'Aucun avis trouvé',
        'not_found_in_trash' => 'Aucun avis trouvé dans la corbeille',
        'all_items'          => 'Tous les avis',
        'archives'           => 'Archives des avis',
        'attributes'         => 'Attributs des avis',
    ];

    $args   = [
        'labels'        => $labels,
        'public'        => true,
        'menu_position' => 1,
        'menu_icon'     => 'dashicons-star-empty', // Icône de l'administration (étoile)
        'supports'      => ['title', 'editor', 'author', 'thumbnail', 'custom-fields'],
    ];

    register_post_type('avis', $args);
}
add_action('init', 'creer_type_de_contenu_avis');

function modifier_titre_archive_avis($title)
{
    if (is_post_type_archive('avis'))
    {
        $title = 'Mes avis';
    }
    return $title;
}
add_filter('post_type_archive_title', 'modifier_titre_archive_avis');
