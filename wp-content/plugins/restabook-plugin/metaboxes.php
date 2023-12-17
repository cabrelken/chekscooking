<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'rnr_';

global $meta_boxes;

$meta_boxes = array();

global $smof_data;
/* ----------------------------------------------------- */
// Revolution Slider
/* ----------------------------------------------------- */

$array_choices      = array();
if(shortcode_exists("rev_slider"))  { 
	$new_slider       = new RevSlider();
	$tot_revsliders   = $new_slider->getArrSliders();
	array_push($array_choices, 
        array('value' => '',
            'label' => __('Choose a Slider','restabook-plugin'),
            'src'   =>''
		)
	);  
	foreach ( $tot_revsliders as $rev_single ) {
		$alias   = $rev_single->getAlias();
		$title   = $rev_single->getTitle();
		array_push($array_choices, 
           array('value' => $alias,
             'label' =>$title,
             'src'   =>'')
		);
	}
}

/* Page Section Background Settings */

$grid_array = array('2 Columns','3 Columns','4 Columns');

$pagebg_type_array = array(
	'image' => 'Image',
	'gradient' => 'Gradient',
	'color' => 'Color'
);

/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'ajax_page_type',
	'title' => 'Separate Page',
	'show'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'one-page.php'),
	),
	'pages' => array( 'page', 'post', 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
	
	array(
			'name'		=> 'Open as a separate page',
			'id'		=> $prefix . 'open_page',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => ' Check it while using "One Page Menu" and want to open this page as a separate page.',
                    'position' => 'top',
            ),
		),	

			
	)
);

