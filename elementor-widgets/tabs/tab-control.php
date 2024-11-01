<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class tab_awesome_post_block extends Widget_Base {

	public function get_name() {
		return 'tab_awesome-post-block';
	}

	public function get_title() {
		return esc_html__( 'Tabs', 'tab-awesome' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'tab_awesome-general-category' ];
	}

	protected function _register_controls() {
		/*-----------------------------------------------------------------------------------
			POST BLOCK INDEX
			1. POST SETTING
		-----------------------------------------------------------------------------------*/

		/*-----------------------------------------------------------------------------------*/
		/*  1. POST SETTING
		/*-----------------------------------------------------------------------------------*/
		$this->start_controls_section(
			'section_tab_awesome_post_block_post_setting',
			[
				'label' => esc_html__( 'Post Setting', 'tab-awesome' ),
			]
		);

		$this->add_control(
			'tab_awesome_select_tab',
			[
				'label' => esc_html__( 'Select Tab', 'tab-awesome' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => tab_awesome_select_tab_post(),
				'description' => esc_html__( 'Select post order by (default to latest post).', 'tab-awesome' ),
			]
		);

		$this->end_controls_section();
		/*-----------------------------------------------------------------------------------
			end of post block post setting
		-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
		'section_tab_awesome_block_setting',
			[
				'label' => esc_html__( 'Title', 'tab-awesome' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_tab_awesome_fff_setting',
			[
				'name' => 'fff_schemes_notice',
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( '<p>In order to customize fonts, let&#39;s upgrade to pro</p><br /><a href="https://1.envato.market/QBG1A" class="btn-buy" target="_blank">Upgrade to Pro</a>', 'tab-awesome' ), Settings::get_url() ),
				'content_classes' => 'fasgag',
				'render_type' => 'ui',
			]
		);

	}

	protected function render() {

		$instance = $this->get_settings();

		/*-----------------------------------------------------------------------------------*/
		/*  VARIABLES LIST
		/*-----------------------------------------------------------------------------------*/

		/* POST SETTING VARIBALES */
		$tab_awesome_select_tab = ! empty( $instance['tab_awesome_select_tab'] ) ? $instance['tab_awesome_select_tab'] : '';


		/* end of variables list */


		/*-----------------------------------------------------------------------------------*/
		/*  THE CONDITIONAL AREA
		/*-----------------------------------------------------------------------------------*/

		include ( plugin_dir_path(__FILE__).'tpl/tab-block.php' );

		?>

		<?php

	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new tab_awesome_post_block() );