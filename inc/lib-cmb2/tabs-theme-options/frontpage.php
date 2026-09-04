<?php

/**
 * Front Page tab.
 */


$parent_slug = 'themes.php';
$tab_group   = MY_THEME_PREFIX . 'options_tabs';

$front_page = new_cmb2_box(
    array(
        'id'           => MY_THEME_PREFIX . 'front_page_options',
        //'title'      => __('Front Page Options', MY_THEME_DOMAIN),
        'object_types' => array('options-page'),
        'option_key'   => MY_THEME_PREFIX . 'front_page_options',
        'parent_slug'  => $parent_slug, // Menú de Apariencia
        'menu_title'   => __('Hero', MY_THEME_DOMAIN),
        'capability'   => 'manage_options',
        'tab_group'    => $tab_group,
        'tab_title'    => __('Hero', MY_THEME_DOMAIN),
    )
);

/**
 * Topbar section.
 */
$front_page->add_field(
    array(
        'name' => __('Topbar', MY_THEME_DOMAIN),
        'desc' => __('Configure the topbar visibility.', MY_THEME_DOMAIN),
        'type' => 'title',
        'id'   => MY_THEME_PREFIX . 'topbar_title',
    )
);

$front_page->add_field(
    array(
        'name' => __('Enable Topbar', MY_THEME_DOMAIN),
        'desc' => __('Show the topbar above the header.', MY_THEME_DOMAIN),
        'id'   => 'topbar_enable',
        'type' => 'checkbox',
    )
);

$front_page->add_field(
    array(
        'name'    => __('Show on Mobile', MY_THEME_DOMAIN),
        'desc'    => __('Display the topbar on phones (< 576px).', MY_THEME_DOMAIN),
        'id'      => 'topbar_show_mobile',
        'type'    => 'checkbox',
        'default' => 'on',
    )
);

$front_page->add_field(
    array(
        'name'    => __('Show on Tablet', MY_THEME_DOMAIN),
        'desc'    => __('Display the topbar on tablets (576px - 991.98px).', MY_THEME_DOMAIN),
        'id'      => 'topbar_show_tablet',
        'type'    => 'checkbox',
        'default' => 'on',
    )
);

$front_page->add_field(
    array(
        'name'    => __('Show on Desktop', MY_THEME_DOMAIN),
        'desc'    => __('Display the topbar on desktops (>= 992px).', MY_THEME_DOMAIN),
        'id'      => 'topbar_show_desktop',
        'type'    => 'checkbox',
        'default' => 'on',
    )
);

/**
 * Hero section.
 */
$front_page->add_field(
    array(
        'name' => __('Hero', MY_THEME_DOMAIN),
        'desc' => __('Configure the hero section of the front page.', MY_THEME_DOMAIN),
        'type' => 'title',
        'id'   => MY_THEME_PREFIX . 'hero_title',
    )
);

$front_page->add_field(
    array(
        'name' => __('Enable Hero', MY_THEME_DOMAIN),
        'desc' => __('Show the hero section on the front page.', MY_THEME_DOMAIN),
        'id'   => 'hero_enable',
        'type' => 'checkbox',
    )
);

$front_page->add_field(
    array(
        'name'         => __('Background Image', MY_THEME_DOMAIN),
        'desc'         => __('Upload an image to use as the hero background.', MY_THEME_DOMAIN),
        'id'           => 'hero_bg_image',
        'type'         => 'file',
        'options'      => array(
            'url' => true,
        ),
        'preview_size' => array(80, 80),
    )
);

$front_page->add_field(
    array(
        'name'    => __('Background Opacity', MY_THEME_DOMAIN),
        'desc'    => __('Dark overlay opacity (0 = none, 1 = fully dark).', MY_THEME_DOMAIN),
        'id'      => 'hero_bg_opacity',
        'type'    => 'text_small',
        'default' => '0.5',
    )
);

$front_page->add_field(
    array(
        'name' => __('Title', MY_THEME_DOMAIN),
        'id'   => 'hero_title',
        'type' => 'text',
    )
);

$front_page->add_field(
    array(
        'name' => __('Subtitle', MY_THEME_DOMAIN),
        'id'   => 'hero_subtitle',
        'type' => 'textarea_small',
    )
);

$front_page->add_field(
    array(
        'name'    => __('Reviews Rating', MY_THEME_DOMAIN),
        'desc'    => __('Number of stars to show (1-5).', MY_THEME_DOMAIN),
        'id'      => 'hero_reviews_rating',
        'type'    => 'text_small',
        'default' => '5',
    )
);

$front_page->add_field(
    array(
        'name' => __('Reviews Text', MY_THEME_DOMAIN),
        'desc' => __('Text shown next to the stars, e.g. "Basado en 120 reseñas".', MY_THEME_DOMAIN),
        'id'   => 'hero_reviews_text',
        'type' => 'text',
    )
);

$front_page->add_field(
    array(
        'name' => __('CTA Primary Text', MY_THEME_DOMAIN),
        'id'   => 'hero_cta_primary_text',
        'type' => 'text',
    )
);

$front_page->add_field(
    array(
        'name' => __('CTA Primary URL', MY_THEME_DOMAIN),
        'id'   => 'hero_cta_primary_url',
        'type' => 'text_url',
    )
);

$front_page->add_field(
    array(
        'name' => __('CTA Secondary Text', MY_THEME_DOMAIN),
        'id'   => 'hero_cta_secondary_text',
        'type' => 'text',
    )
);

$front_page->add_field(
    array(
        'name' => __('CTA Secondary URL', MY_THEME_DOMAIN),
        'id'   => 'hero_cta_secondary_url',
        'type' => 'text_url',
    )
);

$align_options = array(
    'start'  => __('Start', MY_THEME_DOMAIN),
    'center' => __('Center', MY_THEME_DOMAIN),
    'end'    => __('End', MY_THEME_DOMAIN),
);

$front_page->add_field(
    array(
        'name'    => __('Mobile Alignment', MY_THEME_DOMAIN),
        'desc'    => __('Content alignment on mobile (< 576px).', MY_THEME_DOMAIN),
        'id'      => 'hero_align_mobile',
        'type'    => 'select',
        'options' => $align_options,
        'default' => 'center',
    )
);

$front_page->add_field(
    array(
        'name'    => __('Tablet Alignment', MY_THEME_DOMAIN),
        'desc'    => __('Content alignment on tablet (576px - 991.98px).', MY_THEME_DOMAIN),
        'id'      => 'hero_align_tablet',
        'type'    => 'select',
        'options' => $align_options,
        'default' => 'center',
    )
);

$front_page->add_field(
    array(
        'name'    => __('Desktop Alignment', MY_THEME_DOMAIN),
        'desc'    => __('Content alignment on desktop (>= 992px).', MY_THEME_DOMAIN),
        'id'      => 'hero_align_desktop',
        'type'    => 'select',
        'options' => $align_options,
        'default' => 'center',
    )
);