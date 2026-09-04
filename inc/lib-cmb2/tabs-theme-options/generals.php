<?php

/**
 * Generales tab.
 */

// 1. Define los identificadores del tema

$parent_slug = 'themes.php';
$tab_group   = MY_THEME_PREFIX . 'options_tabs';

$general = new_cmb2_box(
    array(
        'id'           => MY_THEME_PREFIX . 'general_options',
        //'title'      => __( 'Theme Options', MY_THEME_DOMAIN ),
        'object_types' => array('options-page'),
        'option_key'   => MY_THEME_PREFIX . 'options',
        'parent_slug'  => $parent_slug, // Menú de Apariencia
        'menu_title'   => __('Opciones del Tema', MY_THEME_DOMAIN),
        'capability'   => 'manage_options',
        'tab_group'    => $tab_group,
        'tab_title'    => __('Generales', MY_THEME_DOMAIN),
    )
);

/**
 * Bootstrap colors section.
 */
$general->add_field(
    array(
        'name' => __('Bootstrap Colors', MY_THEME_DOMAIN),
        'desc' => __('Set the Bootstrap color variables used by the theme.', MY_THEME_DOMAIN),
        'type' => 'title',
        'id'   => MY_THEME_PREFIX . 'colors_title',
    )
);

$colors = array(
    'primary'   => __('Primary', MY_THEME_DOMAIN),
    'secondary' => __('Secondary', MY_THEME_DOMAIN),
    'success'   => __('Success', MY_THEME_DOMAIN),
    'danger'    => __('Danger', MY_THEME_DOMAIN),
    'warning'   => __('Warning', MY_THEME_DOMAIN),
    'info'      => __('Info', MY_THEME_DOMAIN),
    'light'     => __('Light', MY_THEME_DOMAIN),
    'dark'      => __('Dark', MY_THEME_DOMAIN),
);

foreach ($colors as $key => $label) {
    $general->add_field(
        array(
            'name' => $label,
            'id'   => 'bootstrap_color_' . $key,
            'type' => 'colorpicker',
        )
    );
}

/**
 * Typography section.
 */
$general->add_field(
    array(
        'name' => __('Typography', MY_THEME_DOMAIN),
        'desc' => __('Set the fonts used by the theme.', MY_THEME_DOMAIN),
        'type' => 'title',
        'id'   => MY_THEME_PREFIX . 'typography_title',
    )
);

$general->add_field(
    array(
        'name'    => __('Primary Font', MY_THEME_DOMAIN),
        'desc'    => __('Font stack for headings, e.g. "Roboto", sans-serif.', MY_THEME_DOMAIN),
        'id'      => 'font_primary',
        'type'    => 'text',
        'default' => 'inherit',
    )
);

$general->add_field(
    array(
        'name'    => __('Secondary Font', MY_THEME_DOMAIN),
        'desc'    => __('Font stack for body text, e.g. "Open Sans", sans-serif.', MY_THEME_DOMAIN),
        'id'      => 'font_secondary',
        'type'    => 'text',
        'default' => 'inherit',
    )
);
