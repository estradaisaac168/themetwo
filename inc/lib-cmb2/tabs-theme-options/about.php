<?php

/**
 * About section.
 */


$parent_slug = 'themes.php';
$tab_group   = MY_THEME_PREFIX . 'options_tabs';

$about = new_cmb2_box(
    array(
        'id'           => MY_THEME_PREFIX . 'about_options',
        //'title'      => __('About Options', MY_THEME_DOMAIN),
        'object_types' => array('options-page'),
        'option_key'   => MY_THEME_PREFIX . 'about_options',
        'parent_slug'  => $parent_slug, // Menú de Apariencia
        'menu_title'   => __('About', MY_THEME_DOMAIN),
        'capability'   => 'manage_options',
        'tab_group'    => $tab_group,
        'tab_title'    => __('About', MY_THEME_DOMAIN),
    )
);

$about->add_field(
    array(
        'name' => __('About (Nosotros)', MY_THEME_DOMAIN),
        'desc' => __('Configure the about section of the front page.', MY_THEME_DOMAIN),
        'type' => 'title',
        'id'   => MY_THEME_PREFIX . 'about_title',
    )
);

$about->add_field(
    array(
        'name' => __('Show Section', MY_THEME_DOMAIN),
        'id'   => 'about_enable',
        'type' => 'checkbox',
    )
);

$about->add_field(
    array(
        'name' => __('Heading', MY_THEME_DOMAIN),
        'id'   => 'about_heading',
        'type' => 'text',
    )
);

$about->add_field(
    array(
        'name' => __('Description', MY_THEME_DOMAIN),
        'id'   => 'about_description',
        'type' => 'textarea',
    )
);

$about->add_field(
    array(
        'name'         => __('Image', MY_THEME_DOMAIN),
        'desc'         => __('Image of the about section.', MY_THEME_DOMAIN),
        'id'           => 'about_image',
        'type'         => 'file',
        'options'      => array(
            'url' => true,
        ),
        'preview_size' => array(120, 120),
    )
);

$about->add_field(
    array(
        'name'    => __('Image Position (Desktop)', MY_THEME_DOMAIN),
        'desc'    => __('On desktop the image goes to the chosen side. On tablet and mobile the image always appears first.', MY_THEME_DOMAIN),
        'id'      => 'about_image_position',
        'type'    => 'select',
        'options' => array(
            'right' => __('Image right / content left', MY_THEME_DOMAIN),
            'left'  => __('Image left / content right', MY_THEME_DOMAIN),
        ),
        'default' => 'right',
    )
);

$about_points = $about->add_field(
    array(
        'id'         => 'about_points',
        'type'       => 'group',
        'repeatable' => true,
        'options'    => array(
            'group_title'   => __('Point {#}', MY_THEME_DOMAIN),
            'add_button'    => __('Add Point', MY_THEME_DOMAIN),
            'remove_button' => __('Remove', MY_THEME_DOMAIN),
            'sortable'      => true,
            'closed'        => true,
        ),
    )
);

$about->add_group_field(
    $about_points,
    array(
        'name'    => __('Icon', MY_THEME_DOMAIN),
        'desc'    => __('Bootstrap Icon for this point (suggested: check-circle).', MY_THEME_DOMAIN),
        'id'      => 'icon',
        'type'    => 'select',
       // 'options' => themetwo_bootstrap_icons_list(),
        'default' => 'check-circle',
    )
);

$about->add_group_field(
    $about_points,
    array(
        'name' => __('Text', MY_THEME_DOMAIN),
        'id'   => 'text',
        'type' => 'text',
    )
);

$about->add_field(
    array(
        'name' => __('CTA Text', MY_THEME_DOMAIN),
        'id'   => 'about_cta_text',
        'type' => 'text',
    )
);

$about->add_field(
    array(
        'name' => __('CTA URL', MY_THEME_DOMAIN),
        'id'   => 'about_cta_url',
        'type' => 'text_url',
    )
);