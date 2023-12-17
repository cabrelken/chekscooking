<?php
/*
Plugin Name: Restabook Plugin
Plugin URI: https://webredox.net
Description: Declares a plugin that will create Page Settins, VC addons & Custom Post Type
Version: 4.0
Author: webRedox
Author URI: https://webredox.net
License: GPLv2
*/
define('RESTABOOK_VERSION', '4.0');
define('RESTABOOK_PLUGIN_PATH',		plugin_dir_path(__FILE__));
define('RESTABOOK_URL', plugins_url('', __FILE__));
include (RESTABOOK_PLUGIN_PATH .'meta-box-group.php');
include (RESTABOOK_PLUGIN_PATH .'meta-box-show-hide.php');
include (RESTABOOK_PLUGIN_PATH .'meta-box-tooltip.php');
include (RESTABOOK_PLUGIN_PATH .'meta-box-conditional-logic.php');
include (RESTABOOK_PLUGIN_PATH .'mb-term-meta.php');
include (RESTABOOK_PLUGIN_PATH .'restabook-post-order.php');
include (RESTABOOK_PLUGIN_PATH .'page-links-to.php');


function restabook_register_metabox_list() {
require (RESTABOOK_PLUGIN_PATH .'/plugin-update-checker/plugin-update-checker.php');
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://webredox.net/demo/wp/restabook/pluginupdate/details.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'restabook-plugin'
);
include (RESTABOOK_PLUGIN_PATH .'metaboxes.php');
}
add_action('init', 'restabook_register_metabox_list');

global $restabook_options;

add_filter('widget_title', 'do_shortcode');
add_shortcode('span', 'wpse_shortcode_span');
function wpse_shortcode_span( $attr, $content ){ return '<span>'. $content . '</span>'; }
add_shortcode('br', 'wpse_shortcode_br');
function wpse_shortcode_br( $attr ){ return '<br>'; }
function nastik_social_media_icons( $nastik_contactmethods ) {
    // Add social media
    
    $nastik_contactmethods['twitter'] = 'Twitter';
    $nastik_contactmethods['facebook'] = 'Facebook';
    $nastik_contactmethods['instagram'] = 'Instagram';
    $nastik_contactmethods['tumblr'] = 'Tumblr';
    $nastik_contactmethods['pinterest'] = 'Pinterest';
    $nastik_contactmethods['youtube'] = 'Youtube';

    return $nastik_contactmethods;
}
add_filter('user_contactmethods','nastik_social_media_icons',10,1);

function restabook_woo_product_price_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'id' => null
	), $atts, 'iconic_product_price' );
	if ( empty( $atts[ 'id' ] ) ) {
		return '';
	}
	$product = wc_get_product( $atts['id'] );
	if ( ! $product ) {
		return '';
	}
	return $product->get_price_html();
}
if (!class_exists('WooCommerce')) {
add_shortcode( 'restabook_product_price', 'restabook_woo_product_price_shortcode' );
}


/* ==========================================
   Add featured image column to admin panel post list page
========================================== */
add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
	$columns['img'] = 'Thumbnail';
	return $columns;
}

function manage_img_column($column_name, $post_id) {
	if( $column_name == 'img' ) {
		echo get_the_post_thumbnail( $post_id, array( 80, 60) ); return true; // 80, 60 is for image size.
	}
}

// Change columns order
add_filter('manage_posts_columns', 'column_order');
function column_order($columns) {
  $n_columns = array();
  $move = 'img'; // what to move
  $before = 'title'; // move before this
  foreach($columns as $key => $value) {
    if ($key==$before){
      $n_columns[$move] = $move;
    }
      $n_columns[$key] = $value;
  }
  return $n_columns;
}
function restabook_year_shortcode() {
  $restabook_year = date('Y');
  return $restabook_year;
}
add_shortcode('restabook_year', 'restabook_year_shortcode');
/**
*
*
*
 * Allow shortcodes in widgets
 * @since v1.0
 */
add_filter('widget_text', 'do_shortcode');

