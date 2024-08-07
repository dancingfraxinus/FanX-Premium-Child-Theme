<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_media',
	'title' => 'All Media',
	'fields' => array(
		array(
			'allow_backendsearch' => 0,
			'show_column_filter' => false,
			'allow_bulkedit' => 0,
			'allow_quickedit' => 0,
			'show_column' => 0,
			'show_column_weight' => 1000,
			'show_column_sortable' => false,
			'key' => 'field_62bf932f0c307',
			'label' => 'Media Link',
			'name' => 'image_link',
			'aria-label' => '',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'attachment',
				'operator' => '==',
				'value' => 'image',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => 'CPT for img info - Links',
	'show_in_rest' => 1,
	'acfe_display_title' => 'Images, PDFs & Videos',
	'acfe_autosync' => array(
		0 => 'php',
		1 => 'json',
	),
	'acfe_permissions' => array(
		0 => 'super_admin',
		1 => 'administrator',
		2 => 'editor',
	),
	'acfe_meta' => '',
	'acfe_note' => '',
	'acfe_form' => 1,
	'qef_simple_location_rules' => 0,
	'modified' => 1718749595,
));

endif;