/* ----------------------------------------------------- */
/* coming soon Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'coming_soon_opt',
	'title' => 'Coming Soon Page Options',
	'show'   => array(
    'template'    => array( 'coming-soon.php' ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Upload Logo',
			'id'		=> $prefix . 'rs_page_cooming_logo_img',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> '',
		),
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Number Counter', 'restabook' ),
			'id'   => $prefix . 'rs_commin_page_counter_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		array(
			'name'		=> 'Counter Date',
			'id'		=> $prefix . 'rs_comming_soon_date',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: 09/12/2021',
			'tooltip' => array(
                'icon'     => 'help',
                'content'  => 'MM DD YYYY',
                'position' => 'top',
            ),
			'hidden' => array( 'rnr_rs_commin_page_counter_opt', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Days',
			'id'		=> $prefix . 'rs_commin_page_counter_translate1',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option',
			'hidden' => array( 'rnr_rs_commin_page_counter_opt', '!=', 'st2' )
		),
		array(
			'name'		=> 'Hours',
			'id'		=> $prefix . 'rs_commin_page_counter_translate2',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option',
			'hidden' => array( 'rnr_rs_commin_page_counter_opt', '!=', 'st2' )
		),
		array(
			'name'		=> 'Minutes',
			'id'		=> $prefix . 'rs_commin_page_counter_translate3',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option',
			'hidden' => array( 'rnr_rs_commin_page_counter_opt', '!=', 'st2' )
		),
		array(
			'name'		=> 'Seconds',
			'id'		=> $prefix . 'rs_commin_page_counter_translate4',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option',
			'hidden' => array( 'rnr_rs_commin_page_counter_opt', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'rs_comming_soon_title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Under Construction',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'rs_comming_soon_sub_title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Our Website is Coming Soon',
		),
		
		array(
			'name'		=> 'Form Shortcode',
			'id'		=> $prefix . 'rs_comming_soon_form',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Use MailChimp form shortcode. E.X: [mc4wp_form id="264"]',
		),
		
		array(
			'name'		=> 'Upload Slideshow Images',
			'id'		=> $prefix . 'rs_page_comming_slider_opt',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1000',
			'desc'		=> '',
			
		),
	
		array(
			'name'		=> 'Promo Video URL',
			'id'		=> $prefix . 'rs_commin_page_promo_video_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Youtube/ Viemo video only.<br> e.x: https://vimeo.com/10322316',
		),
		
		array(
			'name'		=> 'View Promo Video',
			'id'		=> $prefix . 'rs_commin_page_promo_video_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option.',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Social Button', 'restabook' ),
			'id'   => $prefix . 'rs_commin_page_social_button_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
			array(
				'id'		=> $prefix . 'rs_commin_page_social_icon_opt',
				'name'        => 'Social Icon',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Social Icon Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name'		=> 'Icon Class',
						'id'		=> $prefix . 'rs_commin_page_social_icon_class',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: fab fa-facebook-f<br><a href="https://fontawesome.com/icons?d=gallery" target="_blank">Fontawesome Icon Class</a>',
					),
					
					array(
						'name'		=> 'Social URL',
						'id'		=> $prefix . 'rs_commin_page_social_url',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
					),
					
					
				),
				'hidden' => array( 'rnr_rs_commin_page_social_button_opt', '!=', 'st2' )
			),
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Reservation Button', 'restabook' ),
			'id'   => $prefix . 'rs_commin_page_reservation_button_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),	
		array(
			'name'		=> 'Table Reservation ',
			'id'		=> $prefix . 'rs_commin_page_reservation_button_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option.',
			'hidden' => array( 'rnr_rs_commin_page_reservation_button_opt', '!=', 'st2' )
		),
		
		// contcat info
		array(
			'name'     => esc_attr__( 'Contact Information', 'restabook' ),
			'id'   => $prefix . 'rs_commin_page_contact_info_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
			array(
				'id'		=> $prefix . 'rs_commin_page_contact_info_item_opt',
				'name'        => 'Contact Information',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Contact Information Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name'		=> 'Data Title',
						'id'		=> $prefix . 'rs_commin_page_contact_info_data_title',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: Call',
					),
					
					array(
					'name'     => esc_attr__( 'Data Type', 'restabook' ),
					'id'   => $prefix . 'rs_page_cooming_contact_info_data_type',
					'desc'  => __( '', 'restabook' ),
					'type'     => 'select_advanced',
					// Array of 'value' => 'Label' pairs for select box
					'options'  => array(
						
						'st1' => esc_attr__( 'Mobile Number', 'restabook' ),
						'st2' => esc_attr__( 'Email Address', 'restabook' ),
						'st3' => esc_attr__( 'Custom URL', 'restabook' ),
					),
					// Select multiple values, optional. Default is false.
					'multiple'    => false,
					'std'         => 'st1',
					'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
				  ),
					
					array(
						'name'		=> 'Mobile Number',
						'id'		=> $prefix . 'rs_commin_page_contcat_info_mobile_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
						'hidden' => array( 'rnr_rs_page_cooming_contact_info_data_type', '!=', 'st1' )
					),
					
					array(
						'name'		=> 'Email Address',
						'id'		=> $prefix . 'rs_commin_page_contcat_info_email_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
						'hidden' => array( 'rnr_rs_page_cooming_contact_info_data_type', '!=', 'st2' )
					),
					
					array(
					'name'     => esc_attr__( 'Link Target', 'restabook' ),
					'id'   => $prefix . 'rs_page_cooming_contact_info_link_target',
					'desc'  => __( '', 'restabook' ),
					'type'     => 'select_advanced',
					// Array of 'value' => 'Label' pairs for select box
					'options'  => array(
						
						'_self' => esc_attr__( 'Self', 'restabook' ),
						'_blank' => esc_attr__( 'Blank', 'restabook' ),
					),
					// Select multiple values, optional. Default is false.
					'multiple'    => false,
					'std'         => 'st1',
					'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
					'hidden' => array( 'rnr_rs_page_cooming_contact_info_data_type', '!=', 'st3' )
				  ),
				  
				  array(
						'name'		=> 'Custom URL Content',
						'id'		=> $prefix . 'rs_commin_page_contcat_info_url_con_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: USA 27TH Brooklyn NY',
						'hidden' => array( 'rnr_rs_page_cooming_contact_info_data_type', '!=', 'st3' )
					),
					
					array(
						'name'		=> 'Custom URL',
						'id'		=> $prefix . 'rs_commin_page_contcat_info_url_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
						'hidden' => array( 'rnr_rs_page_cooming_contact_info_data_type', '!=', 'st3' )
					),
				),
				'hidden' => array( 'rnr_rs_commin_page_contact_info_opt', '!=', 'st2' )
			),
			
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Content Section Background Effect', 'restabook' ),
			'id'   => $prefix . 'rs_page_cooming_bottom_back_effect',
			'desc'  => __( 'Enable/ Disable content section background effect.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Default Effect', 'restabook' ),
				'st3' => esc_attr__( 'Custom Image', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		array(
			'name'		=> 'Upload Custom Image',
			'id'		=> $prefix . 'rs_page_cooming_bottom_back_effect_img',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> '',
			'hidden' => array( 'rnr_rs_page_cooming_bottom_back_effect', '!=', 'st3' )
		),
		
	)
);


/* ----------------------------------------------------- */
/* Default page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'default_page_type',
	'title' => 'Default Page Template Options',
	'hide'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'one-page.php', 'food-menu.php', 'coming-soon.php'),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Default Page Type', 'restabook' ),
			'id'   => $prefix . 'wr_pagetype',
			'desc'  => esc_attr__( 'Select Default Page Type.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				//'st0' => esc_attr__( 'Select an Option', 'restabook' ),
				'st1' => esc_attr__( 'Default', 'restabook' ),
				'st2' => esc_attr__( 'Left Sidebar', 'restabook' ),
				'st3' => esc_attr__( 'Right Sidebar', 'restabook' ),
				
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st0',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Container', 'restabook' ),
			'id'   => $prefix . 'wr_pagetype_container',
			'desc'  => __( 'Disable/ Enable Page Container. <br> Working only in Default Page Type Option Default.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
			'hidden' => array( 'rnr_wr_pagetype', '!=', 'st1' )
		),
		
		
	)
);

/* ----------------------------------------------------- */
/* Food menu page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'food_menu_page_type',
	'title' => 'Food Menu Template Options',
	'show'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'food-menu.php'),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Food Menu Page Style', 'restabook' ),
			'id'   => $prefix . 'wr_page_food_type',
			'desc'  => esc_attr__( 'Select Default Page Type.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Tab Style', 'restabook' ),
				'st2' => esc_attr__( 'Category List', 'restabook' ),
				'st3' => esc_attr__( 'Grid', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Category Filter', 'restabook' ),
			'id'   => $prefix . 'rs_food_menu_category_filter',
			'desc'  => esc_attr__( 'Enable/ Disable category filter option.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		array(
			'name'		=> 'Number of categories to show',
			'id'		=> $prefix . 'rs_menu_post_cat_count',
			'desc'		=> 'e.x: 5',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'rnr_rs_food_menu_category_filter', '!=', 'st1' ),
		),
		
		
		array(
			'name'		=> 'Exclude category',
			'id'		=> $prefix . 'rs_menu_post_exclude_main_cat_id',
			'desc'		=> 'Exclude category by the category ID e.x: 6 <br>For multiple category ID e.x: 6 7',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'rnr_rs_food_menu_category_filter', '!=', 'st1' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Category Number Counting', 'restabook' ),
			'id'   => $prefix . 'rs_food_menu_category_count',
			'desc'  => esc_attr__( 'Enable/ Disable category number counting.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
			'hidden' => array( 'rnr_rs_food_menu_category_filter', '!=', 'st1' )
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Filter by sub category', 'restabook' ),
			'id'   => $prefix . 'rs_food_menu_subcategory_filter',
			'desc'  => esc_attr__( 'Filter by subcategories from a specific parent category.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
			'hidden' => array( 'rnr_rs_food_menu_category_filter', '!=', 'st1' ),
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => "Not working for Grid style.",
            'position' => 'top',
            ),
		),
		
		array(
			'name'		=> 'Parent category ID',
			'id'		=> $prefix . 'rs_menu_post_cat_parent',
			'desc'		=> 'e.x: 7 (Required)',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'rnr_rs_food_menu_subcategory_filter', '!=', 'st2' ),
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => "Not working for Grid style.",
            'position' => 'top',
            ),
		),
		
		array(
			'name'		=> 'Exclude child category',
			'id'		=> $prefix . 'rs_menu_post_exclude_cat_id',
			'desc'		=> 'Exclude child category by the child category ID e.x: 6 <br>For multiple category ID e.x: 6 7',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'rnr_rs_food_menu_subcategory_filter', '!=', 'st2' ),
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => "Not working for Grid style.",
            'position' => 'top',
            ),
		),
		
		array(
				'name'       => esc_attr__( 'Number Of Post Show', 'blps' ),
				'id'         => $prefix . 'rs_menu_post_show',
				'desc'		=> '',
				'type'       => 'slider',
				// Text labels displayed before and after value
				'prefix'     => __( '', 'blps' ),
				'suffix'     => __( ' Posts', 'blps' ),
				'js_options' => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
			),	

			array(
			'name'		=> 'Include Category',
			'id'		=> $prefix . 'rs_menu_post_cat',
			'desc'		=> 'Enter category name ex: drinks, desserts (Optional).',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			
		  ),
		
		
		array(
			'name'		=> 'All Dishes',
			'id'		=> $prefix . 'rs_menu_translate1',
			'desc'		=> 'Translate Option.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'rnr_wr_page_food_type', '!=', 'st3' )
		  ),
		 
		array(
			'name'		=> 'Show Filters',
			'id'		=> $prefix . 'rs_menu_translate2',
			'desc'		=> 'Translate Option.<br> Working on mobile device.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'hidden' => array( 'rnr_rs_food_menu_category_filter', '!=', 'st1' )
			
		  ),
		  
		  array(
			'name'		=> 'Button URL',
			'id'		=> $prefix . 'rs_menu_page_button_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Button Text',
			'id'		=> $prefix . 'rs_menu_page_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Button Target', 'restabook' ),
			'id'   => $prefix . 'rs_menu_page_button_type',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Self', 'restabook' ),
				'st2' => esc_attr__( 'Blank', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		
	)
);


/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'home_page_header_global_type',
	'title' => 'Page Animation Options',
	'hide'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'one-page.php', 'coming-soon.php'),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Animation', 'restabook' ),
			'id'   => $prefix . 'rs_page_animation',
			'desc'  => __( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Animation 1', 'restabook' ),
				'st3' => esc_attr__( 'Animation 2', 'restabook' ),
				'st4' => esc_attr__( 'Animation 3', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Bottom Brush Effect', 'restabook' ),
			'id'   => $prefix . 'rs_page_bottom_brush',
			'desc'  => __( 'Enable/ Disable page bottom brush effect.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Bottom Background Effect', 'restabook' ),
			'id'   => $prefix . 'rs_page_bottom_back_effect',
			'desc'  => __( 'Enable/ Disable page bottom background effect.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Default Effect', 'restabook' ),
				'st3' => esc_attr__( 'Custom Image', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		array(
			'name'		=> 'Upload Custom Image',
			'id'		=> $prefix . 'rs_page_bottom_back_effect_img',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> 'Working only page bottom background effect option "Custom Image"',
			'hidden' => array( 'rnr_rs_page_bottom_back_effect', '!=', 'st3' )
		),
		
		
		
	)
);

/* ----------------------------------------------------- */
/* page Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'home_one_page_header_global_type',
	'title' => 'Page Animation Options',
	'show'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'one-page.php'),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Bottom Brush Effect', 'restabook' ),
			'id'   => $prefix . 'rs_one_page_bottom_brush',
			'desc'  => __( 'Enable/ Disable page bottom brush effect.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		
		
		
		
	)
);


/* ----------------------------------------------------- */
/* portfolio Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'page_header_global_opt',
	'title' => 'Page Header Options',
	'hide'   => array(
    // List of page templates (used for page only). Array. Optional.
    'template'    => array( 'coming-soon.php'),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
	// SELECT BOX
		array(
			'name'     => esc_attr__( 'Header Style', 'restabook' ),
			'id'   => $prefix . 'wr_intro_sc_opt',
			'desc'  => esc_attr__( 'Header style "Default" will hidden header section for one page version.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st00' => esc_attr__( 'Select an Option', 'restabook' ),
				'st0' => esc_attr__( 'Default', 'restabook' ),
				'st1' => esc_attr__( 'Parallax Image', 'restabook' ),
				'st2' => esc_attr__( 'Slider', 'restabook' ),
				'st3' => esc_attr__( 'Carousel', 'restabook' ),
				'st5' => esc_attr__( 'Slideshow', 'restabook' ),
				'st6' => esc_attr__( 'Video', 'restabook' ),
				'st7' => esc_attr__( 'Revolution Slider', 'restabook' ),
				'st9' => esc_attr__( 'Google Map', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st00',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Page Header Brush Effect', 'restabook' ),
			'id'   => $prefix . 'rs_intro_brush_effect',
			'desc'  => esc_attr__( 'Enable/ Disable page header brush effect.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
	
	)
);

/* ----------------------------------------------------- */
/* intro parallax image
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'intro_default_restabook',
	'title' => 'Defaut Header Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#rnr_wr_intro_sc_opt'  => 'st0',
    ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'rs_intro_default_title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'rs_intro_dfault_sub_title',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> '',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Animated Mouse Button', 'restabook' ),
			'id'   => $prefix . 'rs_intro_default_mousy_button',
			'desc'  => esc_attr__( 'Enable/ Disable animated mouse button.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		
	)
);

/* ----------------------------------------------------- */
/* intro parallax image
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'intro_parallax_image_restabook',
	'title' => 'Parallax Image Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#rnr_wr_intro_sc_opt'  => 'st1',
    ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Background Image',
			'id'		=> $prefix . 'rs_intro_back_parallax_image',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> 'Background Image',
		),
		
		
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'rs_intro_parallax_image_title',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> 'e.x: Welcome to Restabook Restaurant',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'rs_intro_parallax_image_sub_title',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> 'e.x: Top Services and Premium Cuisine',
		),
		
		
		array(
			'name'		=> 'Button URL',
			'id'		=> $prefix . 'rs_intro_parallax_image_button_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Button Text',
			'id'		=> $prefix . 'rs_intro_parallax_image_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Button Target', 'restabook' ),
			'id'   => $prefix . 'rs_intro_parallax_image_button_type',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Self', 'restabook' ),
				'st2' => esc_attr__( 'Blank', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		array(
			'name'		=> 'Promo Video URL',
			'id'		=> $prefix . 'rs_intro_parallax_promo_video_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Youtube/ Viemo video only.<br> e.x: https://vimeo.com/10322316',
		),
		
		array(
			'name'		=> 'View Promo Video',
			'id'		=> $prefix . 'rs_intro_parallax_promo_video_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option.',
		),
		
		
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Corner Border', 'restabook' ),
			'id'   => $prefix . 'rs_intro_parallax_image_corner_border',
			'desc'  => esc_attr__( 'Effected after screen size 1570px.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Social Button', 'restabook' ),
			'id'   => $prefix . 'rs_intro_parallax_image_social_button_opt',
			'desc'  => esc_attr__( 'Effected after screen size 1570px.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
			array(
				'id'		=> $prefix . 'rs_intro_parallax_social_icon_opt',
				'name'        => 'Social Icon',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Social Icon Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name'		=> 'Icon Class',
						'id'		=> $prefix . 'rs_intro_parallax_image_social_icon_class',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: fab fa-facebook-f<br><a href="https://fontawesome.com/icons?d=gallery" target="_blank">Fontawesome Icon Class</a>',
					),
					
					array(
						'name'		=> 'Social URL',
						'id'		=> $prefix . 'rs_intro_parallax_image_social_url',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
					),
					
					
				),
				'hidden' => array( 'rnr_rs_intro_parallax_image_social_button_opt', '!=', 'st2' )
			),
			
			array(
			'name'		=> 'Scroll ID',
			'id'		=> $prefix . 'rs_intro_parallax_image_scroll_id',
			'clone'		=> false,
			'type'		=> 'text',
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => 'Write #rs-page if default page template container enable.',
                    'position' => 'top',
                ),
			'std'		=> '',
			'desc'		=> 'e.x: #about. <br> Use VC row section ID.<br> For one page function use page ID or VC row section ID',
			),
			
			array(
			'name'		=> 'Scroll Button Text',
			'id'		=> $prefix . 'rs_intro_parallax_image_scroll_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Button will be visible after add text.<br>e.x: Scroll down  to discover',
			),
		
	)
);


/* ----------------------------------------------------- */
/* intro Slider
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'intro_slider_restabook',
	'title' => 'Slider Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#rnr_wr_intro_sc_opt'   => 'st2',
    ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
	
		array(
			'name'		=> 'Slider Speed',
			'id'		=> $prefix . 'rs_intro_slider_gallery_slider_speed',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Default: 2400',
		),
		
		array(
			'name'		=> 'Slider Autoplay Delay',
			'id'		=> $prefix . 'rs_intro_slider_gallery_slider_autoplay',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Default: 3500',
		),
		
		array(
				'id'		=> $prefix . 'rs_intro_slider_gallery_slider',
				'name'        => 'Slider Item',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Slider Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
					'name'		=> 'Slide Image',
					'id'		=> $prefix . 'rs_intro_slider_gallery_slider_image',
					'clone'		=> false,
					'type'		=> 'image_advanced',
					'max_file_uploads' => '1',
					'desc'		=> '',
					),
					
					
					array(
						'name'		=> 'Title',
						'id'		=> $prefix . 'rs_intro_slider_gallery_slider_title',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: Welcome To Our Restaurant',
					),
					
					array(
						'name'		=> 'Sub Title',
						'id'		=> $prefix . 'rs_intro_slider_gallery_slider_sub_title',
						'clone'		=> false,
						'type'		=> 'textarea',
						'std'		=> '',
						'desc'		=> 'Optional.',
					),
					
					array(
						'name'		=> 'Button Text',
						'id'		=> $prefix . 'rs_intro_slider_gallery_slider_button_text',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'Optional.',
					),
					
					array(
						'name'		=> 'Button URL',
						'id'		=> $prefix . 'rs_intro_slider_gallery_slider_button_url',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'Optional.<br> If button target scroll then use section id. e.x: #about',
					),
					
					// SELECT BOX
					array(
						'name'     => esc_attr__( 'Button Target', 'restabook' ),
						'id'   => $prefix . 'rs_intro_slider_button_type',
						'desc'  => esc_attr__( '', 'restabook' ),
						'type'     => 'select_advanced',
						// Array of 'value' => 'Label' pairs for select box
						'options'  => array(
							'_self' => esc_attr__( 'Self', 'restabook' ),
							'_blank' => esc_attr__( 'Blank', 'restabook' ),
							'scroll' => esc_attr__( 'Scroll', 'restabook' ),
						),
						// Select multiple values, optional. Default is false.
						'multiple'    => false,
						'std'         => '_self',
						'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
					),
				
				),
			),
		
			// SELECT BOX
			array(
				'name'     => esc_attr__( 'Corner Border', 'restabook' ),
				'id'   => $prefix . 'rs_intro_slider_corner_border',
				'desc'  => esc_attr__( '', 'restabook' ),
				'type'     => 'select_advanced',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'st1' => esc_attr__( 'Enable', 'restabook' ),
					'st2' => esc_attr__( 'Disable', 'restabook' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'st1',
				'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
			),
		
			
		
	)
);


/* ----------------------------------------------------- */
/* intro Slider
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'intro_carousel_restabook',
	'title' => 'Carousel Slider Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#rnr_wr_intro_sc_opt'  => 'st3',
    ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
			array(
				'name'		=> 'Slider Speed',
				'id'		=> $prefix . 'rs_intro_carousel_gallery_slider_speed',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '',
				'desc'		=> 'Default: 1400',
			),
			
			array(
				'name'		=> 'Slider Autoplay Delay',
				'id'		=> $prefix . 'rs_intro_carousel_gallery_slider_autoplay',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '',
				'desc'		=> 'Default: 3000',
			),
			
			array(
				'name'		=> 'Slider To Show',
				'id'		=> $prefix . 'rs_intro_carousel_gallery_slider_count',
				'clone'		=> false,
				'type'		=> 'text',
				'std'		=> '',
				'desc'		=> 'Default: 3',
			),
			
			// SELECT BOX
			array(
				'name'     => esc_attr__( 'Centered Slides', 'restabook' ),
				'id'   => $prefix . 'rs_intro_carousel_gallery_slider_centeredslides',
				'desc'  => esc_attr__( '', 'restabook' ),
				'type'     => 'select_advanced',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'st1' => esc_attr__( 'Enable', 'restabook' ),
					'st2' => esc_attr__( 'Disable', 'restabook' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'st1',
				'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
			),
			
			
			array(
				'id'		=> $prefix . 'rs_intro_carousel_opt',
				'name'        => 'Carousel',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Carousel Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
					'name'		=> 'Slide Image',
					'id'		=> $prefix . 'rs_intro_carousel_image',
					'clone'		=> false,
					'type'		=> 'image_advanced',
					'max_file_uploads' => '1',
					'desc'		=> '',
					),
					array(
						'name'		=> 'Carousel Number',
						'id'		=> $prefix . 'rs_intro_carousel_number',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'Optional. e.x: 01',
					),
					
					array(
						'name'		=> 'Title',
						'id'		=> $prefix . 'rs_intro_carousel_title',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: Welcome To Our Restaurant',
					),
					
					array(
						'name'		=> 'Sub Title',
						'id'		=> $prefix . 'rs_intro_carousel_sub_title',
						'clone'		=> false,
						'type'		=> 'textarea',
						'std'		=> '',
						'desc'		=> 'Optional.',
					),
					
					
					array(
						'name'		=> 'Custom URL',
						'id'		=> $prefix . 'rs_intro_carousel_button_url',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'Optional.',
					),
					
					// SELECT BOX
					array(
						'name'     => esc_attr__( 'URL Target', 'restabook' ),
						'id'   => $prefix . 'rs_intro_carousel_button_type',
						'desc'  => esc_attr__( '', 'restabook' ),
						'type'     => 'select_advanced',
						// Array of 'value' => 'Label' pairs for select box
						'options'  => array(
							'_self' => esc_attr__( 'Self', 'restabook' ),
							'_blank' => esc_attr__( 'Blank', 'restabook' ),
						),
						// Select multiple values, optional. Default is false.
						'multiple'    => false,
						'std'         => '_self',
						'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
					),
				
				),
			),
		
			// SELECT BOX
			array(
				'name'     => esc_attr__( 'Corner Border', 'restabook' ),
				'id'   => $prefix . 'rs_intro_carousel_corner_border',
				'desc'  => esc_attr__( '', 'restabook' ),
				'type'     => 'select_advanced',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'st1' => esc_attr__( 'Enable', 'restabook' ),
					'st2' => esc_attr__( 'Disable', 'restabook' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'st1',
				'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
			),
			
			array(
			'name'		=> 'Scroll ID',
			'id'		=> $prefix . 'rs_intro_carousel_image_scroll_id',
			'clone'		=> false,
			'type'		=> 'text',
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => 'Write #rs-page if default page template container enable.',
                    'position' => 'top',
                ),
			'std'		=> '',
			'desc'		=> 'e.x: #about. <br> Use VC row section ID.<br> For one page function use page ID or VC row section ID',
			),
			
			array(
			'name'		=> 'Scroll Button Text',
			'id'		=> $prefix . 'rs_intro_carousel_scroll_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Button will be visible after add text.<br>e.x: Scroll down  to discover',
			),
		
	)
);

/* ----------------------------------------------------- */
/* intro parallax image
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'intro_slideshow_image_restabook',
	'title' => 'Slideshow Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#rnr_wr_intro_sc_opt'  => 'st5',
    ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
	
		array(
			'name'		=> 'Slider Speed',
			'id'		=> $prefix . 'rs_intro_slideshow_speed',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Default: 1400',
		),
			
		array(
			'name'		=> 'Slider Autoplay Delay',
			'id'		=> $prefix . 'rs_intro_slideshow_autoplay',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Default: 3500',
		),
		
		
		array(
			'name'		=> 'Upload Images',
			'id'		=> $prefix . 'rs_intro_back_slideshow',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1000',
			'desc'		=> 'Slideshow Images',
		),
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'rs_intro_slideshow_title',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> 'e.x: Welcome to Restabook Restaurant',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'rs_intro_slideshow_sub_title',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> 'e.x: Top Services and Premium Cuisine',
		),
		
		
		array(
			'name'		=> 'Button URL',
			'id'		=> $prefix . 'rs_intro_slideshow_button_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Button Text',
			'id'		=> $prefix . 'rs_intro_slideshow_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Button Target', 'restabook' ),
			'id'   => $prefix . 'rs_intro_slideshow_button_type',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Self', 'restabook' ),
				'st2' => esc_attr__( 'Blank', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		
		array(
			'name'		=> 'Promo Video URL',
			'id'		=> $prefix . 'rs_intro_slideshow_promo_video_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Youtube/ Viemo video only.<br> e.x: https://vimeo.com/10322316',
		),
		
		array(
			'name'		=> 'View Promo Video',
			'id'		=> $prefix . 'rs_intro_slideshow_promo_video_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option.',
		),
		
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Corner Border', 'restabook' ),
			'id'   => $prefix . 'rs_intro_slideshow_corner_border',
			'desc'  => esc_attr__( 'Effected after screen size 1570px.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Social Button', 'restabook' ),
			'id'   => $prefix . 'rs_intro_slideshow_social_button_opt',
			'desc'  => esc_attr__( 'Effected after screen size 1570px.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
			array(
				'id'		=> $prefix . 'rs_intro_slideshow_social_icon_opt',
				'name'        => 'Social Icon',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Social Icon Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name'		=> 'Icon Class',
						'id'		=> $prefix . 'rs_intro_slideshow_social_icon_class',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: fab fa-facebook-f<br><a href="https://fontawesome.com/icons?d=gallery" target="_blank">Fontawesome Icon Class</a>',
					),
					
					array(
						'name'		=> 'Social URL',
						'id'		=> $prefix . 'rs_intro_slideshow_social_url',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
					),
					
					
				),
				'hidden' => array( 'rnr_rs_intro_slideshow_social_button_opt', '!=', 'st2' )
			),
			array(
			'name'		=> 'Scroll ID',
			'id'		=> $prefix . 'rs_intro_slideshow_image_scroll_id',
			'clone'		=> false,
			'type'		=> 'text',
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => 'Write #rs-page if default page template container enable.',
                    'position' => 'top',
                ),
			'std'		=> '',
			'desc'		=> 'e.x: #about. <br> Use VC row section ID.<br> For one page function use page ID or VC row section ID',
			),
			array(
			'name'		=> 'Scroll Button Text',
			'id'		=> $prefix . 'rs_intro_slideshow_image_scroll_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Button will be visible after add text.<br>e.x: Scroll down  to discover',
			),
		
	)
);


/* ----------------------------------------------------- */
/* intro mp4 video
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'intro_video_restabook',
	'title' => 'Video Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#rnr_wr_intro_sc_opt' => 'st6',
    ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
	
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Video Type', 'restabook' ),
			'id'   => $prefix . 'rs_intro_video_select_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'MP4', 'restabook' ),
				'st2' => esc_attr__( 'Youtube', 'restabook' ),
				'st3' => esc_attr__( 'Vimeo', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		
		
		array(
			'name'		=> 'MP4 Video URL',
			'id'		=> $prefix . 'rs_intro_mp4_video_url',
			'clone'		=> false,
			'type' => 'text',
			'desc'		=> '',
			'hidden' => array( 'rnr_rs_intro_video_select_opt', '!=', 'st1' )
		),
		
		
		
		array(
			'name'		=> 'Youtube Video ID',
			'id'		=> $prefix . 'rs_intro_youtube_video_url',
			'clone'		=> false,
			'type' => 'text',
			'desc'		=> 'E.X: Hg5iNVSp2z8',
			'hidden' => array( 'rnr_rs_intro_video_select_opt', '!=', 'st2' )
		),
		
		
		
		array(
			'name'		=> 'Vimeo Video ID',
			'id'		=> $prefix . 'rs_intro_vimeo_video_url',
			'clone'		=> false,
			'type' => 'text',
			'desc'		=> 'E.X: 97871257',
			'hidden' => array( 'rnr_rs_intro_video_select_opt', '!=', 'st3' )
		),
		
		array(
			'name'		=> 'Background Image',
			'id'		=> $prefix . 'rs_intro_back_video_image',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> 'Background Image',
		),
		
		
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'rs_intro_video_image_title',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> 'e.x: Welcome to Restabook Restaurant',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'rs_intro_video_image_sub_title',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> 'e.x: Top Services and Premium Cuisine',
		),
		
		
		array(
			'name'		=> 'Button URL',
			'id'		=> $prefix . 'rs_intro_video_image_button_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Button Text',
			'id'		=> $prefix . 'rs_intro_video_image_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Button Target', 'restabook' ),
			'id'   => $prefix . 'rs_intro_video_image_button_type',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Self', 'restabook' ),
				'st2' => esc_attr__( 'Blank', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		array(
			'name'		=> 'Promo Video URL',
			'id'		=> $prefix . 'rs_intro_video_promo_video_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Youtube/ Viemo video only.<br> e.x: https://vimeo.com/10322316',
		),
		
		array(
			'name'		=> 'View Promo Video',
			'id'		=> $prefix . 'rs_intro_video_promo_video_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option.',
		),
		
		
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Corner Border', 'restabook' ),
			'id'   => $prefix . 'rs_intro_video_image_corner_border',
			'desc'  => esc_attr__( 'Effected after screen size 1570px.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Social Button', 'restabook' ),
			'id'   => $prefix . 'rs_intro_video_image_social_button_opt',
			'desc'  => esc_attr__( 'Effected after screen size 1570px.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
			array(
				'id'		=> $prefix . 'rs_intro_video_social_icon_opt',
				'name'        => 'Social Icon',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Social Icon Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name'		=> 'Icon Class',
						'id'		=> $prefix . 'rs_intro_video_image_social_icon_class',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: fab fa-facebook-f<br><a href="https://fontawesome.com/icons?d=gallery" target="_blank">Fontawesome Icon Class</a>',
					),
					
					array(
						'name'		=> 'Social URL',
						'id'		=> $prefix . 'rs_intro_video_image_social_url',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
					),
					
					
				),
				'hidden' => array( 'rs_intro_video_image_social_button_opt', '!=', 'st2' )
			),
			
			array(
			'name'		=> 'Scroll ID',
			'id'		=> $prefix . 'rs_intro_video_image_scroll_id',
			'clone'		=> false,
			'type'		=> 'text',
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => 'Write #rs-page if default page template container enable.',
                    'position' => 'top',
                ),
			'std'		=> '',
			'desc'		=> 'e.x: #about. <br> Use VC row section ID.<br> For one page function use page ID or VC row section ID',
			),
			
			array(
			'name'		=> 'Scroll Button Text',
			'id'		=> $prefix . 'rs_intro_video_image_scroll_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Button will be visible after add text.<br>e.x: Scroll down  to discover',
			),
		
	)
);



/* ----------------------------------------------------- */
/* intro parallax image
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'intro_google_map_restabook',
	'title' => 'Google Map Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#rnr_wr_intro_sc_opt'  => 'st9',
    ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		
		
		// contact information
		array(
			'name'     => esc_attr__( 'Contcat Information', 'restabook' ),
			'id'   => $prefix . 'rs_intro_google_map_con_info',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'rs_intro_google_map_title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Contacts Details',
			'hidden' => array( 'rnr_rs_intro_google_map_con_info', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Data Address Title',
			'id'		=> $prefix . 'rs_intro_google_map_address_title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Address',
			'hidden' => array( 'rnr_rs_intro_google_map_con_info', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Data Address Content',
			'id'		=> $prefix . 'rs_intro_google_map_address_content',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: USA 27TH Brooklyn NY',
			'hidden' => array( 'rnr_rs_intro_google_map_con_info', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Data Phone Title',
			'id'		=> $prefix . 'rs_intro_google_map_phone_title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Phone',
			'hidden' => array( 'rnr_rs_intro_google_map_con_info', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Data Phone Content',
			'id'		=> $prefix . 'rs_intro_google_map_phone_content',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x:+7(123)987654',
			'hidden' => array( 'rnr_rs_intro_google_map_con_info', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Data Email Title',
			'id'		=> $prefix . 'rs_intro_google_map_email_title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Mail',
			'hidden' => array( 'rnr_rs_intro_google_map_con_info', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Data Email Content',
			'id'		=> $prefix . 'rs_intro_google_map_email_content',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: yourmail@domain.com',
			'hidden' => array( 'rnr_rs_intro_google_map_con_info', '!=', 'st2' )
		),
		
		// Map Color Schemes
		array(
			'name'     => esc_attr__( 'Google Map Type', 'restabook' ),
			'id'   => $prefix . 'rs_intro_google_map_type',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Multi Location Google Map', 'restabook' ),
				'st2' => esc_attr__( 'Single Location Google Map', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		array(
			'name'		=> 'Google Map Location',
			'id'		=> $prefix . 'rs_intro_google_sin_map_lat',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'E.X: 40.714 , -74.005',
			'hidden' => array( 'rnr_rs_intro_google_map_type', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Address',
			'id'		=> $prefix . 'rs_intro_google_sin_map_add',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'E.X: 27th Brooklyn New York, NY 10065',
			'hidden' => array( 'rnr_rs_intro_google_map_type', '!=', 'st2' )
		),
		
		// Map Color Schemes
		array(
			'name'     => esc_attr__( 'Map Color Schemes', 'restabook' ),
			'id'   => $prefix . 'rs_intro_google_sin_map_color_schemes',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Dark', 'restabook' ),
				'st2' => esc_attr__( 'Light', 'restabook' ),
				'st3' => esc_attr__( 'Open Street Map', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
			'hidden' => array( 'rnr_rs_intro_google_map_type', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Google Map API Key',
			'id'		=> $prefix . 'rs_intro_google_map_api',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Add your Google map API key. <br> <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Create API Key</a>',
			'hidden' => array( 'rnr_rs_intro_google_map_type', '!=', 'st1' )
			
		),
		
		// Map Color Schemes
		array(
			'name'     => esc_attr__( 'Map Color Schemes', 'restabook' ),
			'id'   => $prefix . 'rs_intro_google_map_color_schemes',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Dark', 'restabook' ),
				'st2' => esc_attr__( 'Light', 'restabook' ),
				'st3' => esc_attr__( 'Regular', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
			'hidden' => array( 'rnr_rs_intro_google_map_type', '!=', 'st1' )
		),
		
		array(
			'name'		=> 'Map Marker',
			'id'		=> $prefix . 'rs_intro_google_map_marker',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> 'Upload Map Marker. Optional.',
		),
		
		array(
			'name'		=> 'Zoom',
			'id'		=> $prefix . 'rs_intro_google_map_zoom_opt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: 13 <br> Default: 13',
			'hidden' => array( 'rnr_rs_intro_google_map_type', '!=', 'st1' )
			
		),
		
		array(
			'name'		=> 'Latitude, Longitude For Country/ City',
			'id'		=> $prefix . 'rs_intro_google_map_main_location',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: 40.7143528, -74.0059731<br> Required.',
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => "If you don't want to use multli location, then use your main map location's Latitude, Longitude. ",
            'position' => 'top',
            ),
			'hidden' => array( 'rnr_rs_intro_google_map_type', '!=', 'st1' )
		),
		
		array(
				'id'		=> $prefix . 'rs_intro_google_map_loaction_opt',
				'name'        => 'Google Map Location',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Google Map Location Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name'		=> 'Location Title',
						'id'		=> $prefix . 'rs_intro_google_map_location_title_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: Restabook in Manhattan',
					),
					
					array(
						'name'		=> 'Latitude, Longitude',
						'id'		=> $prefix . 'rs_intro_google_map_location_latitude_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: 40.7143528, -74.0059731',
					),
					
					
				),
				'hidden' => array( 'rnr_rs_intro_google_map_type', '!=', 'st1' )
			),
			
	)
);


/* ----------------------------------------------------- */
/* intro parallax image
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'intro_revolution_slider_restabook',
	'title' => 'Revolution Slider Options.',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#rnr_wr_intro_sc_opt'  => 'st7',
    ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		// get slider 
		array(
			'name'     => esc_attr__( 'Slider Revolution', 'restabook-plugin' ),
			'id'   => $prefix . 'rs_intro_revolution_slider_shortcode',
			'desc'  => esc_attr__( 'Choose a Slider.', 'restabook-plugin' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $array_choices,
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => '',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook-plugin' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Slider Overlay', 'solonick' ),
			'id'   => $prefix . 'rs_intro_rev_image_overlay',
			'desc'  => esc_attr__( '', 'solonick' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'solonick' ),
				'st2' => esc_attr__( 'Disable', 'solonick' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'solonick' ),
		),
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'rs_intro_revolution_slider_title',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> 'e.x: Welcome to Restabook Restaurant',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'rs_intro_revolution_slider_sub_title',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'desc'		=> 'e.x: Top Services and Premium Cuisine',
		),
		
		
		array(
			'name'		=> 'Button URL',
			'id'		=> $prefix . 'rs_intro_revolution_slider_button_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		array(
			'name'		=> 'Button Text',
			'id'		=> $prefix . 'rs_intro_revolution_slider_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> '',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Button Target', 'restabook' ),
			'id'   => $prefix . 'rs_intro_revolution_slider_button_type',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Self', 'restabook' ),
				'st2' => esc_attr__( 'Blank', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		array(
			'name'		=> 'Promo Video URL',
			'id'		=> $prefix . 'rs_intro_revolution_slider_promo_video_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Youtube/ Viemo video only.<br> e.x: https://vimeo.com/10322316',
		),
		
		array(
			'name'		=> 'View Promo Video',
			'id'		=> $prefix . 'rs_intro_revolution_slider_promo_video_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option.',
		),
		
		
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Corner Border', 'restabook' ),
			'id'   => $prefix . 'rs_intro_revolution_slider_corner_border',
			'desc'  => esc_attr__( 'Effected after screen size 1570px.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Enable', 'restabook' ),
				'st2' => esc_attr__( 'Disable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Social Button', 'restabook' ),
			'id'   => $prefix . 'rs_intro_revolution_slider_social_button_opt',
			'desc'  => esc_attr__( 'Effected after screen size 1570px.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
			array(
				'id'		=> $prefix . 'rs_intro_revolution_slider_social_icon_opt',
				'name'        => 'Social Icon',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Social Icon Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name'		=> 'Icon Class',
						'id'		=> $prefix . 'rs_intro_revolution_slider_social_icon_class',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: fab fa-facebook-f<br><a href="https://fontawesome.com/icons?d=gallery" target="_blank">Fontawesome Icon Class</a>',
					),
					
					array(
						'name'		=> 'Social URL',
						'id'		=> $prefix . 'rs_intro_revolution_slider_social_url',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
					),
					
					
				),
				'hidden' => array( 'rnr_rs_intro_revolution_slider_social_button_opt', '!=', 'st2' )
			),
			
			array(
			'name'		=> 'Scroll ID',
			'id'		=> $prefix . 'rs_intro_revolution_slider_scroll_id',
			'clone'		=> false,
			'type'		=> 'text',
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => 'Write #rs-page if default page template container enable.',
                    'position' => 'top',
                ),
			'std'		=> '',
			'desc'		=> 'e.x: #about. <br> Use VC row section ID.<br> For one page function use page ID or VC row section ID',
			),
			
			array(
			'name'		=> 'Scroll Button Text',
			'id'		=> $prefix . 'rs_intro_revolution_slider_scroll_button_text',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Button will be visible after add text.<br>e.x: Scroll down  to discover',
			),
		
	)
);

// Blog Post Metaboxes
/* ----------------------------------------------------- */