if( !function_exists('symple_fix_shortcodes') ) {
	function symple_fix_shortcodes($content){   
		$array = array (
			'<p>['		=> '[', 
			']</p>'		=> ']', 
			']<br />'	=> ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
	add_filter('the_content', 'symple_fix_shortcodes');
}

// fancy image
if(! function_exists('restabook_fancy_image_shortcode')){
	function restabook_fancy_image_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'image'=>'',
			'image_second'=>'',
			'rs_image_positon'=>'st1',
			'rs_image_margin'=>'rs-no-img-margin',
			
			), $atts) );
		if(is_numeric($image)) {
            $restabook_image = wp_get_attachment_url( $image );
            $restabook_title = get_the_title( $image );
        }else {
            $restabook_image = $image;
            $restabook_title = $image;
        }
		
		if(is_numeric($image_second)) {
            $restabook_image_2nd = wp_get_attachment_url( $image_second );
            $restabook_title_2nd = get_the_title( $image_second );
        }else {
            $restabook_image_2nd = $image_second;
            $restabook_title_2nd = $image_second;
        }
		
		$html='';
		$dot="'";
		$pull_left="";
		if($rs_image_positon == "st2"){
		$pull_left='data-position-right="68"';
		$pull_left_ani='data-position-right="-23"';
		}
		else {
		$pull_left='data-position-left="68"';
		$pull_left_ani='data-position-left="-23"';
		}
		
		$html .= '<div class="image-collge-wrap fl-wrap '.esc_attr($rs_image_margin).'">';
		if(is_numeric($image)) {
		$html .= '<div class="main-iamge">
                  <img src="'.esc_url($restabook_image).'"   alt="'.esc_attr($restabook_title).'">
                  </div>';
		}
		$html .= '<div class="images-collage-item" style="width:65%" '.$pull_left.' data-position-top="-15" data-zindex="2" data-opacity="1.0"><img src="'.esc_url($restabook_image_2nd).'" alt="'.esc_attr($restabook_title_2nd).'"></div>';
		$html .= '<div class="images-collage-item col_par" style="width:120px" '.$pull_left_ani.' data-position-top="-17" data-zindex="9" data-scrollax="properties: { translateY: '.$dot.'150px'.$dot.' }"><img src="'.RESTABOOK_THEME_URL.'/includes/images/cube.png" alt=""></div>';
		$html .= '</div>';
		
				
		return $html;
	}
	add_shortcode('restabook_fancy_image', 'restabook_fancy_image_shortcode');
}
// quote
if(! function_exists('restabook_quote_shortcode')){
	function restabook_quote_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'image'=>'',
			'signature_image'=>'',
			'title'=>'',
			'column_position'=>'left-wrap',
			'disable_column'=>'st1',
			
			), $atts) );
		if(is_numeric($image)) {
            $restabook_image = wp_get_attachment_url( $image );
            $restabook_title = get_the_title( $image );
        }else {
            $restabook_image = $image;
            $restabook_title = $image;
        }
		
		if(is_numeric($signature_image)) {
            $nastik_signature_image_image = wp_get_attachment_url( $signature_image );
            $nastik_signature_image_title = get_the_title( $signature_image );
        }else {
            $nastik_signature_image_image = $signature_image;
            $nastik_signature_image_title = $signature_image;
        }
		
		$html='';
		$dot="'";
		
		if($disable_column == 'st2'){
		$html .= '<div class="fl-wrap column-wrap-bg column-wrap-bg-full '.esc_attr($class).'">';
		}
		else {
		$html .= '<div class="column-wrap-bg '.esc_attr($column_position).' '.esc_attr($class).'">';
		}
		
		$html .= '<div class="bg par-elem "  data-bg="'.esc_url($restabook_image).'" data-scrollax="properties: { translateY: '.$dot.'30%'.$dot.' }"></div>';
		$html .= '<div class="overlay"></div>';
		$html .= '<div class="quote-box">';
		$html .= '<i class="fal fa-quote-right"></i>';
		$html .= '<p>"'.$content.'"</p>';
		if(is_numeric($signature_image)) {
		$html .= '<div class="signature"><img src="'.esc_url($nastik_signature_image_image).'" alt="'.esc_attr($nastik_signature_image_title).'"></div>';
		}
		$html .= '<h4>'.esc_html($title).'</h4>';
		$html .= '</div>';
		$html .= '</div>';
		
				
		return $html;
	}
	add_shortcode('restabook_quote', 'restabook_quote_shortcode');
}

