<?php
/*-----------------------------------------------------------------------------------*/
/* TImeline Awesome Post Type
/*-----------------------------------------------------------------------------------*/


add_action('init', 'tab_awesome_register');

function tab_awesome_register() {

	$labels = array(
		'name'                => esc_html_x( 'Tabs', 'Post Type General Name', 'tab-awesome' ),
		'singular_name'       => esc_html_x( 'Tabs', 'Post Type Singular Name', 'tab-awesome' ),
		'menu_name'           => esc_html__( 'Tabs', 'tab-awesome' ),
		'parent_item_colon'   => esc_html__( 'Parent Tabs:', 'tab-awesome' ),
		'all_items'           => esc_html__( 'All Tabs', 'tab-awesome' ),
		'view_item'           => esc_html__( 'View Tabs', 'tab-awesome' ),
		'add_new_item'        => esc_html__( 'Add New Tabs', 'tab-awesome' ),
		'add_new'             => esc_html__( 'Add New', 'tab-awesome' ),
		'edit_item'           => esc_html__( 'Edit Tabs', 'tab-awesome' ),
		'update_item'         => esc_html__( 'Update Tabs', 'tab-awesome' ),
		'search_items'        => esc_html__( 'Search Tabs', 'tab-awesome' ),
		'not_found'           => esc_html__( 'Not found', 'tab-awesome' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'tab-awesome' ),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => 'tabs',
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'rewrite'            => array( 'slug' => 'tabs' ),
		'supports'           => array('title'),
		'menu_position'       => 7,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'menu_icon'           => 'dashicons-marker',


	);
	register_post_type( 'tab-awesome', $args );

}


