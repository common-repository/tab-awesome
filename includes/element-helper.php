<?php
namespace Elementor;

function tab_awesome_general_elementor_init(){
	Plugin::instance()->elements_manager->add_category(
		'tab_awesome-general-category',
		[
			'title'  => 'Tab Awesome',
			'icon' => 'font'
		],
		1
	);
}
add_action('elementor/init','Elementor\tab_awesome_general_elementor_init');
