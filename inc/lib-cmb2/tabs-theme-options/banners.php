<?php


/**
 * Banners section.
 */
$parent_slug = 'themes.php';
$tab_group = MY_THEME_PREFIX . '_options_tabs';

// $banners = new_cmb2_box(
// 	array(
// 		'id'           => MY_THEME_DOMAIN . '_banners_options',
// 		//'title'        => __('Banners Options', MY_THEME_DOMAIN),
// 		'object_types' => array('options-page'),
// 		'option_key'   => MY_THEME_DOMAIN . '_banners_options',
// 		'parent_slug'  => $parent_slug, // Appearance menu.
// 		'menu_title'   => __('Banners', MY_THEME_DOMAIN),
// 		'capability'   => 'manage_options',
// 		'tab_group'    => $tab_group,
// 		'tab_title'    => __('Banners', MY_THEME_DOMAIN),
// 	)
// );



// $banners->add_field(
// 	array(
// 		'name' => __('Banners', MY_THEME_DOMAIN),
// 		'desc' => __('Create banners and place them in the different sections of the front page.', MY_THEME_DOMAIN),
// 		'type' => 'title',
// 		'id'   => MY_THEME_DOMAIN . '_banners_title',
// 	)
// );

// $banners_group = $banners->add_field(
// 	array(
// 		'id'         => 'banners_group',
// 		'type'       => 'group',
// 		'repeatable' => true,
// 		'options'    => array(
// 			'group_title'   => __('Banner {#}', MY_THEME_DOMAIN),
// 			'add_button'    => __('Add Banner', MY_THEME_DOMAIN),
// 			'remove_button' => __('Remove', MY_THEME_DOMAIN),
// 			'sortable'      => true,
// 			'closed'        => true,
// 		),
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name'    => __('Placement', MY_THEME_DOMAIN),
// 		'desc'    => __('Where to display this banner on the front page.', MY_THEME_DOMAIN),
// 		'id'      => 'placement',
// 		'type'    => 'select',
// 		'options' => understrap_child_front_page_banner_placements(),
// 		'default' => 'before_features',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name' => __('Slug (optional)', MY_THEME_DOMAIN),
// 		'desc' => __('Unique name to place the banner anywhere with the shortcode: [banner slug="my-banner"]', MY_THEME_DOMAIN),
// 		'id'   => 'slug',
// 		'type' => 'text',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name'    => __('Background Type', MY_THEME_DOMAIN),
// 		'id'      => 'bg_type',
// 		'type'    => 'select',
// 		'options' => array(
// 			'image' => __('Image', MY_THEME_DOMAIN),
// 			'color' => __('Color', MY_THEME_DOMAIN),
// 		),
// 		'default' => 'image',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name'         => __('Background Image', MY_THEME_DOMAIN),
// 		'desc'         => __('Used when Background Type is "Image".', MY_THEME_DOMAIN),
// 		'id'           => 'bg_image',
// 		'type'         => 'file',
// 		'options'      => array(
// 			'url' => true,
// 		),
// 		'preview_size' => array(80, 80),
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name' => __('Background Color', MY_THEME_DOMAIN),
// 		'desc' => __('Used when Background Type is "Color".', MY_THEME_DOMAIN),
// 		'id'   => 'bg_color',
// 		'type' => 'colorpicker',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name'    => __('Overlay Opacity', MY_THEME_DOMAIN),
// 		'desc'    => __('Dark overlay opacity (0-1). Only used with an image background.', MY_THEME_DOMAIN),
// 		'id'      => 'overlay',
// 		'type'    => 'text_small',
// 		'default' => '0.5',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name' => __('Text Color', MY_THEME_DOMAIN),
// 		'id'   => 'text_color',
// 		'type' => 'colorpicker',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name' => __('Title', MY_THEME_DOMAIN),
// 		'id'   => 'title',
// 		'type' => 'text',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name' => __('Description', MY_THEME_DOMAIN),
// 		'id'   => 'description',
// 		'type' => 'textarea_small',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name' => __('CTA Text', MY_THEME_DOMAIN),
// 		'id'   => 'cta_text',
// 		'type' => 'text',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name' => __('CTA URL', MY_THEME_DOMAIN),
// 		'id'   => 'cta_url',
// 		'type' => 'text_url',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name'    => __('Mobile Alignment', MY_THEME_DOMAIN),
// 		'desc'    => __('Content alignment on mobile (< 576px).', MY_THEME_DOMAIN),
// 		'id'      => 'banner_align_mobile',
// 		'type'    => 'select',
// 		'options' => $align_options,
// 		'default' => 'center',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name'    => __('Tablet Alignment', MY_THEME_DOMAIN),
// 		'desc'    => __('Content alignment on tablet (576px - 991.98px).', MY_THEME_DOMAIN),
// 		'id'      => 'banner_align_tablet',
// 		'type'    => 'select',
// 		'options' => $align_options,
// 		'default' => 'center',
// 	)
// );

// $banners->add_group_field(
// 	$banners_group,
// 	array(
// 		'name'    => __('Desktop Alignment', MY_THEME_DOMAIN),
// 		'desc'    => __('Content alignment on desktop (>= 992px).', MY_THEME_DOMAIN),
// 		'id'      => 'banner_align_desktop',
// 		'type'    => 'select',
// 		'options' => $align_options,
// 		'default' => 'center',
// 	)
// );