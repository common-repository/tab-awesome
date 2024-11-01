<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themesawesome.com/
 * @since             1.0.0
 * @package           Tab_Awesome
 *
 * @wordpress-plugin
 * Plugin Name:       Tab Awesome
 * Plugin URI:        https://tab.themesawesome.com/
 * Description:       Tab Plugin For WordPress By Themes Awesome
 * Version:           1.0.1
 * Author:            Themes Awesome
 * Author URI:        https://themesawesome.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tab-awesome
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TAB_AWESOME_VERSION', '1.0.1' );

define( 'TAB_AWESOME', __FILE__ );

define( 'TAB_AWESOME_BASENAME', plugin_basename( TAB_AWESOME ) );

define( 'TAB_AWESOME_NAME', trim( dirname( TAB_AWESOME_BASENAME ), '/' ) );

define( 'TAB_AWESOME_DIR', untrailingslashit( dirname( TAB_AWESOME ) ) );

define('TAB_AWESOME_NAME', plugin_basename(dirname(__FILE__)));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tab-awesome-activator.php
 */
function activate_tab_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tab-awesome-activator.php';
	Tab_Awesome_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tab-awesome-deactivator.php
 */
function deactivate_tab_awesome() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tab-awesome-deactivator.php';
	Tab_Awesome_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tab_awesome' );
