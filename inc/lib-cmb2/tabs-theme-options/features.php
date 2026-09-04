<?php

/**
 * Features section.
 */

$parent_slug = 'themes.php';
$tab_group   = MY_THEME_PREFIX . 'options_tabs';

$features = new_cmb2_box(
    array(
        'id'           => MY_THEME_PREFIX . 'features_options',
        //'title'      => __('Featured Options', MY_THEME_DOMAIN),
        'object_types' => array('options-page'),
        'option_key'   => MY_THEME_PREFIX . 'features_options',
        'parent_slug'  => $parent_slug, // Menú de Apariencia
        'menu_title'   => __('Features', MY_THEME_DOMAIN),
        'capability'   => 'manage_options',
        'tab_group'    => $tab_group,
        'tab_title'    => __('Features', MY_THEME_DOMAIN),
    )
);

$features->add_field(
    array(
        'name' => __('Features', MY_THEME_DOMAIN),
        'desc' => __('Configure the features section of the front page.', MY_THEME_DOMAIN),
        'type' => 'title',
        'id'   => MY_THEME_PREFIX . 'features_title',
    )
);

$features->add_field(
    array(
        'name' => __('Show Section', MY_THEME_DOMAIN),
        'desc' => __('Show the features section on the front page.', MY_THEME_DOMAIN),
        'id'   => 'features_enable',
        'type' => 'checkbox',
    )
);

$features->add_field(
    array(
        'name' => __('Section Title', MY_THEME_DOMAIN),
        'id'   => 'features_title',
        'type' => 'text',
    )
);

$features->add_field(
    array(
        'name' => __('Section Subtitle', MY_THEME_DOMAIN),
        'id'   => 'features_subtitle',
        'type' => 'textarea_small',
    )
);

$features_group = $features->add_field(
    array(
        'id'         => 'features_group',
        'type'       => 'group',
        'repeatable' => true,
        'options'    => array(
            'group_title'   => __('Feature {#}', MY_THEME_DOMAIN),
            'add_button'    => __('Add Feature', MY_THEME_DOMAIN),
            'remove_button' => __('Remove', MY_THEME_DOMAIN),
            'sortable'      => true,
            'closed'        => true,
        ),
    )
);

$features->add_group_field(
    $features_group,
    array(
        'name'    => __('Icon', MY_THEME_DOMAIN),
        'desc'    => __('Bootstrap Icon to display.', MY_THEME_DOMAIN),
        'id'      => 'icon',
        'type'    => 'select',
        //'options' => themetwo_bootstrap_icons_list(),
    )
);

$features->add_group_field(
    $features_group,
    array(
        'name' => __('Title', MY_THEME_DOMAIN),
        'id'   => 'title',
        'type' => 'text',
    )
);

$features->add_group_field(
    $features_group,
    array(
        'name' => __('Description', MY_THEME_DOMAIN),
        'id'   => 'description',
        'type' => 'textarea_small',
    )
);