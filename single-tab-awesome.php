<?php get_header();

$template = get_template();

if ( have_posts() ):

wp_enqueue_style( 'ta-tab-awesome-fontawesome', plugin_dir_url(__FILE__ ) . 'public/css/fontawesome.min.css', array(), '', 'all' );
wp_enqueue_style( 'ta-tab-awesome-thaw-flexgrid', plugin_dir_url(__FILE__ ) . 'public/css/thaw-flexgrid.css', array(), '', 'all' );
wp_enqueue_style( 'ta-tab-awesome', plugin_dir_url(__FILE__ ) . 'public/css/tab-awesome-public.css', array(), '', 'all' );
wp_enqueue_style( 'ta-tab-awesome-animate', plugin_dir_url(__FILE__ ) . 'public/css/anime.min.css', array(), '', 'all' );

while ( have_posts() ) : the_post();

	$tab_style = carbon_get_post_meta( get_the_ID(), 'tab_style_choice' );

	if($tab_style == 'tab-style-4') {
		echo '<div class="tab-container">';
			include_once dirname( __FILE__ ) .'/public/tab-styles/tab-style-4.php';
		echo '</div>';
	}
	elseif($tab_style == 'tab-style-11') {
		echo '<div class="tab-container">';
			include_once dirname( __FILE__ ) .'/public/tab-styles/tab-style-11.php';
		echo '</div>';
	}

	$template = get_template();

endwhile; 
endif;
wp_reset_postdata();
get_footer(); ?>