// call-to-action-2
if(! function_exists('restabook_callto_2_shortcode')){
	function restabook_callto_2_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'image'=>'',
			'sub_title'=>'',
			'title'=>'',
			'column_position'=>'left-wrap',
			'button_text'=>'Add Button Text',
			'button_url'=>'',
			'button_target'=>'',
			'disable_column'=>'st1',
			'button_type'=>'',
			
			
			), $atts) );
		if(is_numeric($image)) {
            $restabook_image = wp_get_attachment_url( $image );
            $restabook_title = get_the_title( $image );
        }else {
            $restabook_image = $image;
            $restabook_title = $image;
        }
		
		
		$html='';
		$dot="'";
		
		
		if($disable_column == 'st2'){
		$html .= '<div class="column-wrap-bg-full column-wrap-bg fl-wrap dark-bg '.esc_attr($class).'">';
		}
		else {
		$html .= '<div class="column-wrap-bg '.esc_attr($column_position).' '.esc_attr($class).'">';
		}
		
		$html .= '<div class="bg par-elem "  data-bg="'.esc_url($restabook_image).'" data-scrollax="properties: { translateY: '.$dot.'30%'.$dot.' }"></div>';
		$html .= '<div class="overlay"></div>';
		$html .= '<div class="column-wrap-bg-text">';
		$html .= '<h3>'.esc_html($title).'</h3>';
		$html .= '<h4>'.esc_html($sub_title).'</h4>';
		$link_target_opt ='';
		if($button_target == "_blank"){
		$link_target_opt .='_blank';
		}
		else if($button_target == "_parent"){
		$link_target_opt .='_parent';
		}
		else if($button_target == "_top"){
		$link_target_opt .='_top';
		}
		else {
		$link_target_opt .='_self';
		};
		if($button_type == "st2"){
		$html .= '<a href="#" class="no-align btn fl-btn show-rb" >'.esc_html($button_text).'<i class="fal fa-long-arrow-right"></i></a>';
		}
		else {
		if($button_url != ""){
		$html .= '<a href="'.esc_url($button_url).'" class="no-align btn fl-btn" target="'.esc_attr($link_target_opt).'" rel="noopener noreferrer">'.esc_html($button_text).'<i class="fal fa-long-arrow-right"></i></a>';
		}
		}
		$html .= '</div>';
		$html .= '</div>';
		
				
		return $html;
	}
	add_shortcode('restabook_callto_2', 'restabook_callto_2_shortcode');
}

// work time
if(! function_exists('restabook_work_time_shortcode')){
	function restabook_work_time_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'image'=>'',
			'title'=>'',
			'sub_title'=>'',
			'column_position'=>'right-column-section',
			'second_column'=>'st1',
			'disable_column'=>'st1',
			'phone_number'=>'',
			'work_data_1_day'=>'',
			'work_data_2_day'=>'',
			'work_data_1_start_time'=>'',
			'work_data_2_start_time'=>'',
			'work_data_1_end_time'=>'',
			'work_data_2_end_time'=>'',
			'back_img_opt'=>'',
			
			), $atts) );
		if(is_numeric($image)) {
            $restabook_image = wp_get_attachment_url( $image );
            $restabook_title = get_the_title( $image );
        }else {
            $restabook_image = $image;
            $restabook_title = $image;
        }
		
		
		$html='';
		$dot="'";
		
		
		if($disable_column == 'st2'){
		$html .= '<div class="column-text_inside fl-wrap dark-bg '.esc_attr($class).'">';
		}
		else {
		$html .= '<div class="column-section-wrap dark-bg '.esc_attr($column_position).' '.esc_attr($class).'">';
		}
		$html .= '<div class="container"  >';
		$html .= '<div class="column-text">';
			//Start section title
			$html .= '<div class="section-title">';
			if($sub_title != ""){
			$html .= '<h4>'.esc_html($sub_title).'</h4>';
			}
			if($title != ""){
			$html .= '<h2>'.esc_html($title).'</h2>';
			$html .= '<div class="dots-separator fl-wrap"><span></span></div>';
			}
			$html .= '</div>';
			//End section title
			//Start work-time
			$html .= '<div class="work-time fl-wrap">';
			$html .= '<div class="row">';
				//Start 1st column
				$html .= '<div class="';
				if($second_column == 'st2'){
				$html .= 'col-sm-6';
				}
				else{
				$html .= 'col-sm-12';
				}
				$html .= '">';
				$html .= '<h3>'.esc_html($work_data_1_day).'</h3>';
				$html .= '<div class="hours">';
				if($work_data_1_start_time != ""){
				$html .= ''.esc_html($work_data_1_start_time).'<br>';
				}
				$html .= ''.esc_html($work_data_1_end_time).'';
				$html .= '</div>';
				$html .= '</div>';
				//End 1st column
				if($second_column == 'st2'){
				//Start 2nd column
				$html .= '<div class="col-sm-6">';
				$html .= '<h3>'.esc_html($work_data_2_day).'</h3>';
				$html .= '<div class="hours">';
				if($work_data_2_start_time != ""){
				$html .= ''.esc_html($work_data_2_start_time).'<br>';
				}
				$html .= ''.esc_html($work_data_2_end_time).'';
				$html .= '</div>';
				$html .= '</div>';
				//End 2nd column
				}
			$html .= '</div>';
			$html .= '</div>';
			//End work-time
		$html .= '<div class="clearfix"></div>
                  <div class="bold-separator"><span></span></div>';
		if($phone_number != ""){
		$html .= '<div class="big-number"><a href="tel:'.esc_attr($phone_number).'">'.esc_html($phone_number).'</a></div>';
		}
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="illustration_bg">';
		if($back_img_opt == 'st2'){
		if(is_numeric($image)) {
        $html .= '<div class="bg"  data-bg="'.esc_url($restabook_image).'"></div>';
		}
		}
		else if($back_img_opt == 'st3'){
		}
		else {
		$html .= '<div class="bg"  data-bg="'.RESTABOOK_THEME_URL.'/includes/images/bg/dec/7.png"></div>';
		}
		
        $html .='</div>';
		$html .= '</div>';
		
				
		return $html;
	}
	add_shortcode('restabook_work_time', 'restabook_work_time_shortcode');
}