$meta_boxes[] = array(
	'id' => 'rnr-blogmeta-video',
	'title' => 'Post Format Video Option',
	'show'   => array(
    'post_format' => array( 'Video' ),
	),
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> 'Vimeo/ Youtube Video Link:',
			'id'		=> $prefix . 'bl-video',
			'desc'		=> 'Set Vimeo / Youtube Video Embed Link',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		
	)
);


// Blog Post Metaboxes
/* ----------------------------------------------------- */


$meta_boxes[] = array(
	'id' => 'rnr-blogmeta-gallery',
	'title' => 'Post Format Gallery Option',
	'show'   => array(
    'post_format' => array( 'Gallery' ),
	),
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> 'Upload Images',
			'id'		=> $prefix . 'wr_galleryimg_blog',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'desc'		=> 'Use same size images.',
		),

		
	)
);

/* ----------------------------------------------------- */
/* galeery Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'shop_width',
	'title' => 'Shop Options',
	'pages' => array( 'product' ),
	'context' => 'normal',	

	'fields' => array(
		
				
		array(
		'name'		=> 'Header Images',
		'id'		=> $prefix . 'shop_column_grid_details_sidebar_image',
		'clone'		=> false,
		'type'		=> 'image_advanced',
		'max_file_uploads' => '1',
		'desc'		=> 'Details Page Header Image.',
		'tooltip' => array(
            'icon'     => 'help',
            'content'  => 'You can select global header image from Restabook Shop Option.',
            'position' => 'top',
            ),
		),
		
		array(
			'name'		=> 'Header Title',
			'id'		=> $prefix . 'rs_pro_dt_title',
			'desc'		=> 'Details Page Header Title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => 'You can select global header title from Restabook Shop Option.',
            'position' => 'top',
            ),
		),
		
		array(
			'name'		=> 'Header Sub Title',
			'id'		=> $prefix . 'rs_pro_dt_sub_title',
			'desc'		=> 'Details Page Sub Header Sub Title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => 'You can select global header sub title from Restabook Shop Option.',
            'position' => 'top',
            ),
		),
		
		array(
			'name'		=> 'Product description',
			'id'		=> $prefix . 'rs_pro_short_des',
			'desc'		=> 'Affcted only in shop page.',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
		
		array(
			'name'		=> 'Additional Information',
			'id'		=> $prefix . 'rs_pro_additional_info',
			'desc'		=> 'e.x: Sale -30%',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => 'Affcted only in shop page.',
            'position' => 'top',
            ),
		),
		
		array(
			'name'		=> 'Product Video',
			'id'		=> $prefix . 'rs_pro_video_url',
			'desc'		=> 'Youtube/ Vimeo video URL.<br>Optional.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => 'Working only in Shop page and Food Menu Template. ',
            'position' => 'top',
            ),
		),
		
		array(
			'name'		=> 'Custom Price',
			'id'		=> $prefix . 'rs_pro_dt_cus_price',
			'desc'		=> 'e.x: $16, $17, $18',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'tooltip' => array(
            'icon'     => 'help',
            'content'  => 'Only working in WPBakery Food Menu elements & Food Page Template.',
            'position' => 'top',
            ),
		),
		
		
	)
);

// Blog Post Metaboxes
/* ----------------------------------------------------- */


