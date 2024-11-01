<?php

	$args = array (
		'p'              => $tab_awesome_select_tab,     // GET POST BY SLUG  // IGNORE IF YOU ARE GETTING ERROR ON THIS LINE IN YOUR EDITOR
		'post_type'         => 'tab-awesome', // YOUR POST TYPE

	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() && $tab_awesome_select_tab != '' ) {

		wp_enqueue_style( 'ta-tab-awesome-fontawesome', plugin_dir_url('README.txt') . TAB_AWESOME_NAME . '/public/css/fontawesome.min.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-tab-awesome-thaw-flexgrid', plugin_dir_url('README.txt') . TAB_AWESOME_NAME . '/public/css/thaw-flexgrid.css', array(), '', 'all' );
		wp_enqueue_style( 'ta-tab-awesome', plugin_dir_url('README.txt') . TAB_AWESOME_NAME . '/public/css/tab-awesome-public.css', array(), '', 'all' );

		while ( $query->have_posts() ) {

			$query->the_post();

			$tab_style = carbon_get_post_meta( get_the_ID(), 'tab_style_choice' );

			if($tab_style == 'tab-style-4') {
				$tab_style_part = TAB_AWESOME_DIR .'/public/tab-styles/tab-style-4.php';
			}
			elseif($tab_style == 'tab-style-11') {
				$tab_style_part = TAB_AWESOME_DIR .'/public/tab-styles/tab-style-11.php';
			}
			
			include $tab_style_part;

		} wp_reset_postdata();
	} else {
		// no posts found
		return esc_html__( 'Sorry You have set no html for this slug...', 'tab-awesome' );

	}