// Food Menu Tab
if(! function_exists('restabook_menu_tab_shortcode')){

	function restabook_menu_tab_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'postcount'=>'',
			'postoffset'=>'',
			'categoryname_main'=>'',
			'button_type'=>'',
			'button_url'=>'',
			'button_target'=>'',
			'button_style'=>'st1',
			'button_text'=>'Add Button Text',
			'text_button_text'=>'Add Button Text',
			'text_button_url'=>'',
			'text_button_target'=>'',
			'button_filter'=>'',
			'post_number_counting'=>'',
			'category_number_counting'=>'',
			'category_image_opt'=>'',
			'parent_filter'=>'',
			'parent_cat_id'=>'',
			'exclude_cat_id'=>'',
			'exclude_main_cat_id'=>'',
			'cat_count'=>'',
			'filter_text'=>'Show Filters',
			
			), $atts) );
		
		
		$html='';
		
		if (class_exists('WooCommerce')) {
		$html .= '<div class="hero-menu tabs-act fl-wrap woocommerce menu-tab-short">';
		$html .= '<div class="row">';
		if($button_filter == "st2"){
		//hero-menu_content
			$html .= '<div class="col-md-12">';
			$html .= '<div class="hero-menu_content fl-wrap">';
			$html .= '<div class="tabs-container">';
			
			$html .= '<div class="tab">';
			
			//$html .= '<div id="tab-1" class="tab-content first-tab-1>';
			
			global $post;
			$paged=(get_query_var('paged'))?get_query_var('paged'):1;
			$loop = new WP_Query( array( 'post_type' => 'product','product_cat'=> esc_attr($categoryname_main), 'posts_per_page'=> esc_attr($postcount),  'offset' => esc_attr($postoffset)) );
			$restabook_counter_tab_post=1;
			while ( $loop->have_posts() ) : $loop->the_post();
			
			//item start
			$html .= '<div class="hero-menu-item">';
			$html .= '<div class="hero-menu-item-title fl-wrap">';
			$html .= '<h6><a href="'.get_the_permalink().'">';
			if($post_number_counting != "st2"){
			$html .= '<span>0'.$restabook_counter_tab_post.'.</span>';
			}
			$html .= ''.get_the_title().'</a></h6>';
			$restabook_options = get_option('restabook');
			if ($restabook_options['catalog_mode_price']!="st2") {
			$html .= '<div class="hmi-dec"></div>';
			if (( get_post_meta($post->ID,'rnr_rs_pro_dt_cus_price',true))):
			$html .= '<span class="hero-menu-item-price">'.esc_html(get_post_meta($post->ID,'rnr_rs_pro_dt_cus_price',true)).'</span>';
			else : 
			$html .= '<span class="hero-menu-item-price">'.do_shortcode('[restabook_product_price id="'.get_the_ID().'"]').'</span>';
			endif;
			}
			
			if ($restabook_options['catalog_mode_add_cart']!="st2") {
			$html .= ''.do_shortcode('[add_to_cart show_price="FALSE" sku="" style="border:none; padding: 0px;" id="'.get_the_ID().'"]').'';
			}
			if ($restabook_options['catalog_mode_add_cart']!="st1") {
			if(!empty($restabook_options['catalog_placeholder_button_shop_url'])):
			$html .= '<a href="'. esc_url(Restabook_AfterSetupTheme::return_thme_option('catalog_placeholder_button_shop_url','')).'" class="add_cart">';
			if(!empty($restabook_options['catalog_placeholder_button_shop_txt'])):
			$html .= ''.esc_html(Restabook_AfterSetupTheme::return_thme_option('catalog_placeholder_button_shop_txt','')).'';
			else :
			$html .= 'Read More';
			endif;
			$html .= '</a>';
			endif;
			}
			$html .= '</div>';
			$html .= '<div class="hero-menu-item-details">';
			if (( get_post_meta($post->ID,'rnr_rs_pro_short_des',true))):
			$html .= '<p>'.esc_html(get_post_meta($post->ID,'rnr_rs_pro_short_des',true)).'</p>';
			endif;
			$html .= '</div>';
			$html .= '</div>';
			//item end
			
			$restabook_counter_tab_post++; 
			endwhile;
			wp_reset_postdata();
			//$html .= '</div>';
			
			$html .= '</div>';
			
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		} 
		else {
			if(!get_post_meta(get_the_ID(), 'product_cat', true)):
			if($parent_filter == "st2"){
			$restabook_menu_tab_titles = get_terms('product_cat', array('parent' => esc_attr($parent_cat_id), 'exclude' => esc_attr($exclude_cat_id), 'number'=> esc_attr($cat_count),  ));
			}
			else {
			$restabook_menu_tab_titles = get_terms('product_cat', array('exclude' => esc_attr($exclude_main_cat_id),  'number'=> esc_attr($cat_count), 'hide_empty'  => 1,));
			}
			if($restabook_menu_tab_titles):
			//hero-menu_header
			$html .= '<div class="col-md-3">';
			$html .= '<div class="hero-menu_header fl-wrap">';
			
			$html .= '<ul class="tabs-menu no-list-style change_bg ">';
			$restabook_counter=1;
			$restabook_count = count($restabook_menu_tab_titles);
			foreach($restabook_menu_tab_titles as $restabook_menu_tab_title):
			$restabook_thumbnail_id = get_term_meta( $restabook_menu_tab_title->term_id, 'thumbnail_id', true );
			$restabook_image = wp_get_attachment_url( $restabook_thumbnail_id );
			$html .= '<li class="re-cat-'.$restabook_menu_tab_title->term_id.' ';
			if ($restabook_counter == 1) :
			$html .='current';
			endif;
			$restabook_shop_back = Restabook_AfterSetupTheme::return_thme_option('shopheaderimg','url');
			if($category_image_opt == "st2"){
			$html .='"><a href="#tab-'.esc_attr($restabook_menu_tab_title->term_id).'" data-bgtab="'.$restabook_shop_back.'">';
			if($category_number_counting != "st2"){
			$html .='<span>0'.$restabook_counter.'.</span>';
			}
			$html .=''.esc_html($restabook_menu_tab_title->name).'</a></li>';
			}
			else {
			
			if ( $restabook_image ) {
			$html .='"><a href="#tab-'.esc_attr($restabook_menu_tab_title->term_id).'" data-bgtab="'.esc_url($restabook_image).'">';
			if($category_number_counting != "st2"){
			$html .='<span>0'.esc_html($restabook_counter).'.</span>';
			}
			$html .=''.esc_html($restabook_menu_tab_title->name).'</a></li>';
			}
			else {
			$html .='"><a href="#tab-'.esc_attr($restabook_menu_tab_title->term_id).'" data-bgtab="'.esc_url($restabook_shop_back).'">';
			if($category_number_counting != "st2"){
			$html .='<span>0'.esc_html($restabook_counter).'.</span>';
			}
			$html .=''.esc_html($restabook_menu_tab_title->name).'</a></li>';
			}
			}
			$restabook_counter++;
			endforeach;
			$html .= '</ul>';
			$html .= '</div>';
			$html .= '</div>';
			//hero-menu_header end
			endif;
			endif;
			//hero-menu_content
			$html .= '<div class="col-md-9">';
			$html .= '<div class="hero-menu_content vc-tab-st-no-pad fl-wrap">';
			$html .= '<div class="tabs-container">';
			if(!get_post_meta(get_the_ID(), 'product_cat', true)):
			if($parent_filter == "st2"){
			$restabook_menu_tab_inners = get_terms('product_cat', array('parent' => esc_attr($parent_cat_id), 'exclude' => esc_attr($exclude_cat_id)  ));
			}
			else {
			$restabook_menu_tab_inners = get_terms('product_cat', array('exclude' => esc_attr($exclude_main_cat_id)));
			}
			
			if($restabook_menu_tab_inners):
			$html .= '<div class="tab">';
			$restabook_counter_tab=1;
			foreach($restabook_menu_tab_inners as $restabook_menu_tab_inner):
			$html .= '<div id="tab-'.esc_attr($restabook_menu_tab_inner->term_id).'" class="tab-content first-tab-'.esc_attr($restabook_counter_tab).'">';
			$categoryname = $restabook_menu_tab_inner->slug;
			global $post;
			$paged=(get_query_var('paged'))?get_query_var('paged'):1;
			$loop = new WP_Query( array( 'post_type' => 'product','product_cat'=> esc_attr($categoryname), 'posts_per_page'=> esc_attr($postcount),  'offset' => esc_attr($postoffset)) );
			$restabook_counter_tab_post=1;
			while ( $loop->have_posts() ) : $loop->the_post();
			
			//item start
			$html .= '<div class="hero-menu-item '.esc_attr($restabook_menu_tab_inner->slug).'">';
			$html .= '<div class="hero-menu-item-title fl-wrap">';
			$html .= '<h6><a href="'.get_the_permalink().'">';
			if($post_number_counting != "st2"){
			$html .= '<span>0'.esc_html($restabook_counter_tab_post).'.</span>';
			}
			$html .= ''.get_the_title().'</a></h6>';
			$restabook_options = get_option('restabook');
			if ($restabook_options['catalog_mode_price']!="st2") {
			$html .= '<div class="hmi-dec"></div>';
			if (( get_post_meta($post->ID,'rnr_rs_pro_dt_cus_price',true))):
			$html .= '<span class="hero-menu-item-price">'.esc_html(get_post_meta($post->ID,'rnr_rs_pro_dt_cus_price',true)).'</span>';
			else : 
			$html .= '<span class="hero-menu-item-price">'.do_shortcode('[restabook_product_price id="'.get_the_ID().'"]').'</span>';
			endif;
			}
			
			if ($restabook_options['catalog_mode_add_cart']!="st2") {
			$html .= ''.do_shortcode('[add_to_cart show_price="FALSE" sku="" style="border:none; padding: 0px;" id="'.get_the_ID().'"]').'';
			}
			if ($restabook_options['catalog_mode_add_cart']!="st1") {
			if(!empty($restabook_options['catalog_placeholder_button_shop_url'])):
			$html .= '<a href="'. esc_url(Restabook_AfterSetupTheme::return_thme_option('catalog_placeholder_button_shop_url','')).'" class="add_cart">';
			if(!empty($restabook_options['catalog_placeholder_button_shop_txt'])):
			$html .= ''.esc_html(Restabook_AfterSetupTheme::return_thme_option('catalog_placeholder_button_shop_txt','')).'';
			else :
			$html .= 'Read More';
			endif;
			$html .= '</a>';
			endif;
			}
			$html .= '</div>';
			$html .= '<div class="hero-menu-item-details">';
			if (( get_post_meta($post->ID,'rnr_rs_pro_short_des',true))):
			$html .= '<p>'.esc_html(get_post_meta($post->ID,'rnr_rs_pro_short_des',true)).'</p>';
			endif;
			$html .= '</div>';
			$html .= '</div>';
			//item end
			
			$restabook_counter_tab_post++; 
			endwhile;
			wp_reset_postdata();
			$html .= '</div>';
			$restabook_counter_tab++; 
			endforeach;
			$html .= '</div>';
			endif;
			endif;
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			}
			//hero-menu_content
		$html .= '<div class="clearfix"></div>';
		$link_target_opt ='';
		if($button_target == "_blank"){
		$link_target_opt .='_blank';
		}
		else if($button_target == "_parent"){
		$link_target_opt .='_parent';
		}
		else if($button_target == "_top"){
		$link_target_opt .='_top';
		}
		else {
		$link_target_opt .='_self';
		};
		//button style
		$button_style_opt ='';
		if($button_style == "st2"){
		$button_style_opt .='btn fl-btn border-btn';
		}
		else if($button_style == "st3"){
		$button_style_opt .='hero_btn';
		}
		else {
		$button_style_opt .='btn fl-btn';
		};
		$html .= '<div class="fl-wrap text-align_left_rs">';
		if($button_type == "st2"){
		$html .= '<a href="#" class="'.esc_attr($button_style_opt).' show-rb"  style="margin-left:30px;">'.esc_html($button_text).'<i class="fal fa-long-arrow-right"></i></a>';
		}
		else {
		if($button_url != ""){
		$html .= '<a href="'.esc_url($button_url).'" class="'.esc_attr($button_style_opt).'" target="'.esc_attr($link_target_opt).'" rel="noopener noreferrer" style="margin-left:30px;">'.esc_html($button_text).'<i class="fal fa-long-arrow-right"></i></a>';
		}
		}
		$text_link_target_opt ='';
		if($text_button_target == "_blank"){
		$text_link_target_opt .='_blank';
		}
		else if($text_button_target == "_parent"){
		$text_link_target_opt .='_parent';
		}
		else if($text_button_target == "_top"){
		$text_link_target_opt .='_top';
		}
		else {
		$text_link_target_opt .='_self';
		};
		if($text_button_url != ""){
		$html .= '<a href="'.esc_url($text_button_url).'" class="pdf-link" target="'.esc_attr($text_link_target_opt).'" rel="noopener noreferrer">'.esc_html($text_button_text).'</a>';
		}
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		
		}
		
		return $html;
	}
	
	add_shortcode('restabook_menu_tab', 'restabook_menu_tab_shortcode');

}