require dirname( __FILE__ ) .'/includes/hover-collections.php';

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'carbon_fields_register_fields', 'tab_awesome_field_in_post' );
function tab_awesome_field_in_post() {

	require dirname( __FILE__ ) .'/tab-awesome-ctrl.php';

	Container::make( 'post_meta', 'tab_repeater_cont', esc_html('Tab Awesome') )
	->where( 'post_type', '=', 'tab-awesome' )
	->set_priority( 'high' )
	->add_tab(  __( 'Layout' ), array(
		Field::make( 'select', 'tab_style_choice', esc_html__( 'Select Style', 'tab-awesome' ) )
		->add_options( array(
			'tab-style-4' => 'Unique Opat',
			'tab-style-11' => 'Unique Sabelas',
		) ),
		Field::make( 'select', 'tab_content_animated', esc_html__( 'Select Animated', 'tab-awesome' ) )
		->add_options( array(
			'fadeIn' => 'Fade in',
			'fadeInDown' => 'Fade in Down',
			'fadeInDownBig' => 'Fade in Big',
			'fadeInLeft' => 'Fade in Left',
			'fadeInLeftBig' => 'Fade in Left Big',
			'fadeInRight' => 'Fade in Right',
			'fadeInRightBig' => 'Fade in Right Big',
			'fadeInUp' => 'Fade in Up',
			'fadeInUpBig' => 'Fade in Up Big',
			'fadeInTopLeft' => 'Fade in Top Left',
			'fadeInTopRight' => 'Fade in Top Right',
			'fadeInBottomLeft' => 'Fade in Bottom Left',
			'fadeInBottomRight' => 'Fade in Bottom Right',
			'bounce' => 'Bounce',
			'flash' => 'Flash',
			'pulse' => 'Pulse',
			'rubberBand' => 'Rubberband',
			'shakeX' => 'Shake X',
			'shakeY' => 'Shake Y',
			'headShake' => 'Head Shake',
			'swing' => 'Swing',
			'tada' => 'Tada',
			'wobble' => 'Wobble',
			'jello' => 'Jello',
			'heartBeat' => 'Hearbeat',
			'backInDown' => 'Back in Down',
			'backInLeft' => 'Back in Left',
			'backInRight' => 'Back in Right',
			'backInUp' => 'Back in Up',
			'backOutUp' => 'Back out Up',
			'bounceIn' => 'Bounce in',
			'bounceInDown' => 'Bounce in Down',
			'bounceInLeft' => 'Bounce in Left',
			'bounceInRight' => 'Bounce in Right',
			'bounceInUp' => 'Bounce in Up',
			'flip' => 'Flip',
			'flipInX' => 'Flip in X',
			'flipInY' => 'Flip in Y',
			'flipOutX' => 'Flip out X',
			'flipOutY' => 'Flip out Y',
			'lightSpeedInRight' => 'Light Speed in Right',
			'lightSpeedInLeft' => 'Light Speed in Left',
			'lightSpeedOutRight' => 'Light Speed out Right',
			'lightSpeedOutLeft' => 'Light Speed out Left',
			'rotateIn' => 'Rotate in',
			'rotateInDownLeft' => 'Rotate in Down Left',
			'rotateInDownRight' => 'Rotate in Down Right',
			'rotateInUpLeft' => 'Rotate in Up Left',
			'rotateInUpRight' => 'Rotate in Up Right',
			'hinge' => 'Hinge',
			'jackInTheBox' => 'Jack in The Box',
			'rollIn' => 'Roll in',
			'rollOut' => 'Roll out',
			'zoomIn' => 'Zoom in',
			'zoomInDown' => 'Zoom in Down',
			'zoomInLeft' => 'Zoom in Left',
			'zoomInRight' => 'Zoom in Right',
			'zoomInUp' => 'Zoom in Up',
			'slideInDown' => 'Slide in Down',
			'slideInLeft' => 'Slide in Left',
			'slideInRight' => 'Slide in Right',
			'slideInUp' => 'Slide in Up',
		) ),
	))
	->add_tab(  esc_html__( 'Content', 'tab-awesome' ), array(

		Field::make( 'complex', 'tab_items', esc_html__( 'Tab Items', 'tab-awesome' ) )
		->set_layout( 'tabbed-horizontal' )
		->add_fields( array(
			Field::make( 'text', 'tab_item_name', esc_html__( 'Tab Name', 'tab-awesome' ) )
			->set_attribute( 'placeholder', 'About' )
			->set_width( 15 ),
			Field::make( 'rich_text', 'tab_item_desc', esc_html__( 'Tab Content', 'tab-awesome' ) )
			->set_attribute( 'placeholder', 'About' )
			->set_width( 80 ),
			Field::make( 'icon', 'tab_item_icon', esc_html__( 'Icon', 'tab-awesome' ) )
			->set_width( 40 )
			->set_conditional_logic( array(
				'relation' => 'OR',
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-15',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-14',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-13',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-12',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-9',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-7',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-6',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-5',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-3',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-2',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-style-1',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-vertical-style-1',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-vertical-style-2',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-vertical-style-3',
					'compare' => '=',
				),
				array(
					'field' => 'parent.tab_style_choice',
					'value' => 'tab-vertical-style-4',
					'compare' => '=',
				),
			) )
		) )
		->set_default_value( array(
			array(
			),
		) ),
	))
	->add_tab(  esc_html__( 'Customize', 'tab-awesome' ), array(
		// start for customize fields

		Field::make( 'html', 'upgrade_to_pro_tab' )
   		->set_html( '<p>In order to customize colors, let&#39;s upgrade to pro</p><a href="https://1.envato.market/QBG1A" target="_blank" class="btn-buy">Upgrade to Pro</a>' )
	));
	
	// For Gutenberg Blocks
	Block::make( esc_html( 'Tab Awesome' ) )
	->add_fields( array(
		Field::make( 'association', 'tab_gutenberg_block', esc_html__( 'Tab Awesome Post', 'tab-awesome' ) )
		->set_min( 1 )
		->set_max( 1 )
		->set_types( array(
			array(
				'type'      => 'post',
				'post_type' => 'tab-awesome',
			)
		) )
	) )
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
		require dirname( __FILE__ ) .'/gutenberg-blocks/tab-block.php';
	} );

}