register_deactivation_hook( __FILE__, 'deactivate_tab_awesome' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tab-awesome.php';

require plugin_dir_path( __FILE__ ) . 'tab-awesome-post-type.php';

require_once plugin_dir_path( __FILE__ ).'includes/element-helper.php';
require_once plugin_dir_path( __FILE__ ).'includes/hover-collections.php';
require_once plugin_dir_path( __FILE__ ).'public/partials/get-views-part.php';

function tab_awesome_new_elements(){
	require_once plugin_dir_path( __FILE__ ).'elementor-widgets/tabs/tab-control.php';
}

add_action('elementor/widgets/widgets_registered','tab_awesome_new_elements');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tab_awesome() {

	$plugin = new Tab_Awesome();
	$plugin->run();

}
run_tab_awesome();

add_filter('manage_tab-awesome_posts_columns', function($columns) {
	return array_merge($columns, ['shortcode' => esc_html__('Shortcode', 'tab-awesome')]);
});
 
add_action('manage_tab-awesome_posts_custom_column', function($column_key, $post_id) {
	echo '<pre"><code>[tab_awesome id="'. esc_attr( $post_id ) .'"]</code></pre>';
}, 10, 2);

add_filter( 'single_template', 'tab_awesome_post_custom_template', 50, 1 );
function tab_awesome_post_custom_template( $template ) {

	if ( is_singular( 'tab-awesome' ) ) {
		$template = TAB_AWESOME_DIR . '/single-tab-awesome.php';
	}
	
	return $template;
}

add_action( 'after_setup_theme', 'tab_awesome_crb_load' );
function tab_awesome_crb_load() {
	require_once( 'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}
		
add_action( 'elementor/preview/enqueue_styles', function() {
	wp_enqueue_style( 'ta-tab-awesome-hovers', plugin_dir_url( __FILE__ ) . 'public/css/hovers.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-tab-awesome-fontawesome', plugin_dir_url( __FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-tab-awesome-thaw-flexgrid', plugin_dir_url( __FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
	wp_enqueue_style( 'ta-tab-awesome', plugin_dir_url( __FILE__ ) . 'public/css/tab-awesome-public.css', array(), '1.0.0', 'all' );
} );

/* Shortcode Function */
function tab_awesome( $atts ) {

	// Get Attributes
	extract( shortcode_atts(
			array(
				'id' => ''   // DEFAULT SLUG SET TO EMPTY
			), $atts )
	);

	// WP_Query arguments
	$args = array (
		'page_id'              =>  $id,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
		'post_type'         => 'tab-awesome', // YOUR POST TYPE

	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() && $id != '' ) {

		wp_enqueue_style( 'ta-tab-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-tab-awesome-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-tab-awesome', plugin_dir_url(__FILE__ ) . 'public/css/tab-awesome-public.css', array(), '1.0.0', 'all' );

		while ( $query->have_posts() ) {

		$query->the_post();

			$tab_style = carbon_get_post_meta( get_the_ID(), 'tab_style_choice' );

			if($tab_style == 'tab-style-4') {
				$tab_style_part = dirname( __FILE__ ) .'/public/tab-styles/tab-style-4.php';
			}
			elseif($tab_style == 'tab-style-11') {
				$tab_style_part = dirname( __FILE__ ) .'/public/tab-styles/tab-style-11.php';
			}

			ob_start();

			include $tab_style_part;
		}
	} else {
		// no posts found
		return esc_html__( 'Sorry You have set no html for this slug...', 'tab-awesome' );
	}

	// Restore original Post Data
	wp_reset_postdata();

	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'tab_awesome', 'tab_awesome' );

function tab_awesome_select_tab_post() {
	$tabs_array = array();

	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'tab-awesome',
	);

	$tabs = get_posts($args);

	foreach( $tabs as $post ) { setup_postdata( $post );
		$tabs_array[$post->ID] = $post->post_title;
	}

	return $tabs_array;

	wp_reset_postdata();
}


add_action('wp_head', 'tab_awesome_color_custom_styles', 100);
function tab_awesome_color_custom_styles()
{
	$tab_awesome_custom_args = array(
	'post_type'         => 'tab-awesome',
	'posts_per_page'    => -1,
	);
	$tab_awesome_custom = new WP_Query($tab_awesome_custom_args);
	if ($tab_awesome_custom->have_posts()) : ?>
   
   <style>
		<?php while($tab_awesome_custom->have_posts()) : $tab_awesome_custom->the_post();

		$tab_style_title_color = carbon_get_post_meta( get_the_ID(), 'tab_style_title_color' );
		$tab_title_active_color = carbon_get_post_meta( get_the_ID(), 'tab_title_active_color' );
		$tab_icon_color = carbon_get_post_meta( get_the_ID(), 'tab_icon_color' );
		$tab_active_icon_color = carbon_get_post_meta( get_the_ID(), 'tab_active_icon_color' );
		$tab_style_title_desc_color = carbon_get_post_meta( get_the_ID(), 'tab_style_title_desc_color' );
		$tab_bg_color = carbon_get_post_meta( get_the_ID(), 'tab_bg_color' );
		$tab_active_bg_color = carbon_get_post_meta( get_the_ID(), 'tab_active_bg_color' );
		$tab_content_bg_color = carbon_get_post_meta( get_the_ID(), 'tab_content_bg_color' );
		$tab_line_color = carbon_get_post_meta( get_the_ID(), 'tab_line_color' );
		
		?>

		<?php if(!empty($tab_style_title_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav ul li span.title-tab
			{
				color: <?php echo esc_html($tab_style_title_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_style_title_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav ul li a {
				color: <?php echo esc_html($tab_style_title_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_title_active_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav .tab-current span.title-tab {
				color: <?php echo esc_html($tab_title_active_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_icon_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs .social-item::before {
				color: <?php echo esc_html($tab_icon_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_active_icon_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs .tab-current .social-item::before {
				color: <?php echo esc_html($tab_active_icon_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_style_title_desc_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .content-wrap section .tab-content {
				color: <?php echo esc_html($tab_style_title_desc_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_bg_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav ul li a{
				background: <?php echo esc_html($tab_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_active_bg_color)) { ?>
			.tab-awesome.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav ul li.tab-current a, 
			.tab-awesome.tab-post-<?php echo esc_attr(get_the_ID()); ?> .style-sapuluh .bg-color-tab nav li.tab-current a span {
				background: <?php echo esc_html($tab_active_bg_color); ?>;
			}
		<?php } ?>
		
		<?php if(!empty($tab_active_bg_color)) { ?>
			.tab-awesome.tab-post-<?php echo esc_attr(get_the_ID()); ?> .style-sapuluh .tabs-style-shape nav li.tab-current a svg {
				fill: <?php echo esc_html($tab_active_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_bg_color)) { ?>
			.tab-awesome.tab-post-<?php echo esc_attr(get_the_ID()); ?> .style-sapuluh .tabs-style-shape nav li a svg {
				fill: <?php echo esc_html($tab_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_bg_color)) { ?>
			.tab-awesome.tab-post-<?php echo esc_attr(get_the_ID()); ?> .style-sapuluh .bg-color-tab nav li a span {
				background: <?php echo esc_html($tab_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_content_bg_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs .content-wrap {
				background: <?php echo esc_html($tab_content_bg_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_line_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav li.tab-current::after, .tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav li:before, .tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav ul li.tab-current a::after, .tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav.box li a::after {
				background: <?php echo esc_html($tab_line_color); ?>;
			}
		<?php } ?>

		<?php if(!empty($tab_line_color)) { ?>
			.tab-post-<?php echo esc_attr(get_the_ID()); ?> .tabs nav li.tab-current a.dalapan {
				box-shadow: inset 0 -2px <?php echo esc_html($tab_line_color); ?>;
			}
		<?php } ?>

		<?php endwhile; wp_reset_postdata(); ?>
	</style>

	<?php endif;
}