// Call To Action
if(! function_exists('restabook_call_to_action_shortcode')){
	function restabook_call_to_action_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'id'=>'',
			'title'=>'Want to cook something tasty? Read our best recipes.',
			'button_text'=>'Recipes Book ',
			'button_url'=>'',
			'button_target'=>'',
			'link_type'=>'',
			'button_type'=>'',
		), $atts) );
		
		
		$html='';
		$link_target_opt ='';
		if($button_target == "_blank"){
		$link_target_opt .='_blank';
		}
		else if($button_target == "_parent"){
		$link_target_opt .='_parent';
		}
		else if($button_target == "_top"){
		$link_target_opt .='_top';
		}
		else {
		$link_target_opt .='_self';
		}
		
		$html .= '<div class="align-text-block">';
		$html .= '<h4>'.$title.'</h4>';
		if($button_type == "st2"){
		$html .= '<a href="#" class="btn show-rb">'.esc_html($button_text).'<i class="fal fa-long-arrow-right"></i></a>';
		}
		else { 
		if($button_url != ""){
		$html .= '<a href="'.esc_url($button_url).'" class="btn" target="'.esc_attr($link_target_opt).'" rel="noopener noreferrer">'.esc_html($button_text).'<i class="fal fa-long-arrow-right"></i></a>';
		}
		}
		$html .= '</div>';
		
		return $html;
	}
	add_shortcode('restabook_call_to_action', 'restabook_call_to_action_shortcode');
}