$meta_boxes[] = array(
	'id' => 'one_coming_soon_enable_opt',
	'title' => 'Maintenance Mode Option',
	'show'   => array(
    'template'    => array( 'one-page.php' ),
	),
	'pages' => array( 'page'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(

		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Maintenance Mode', 'restabook' ),
			'id'   => $prefix . 'rs_one_coming_soon_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),

		
	)
);

/* ----------------------------------------------------- */
/* coming soon Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'one_coming_soon_opt',
	'title' => 'Maintenance Mode Options',
	'show'   => array(
    // by metabox select
	'input_value'   => array(
    '#rnr_rs_one_coming_soon_opt'  => 'st2',
    ),
	),
	'pages' => array( 'page' ),
	'context' => 'normal',	

	'fields' => array(
		
		array(
			'name'		=> 'Upload Logo',
			'id'		=> $prefix . 'rs_one_page_cooming_logo_img',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> '',
		),
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Number Counter', 'restabook' ),
			'id'   => $prefix . 'rs_one_commin_page_counter_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		array(
			'name'		=> 'Counter Date',
			'id'		=> $prefix . 'rs_one_comming_soon_date',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: 09/12/2021',
			'tooltip' => array(
                    'icon'     => 'help',
                    'content'  => 'MM DD YYYY',
                    'position' => 'top',
            ),
			'hidden' => array( 'rnr_rs_one_commin_page_counter_opt', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Days',
			'id'		=> $prefix . 'rs_one_commin_page_counter_translate1',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option',
			'hidden' => array( 'rnr_rs_one_commin_page_counter_opt', '!=', 'st2' )
		),
		array(
			'name'		=> 'Hours',
			'id'		=> $prefix . 'rs_one_commin_page_counter_translate2',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option',
			'hidden' => array( 'rnr_rs_one_commin_page_counter_opt', '!=', 'st2' )
		),
		array(
			'name'		=> 'Minutes',
			'id'		=> $prefix . 'rs_one_commin_page_counter_translate3',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option',
			'hidden' => array( 'rnr_rs_one_commin_page_counter_opt', '!=', 'st2' )
		),
		array(
			'name'		=> 'Seconds',
			'id'		=> $prefix . 'rs_commin_page_counter_translate4',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option',
			'hidden' => array( 'rnr_rs_one_commin_page_counter_opt', '!=', 'st2' )
		),
		
		array(
			'name'		=> 'Title',
			'id'		=> $prefix . 'rs_one_comming_soon_title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Under Construction',
		),
		
		array(
			'name'		=> 'Sub Title',
			'id'		=> $prefix . 'rs_one_comming_soon_sub_title',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'e.x: Our Website is Coming Soon',
		),
		
		array(
			'name'		=> 'Form Shortcode',
			'id'		=> $prefix . 'rs_one_comming_soon_form',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Use MailChimp form shortcode. E.X: [mc4wp_form id="264"]',
		),
		
		array(
			'name'		=> 'Upload Slideshow Images',
			'id'		=> $prefix . 'rs_one_page_comming_slider_opt',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1000',
			'desc'		=> '',
			
		),
	
		
		array(
			'name'		=> 'Promo Video URL',
			'id'		=> $prefix . 'rs_one_commin_page_promo_video_url',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Youtube/ Viemo video only.<br> e.x: https://vimeo.com/10322316',
		),
		
		array(
			'name'		=> 'View Promo Video',
			'id'		=> $prefix . 'rs_one_commin_page_promo_video_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option.',
		),
		
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Social Button', 'restabook' ),
			'id'   => $prefix . 'rs_one_commin_page_social_button_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
			array(
				'id'		=> $prefix . 'rs_one_commin_page_social_icon_opt',
				'name'        => 'Social Icon',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Social Icon Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name'		=> 'Icon Class',
						'id'		=> $prefix . 'rs_one_commin_page_social_icon_class',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: fab fa-facebook-f<br><a href="https://fontawesome.com/icons?d=gallery" target="_blank">Fontawesome Icon Class</a>',
					),
					
					array(
						'name'		=> 'Social URL',
						'id'		=> $prefix . 'rs_one_commin_page_social_url',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
					),
					
					
				),
				'hidden' => array( 'rnr_rs_one_commin_page_social_button_opt', '!=', 'st2' )
			),
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Reservation Button', 'restabook' ),
			'id'   => $prefix . 'rs_one_commin_page_reservation_button_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),	
		array(
			'name'		=> 'Table Reservation ',
			'id'		=> $prefix . 'rs_one_commin_page_reservation_button_txt',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> '',
			'desc'		=> 'Translate Option.',
			'hidden' => array( 'rnr_rs_one_commin_page_reservation_button_opt', '!=', 'st2' )
		),
		
		// contcat info
		array(
			'name'     => esc_attr__( 'Contact Information', 'restabook' ),
			'id'   => $prefix . 'rs_one_commin_page_contact_info_opt',
			'desc'  => esc_attr__( '', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Enable', 'restabook' ),
				
				
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
			array(
				'id'		=> $prefix . 'rs_one_commin_page_contact_info_item_opt',
				'name'        => 'Contact Information',
				'type'        => 'group',
				'clone'       => true,
				'sort_clone'  => true,
				'collapsible' => true,
				'group_title' => 'Contact Information Item', // ID of the subfield
				'save_state' => true,
				'fields' => array(
				
					
					array(
						'name'		=> 'Data Title',
						'id'		=> $prefix . 'rs_one_commin_page_contact_info_data_title',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: Call',
					),
					
					array(
					'name'     => esc_attr__( 'Data Type', 'restabook' ),
					'id'   => $prefix . 'rs_one_page_cooming_contact_info_data_type',
					'desc'  => __( '', 'restabook' ),
					'type'     => 'select_advanced',
					// Array of 'value' => 'Label' pairs for select box
					'options'  => array(
						
						'st1' => esc_attr__( 'Mobile Number', 'restabook' ),
						'st2' => esc_attr__( 'Email Address', 'restabook' ),
						'st3' => esc_attr__( 'Custom URL', 'restabook' ),
					),
					// Select multiple values, optional. Default is false.
					'multiple'    => false,
					'std'         => 'st1',
					'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
				  ),
					
					array(
						'name'		=> 'Mobile Number',
						'id'		=> $prefix . 'rs_one_commin_page_contcat_info_mobile_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
						'hidden' => array( 'rnr_rs_one_page_cooming_contact_info_data_type', '!=', 'st1' )
					),
					
					array(
						'name'		=> 'Email Address',
						'id'		=> $prefix . 'rs_one_commin_page_contcat_info_email_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
						'hidden' => array( 'rnr_rs_one_page_cooming_contact_info_data_type', '!=', 'st2' )
					),
					
					array(
					'name'     => esc_attr__( 'Link Target', 'restabook' ),
					'id'   => $prefix . 'rs_one_page_cooming_contact_info_link_target',
					'desc'  => __( '', 'restabook' ),
					'type'     => 'select_advanced',
					// Array of 'value' => 'Label' pairs for select box
					'options'  => array(
						
						'_self' => esc_attr__( 'Self', 'restabook' ),
						'_blank' => esc_attr__( 'Blank', 'restabook' ),
					),
					// Select multiple values, optional. Default is false.
					'multiple'    => false,
					'std'         => 'st1',
					'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
					'hidden' => array( 'rnr_rs_one_page_cooming_contact_info_data_type', '!=', 'st3' )
				  ),
				  
				  array(
						'name'		=> 'Custom URL Content',
						'id'		=> $prefix . 'rs_one_commin_page_contcat_info_url_con_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> 'e.x: USA 27TH Brooklyn NY',
						'hidden' => array( 'rnr_rs_one_page_cooming_contact_info_data_type', '!=', 'st3' )
					),
					
					array(
						'name'		=> 'Custom URL',
						'id'		=> $prefix . 'rs_one_commin_page_contcat_info_url_opt',
						'clone'		=> false,
						'type'		=> 'text',
						'std'		=> '',
						'desc'		=> '',
						'hidden' => array( 'rnr_rs_one_page_cooming_contact_info_data_type', '!=', 'st3' )
					),
				),
				'hidden' => array( 'rnr_rs_one_commin_page_contact_info_opt', '!=', 'st2' )
			),
			
		// SELECT BOX
		array(
			'name'     => esc_attr__( 'Content Section Background Effect', 'restabook' ),
			'id'   => $prefix . 'rs_one_page_cooming_bottom_back_effect',
			'desc'  => __( 'Enable/ Disable content section background effect.', 'restabook' ),
			'type'     => 'select_advanced',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				
				'st1' => esc_attr__( 'Disable', 'restabook' ),
				'st2' => esc_attr__( 'Default Effect', 'restabook' ),
				'st3' => esc_attr__( 'Custom Image', 'restabook' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'st1',
			'placeholder' => esc_attr__( 'Select an Option', 'restabook' ),
		),
		
		array(
			'name'		=> 'Upload Custom Image',
			'id'		=> $prefix . 'rs_one_page_cooming_bottom_back_effect_img',
			'clone'		=> false,
			'type'		=> 'image_advanced',
			'max_file_uploads' => '1',
			'desc'		=> '',
			'hidden' => array( 'rnr_rs_one_page_cooming_bottom_back_effect', '!=', 'st3' )
		),
		
	)
);

//taxonomy cat
add_filter( 'rwmb_meta_boxes', 'restabook_register_taxonomy_meta_boxes' );
function restabook_register_taxonomy_meta_boxes( $meta_boxes ){
    $meta_boxes[] = array(
        'title'      => '',
        'taxonomies' => 'category', // THIS: List of taxonomies. Array or string

        'fields' => array(
            
            array(
                'name' => 'Thumbnail',
                'id'   => 'restabook_pos_cat_image_advanced',
                'type' => 'image_advanced',
				'max_file_uploads' => '1',
            ),
            
        ),
    );
    return $meta_boxes;
}

//taxonomy tag
add_filter( 'rwmb_meta_boxes', 'restabook_register_taxonomy_tag_meta_boxes' );
function restabook_register_taxonomy_tag_meta_boxes( $meta_boxes ){
    $meta_boxes[] = array(
        'title'      => '',
        'taxonomies' => 'post_tag', // THIS: List of taxonomies. Array or string

        'fields' => array(
            
            array(
                'name' => 'Thumbnail',
                'id'   => 'restabook_pos_tag_image_advanced',
                'type' => 'image_advanced',
				'max_file_uploads' => '1',
            ),
            
        ),
    );
    return $meta_boxes;
}


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function restabook_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'restabook_register_meta_boxes' );