// 
if(! function_exists('restabook_team_shortcode')){
	function restabook_team_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
			'class'=>'',
			'image'=>'',
			'title'=>'',
			'designation'=>'',
			'behance'=>'',
			'facebook'=>'',
			'tiktok'=>'',
			'twitter'=>'',
			'youtube'=>'',
			'vimeo'=>'',
			'pinterest'=>'',
			'linkedin'=>'',
			'instagram'=>'',
			'xing'=>'',
			'mail'=>'',
			'vkontakte'=>'',
			'custom_url'=>'',
			'follow_text'=>'',
				

			), $atts) );
			if(is_numeric($image)) {
            $nastik_team_image = wp_get_attachment_url( $image );
        }else {
            $nastik_team_image = $image;
        }

		$html ='';
		
		
		$html .= '<div class="about-wrap  fl-wrap">';
		$html .= '<div class="team-box">';
		$html .= '<div class="team-photo">';
		if(is_numeric($image)) {
		$html .= '<img src="'.esc_url($nastik_team_image).'" alt="'.esc_attr($title).'" class="respimg">';
		}
		$html .= '<div class="overlay"></div>';
		$html .= '<div class="team-social">';
		if($follow_text != '') {
		$html .= '<span class="ts_title">'.esc_html($follow_text).'</span>';
		}
		$html .= '<ul class="no-list-style">';
		if($facebook != '') {
		$html .= '<li><a href="'.esc_url($facebook).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a></li>';
		}
		if($instagram != '') {
		$html .= '<li><a href="'.esc_url($instagram).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a></li>';
		}
		if($twitter != '') {
		$html .= '<li><a href="'.esc_url($twitter).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a></li>';
		}
		if($vkontakte != '') {
		$html .= '<li><a href="'.esc_url($vkontakte).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-vk"></i></a></li>';
		}
		if($tiktok != '') {
		$html .= '<li><a href="'.esc_url($tiktok).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-tiktok"></i></a></li>';
		}
		if($vimeo != '') {
		$html .= '<li><a href="'.esc_url($vimeo).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-vimeo"></i></a></li>';
		}
		if($linkedin != '') {
		$html .= '<li><a href="'.esc_url($linkedin).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a></li>';
		}
		if($youtube != '') {
		$html .= '<li><a href="'.esc_url($youtube).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube-square"></i></a></li>';
		}
		if($xing != '') {
		$html .= '<li><a href="'.esc_url($xing).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-xing"></i></a></li>';
		}
		if($pinterest != '') {
		$html .= '<li><a href="'.esc_url($pinterest).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-pinterest-p"></i></a></li>';
		}
		if($behance != '') {
		$html .= '<li><a href="'.esc_url($behance).'" target="_blank" rel="noopener noreferrer"><i class="fab fa-behance"></i></a></li>';
		}
		if($mail != '') {
		$html .= '<li><a href="mailto:'.esc_attr($mail).'" target="_blank" rel="noopener noreferrer"><i class="fal fa-envelope"></i></a></li>';
		}
		$html .= '</ul>';
		$html .= '</div>';
		
		$html .= '</div>';
		$html .= '<div class="team-info fl-wrap">';
		if($custom_url != '') {
		$html .= '<h3><a href="'.esc_url($custom_url).'">'.esc_html($title).'</a></h3>';
		}
		else {
		$html .= '<h3>'.esc_html($title).'</h3>';
		}
		$html .= '<h4>'.esc_html($designation).'</h4>';
		$html .= '<p>'.$content.'  </p>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		
		return $html ;
	}
	add_shortcode('restabook_team', 'restabook_team_shortcode');
}

// image slider
if(! function_exists('restabook_image_slider_shortcode')){
	function restabook_image_slider_shortcode($atts, $content = null){
		extract(shortcode_atts( array(
		'image'=>'',
		'rs_image_margin'=>'rs-no-img-margin',
		), $atts) );
		
		$ids   = $atts['image'];
		$ids   = explode(',', $ids);
		
		$html='';
		$dot="'";
		
		$html .= '<div class="image-collge-wrap fl-wrap '.esc_attr($rs_image_margin).'">';
		$html .= '<div class="single-slider-wrap">';
		$html .= '<div class="single-slider fl-wrap">';
		$html .= '<div class="swiper-container">';
		$html .= '<div class="swiper-wrapper lightgallery">';
		foreach ($ids as $id) {
		$image = wp_get_attachment_image_src($id, '');
		$image_alt = get_the_title( $id, '' );
		$html .= '<div class="swiper-slide hov_zoom"><img src="'.esc_url($image[0]).'" alt="'.esc_attr($image_alt).'"><a href="'.esc_url($image[0]).'" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a></div>';
		}
		$html .= '</div>';
		$html .= '<div class="ss-slider-pagination"></div>
                  <div class="ss-slider-cont ss-slider-cont-prev"><i class="fas fa-caret-left"></i></div>
                  <div class="ss-slider-cont ss-slider-cont-next"><i class="fas fa-caret-right"></i></div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="images-collage-item col_par" style="width:120px" data-position-left="-23" data-position-top="-17" data-zindex="9" data-scrollax="properties: { translateY: '.$dot.'150px'.$dot.' }"><img src="'.RESTABOOK_THEME_URL.'/includes/images/cube.png" alt=""></div>';
		$html .= '</div>';
		
		return $html;
	}
	add_shortcode('restabook_image_slider', 'restabook_image_slider_shortcode');
}

?>