<?php
/**
 * @package shoppable-recipes
 * @link https://help.mail.ru/feed/rss
 */
namespace PaulFedorov\RecipeWidgets;

class Settings {
	/**
	 * @var WP_OSA
	 */
	private $wposa_obj;

	/**
	 * @var array $post_types
	 */
	private $post_types;

	/**
	 * @var array $taxonomies
	 */
	private $taxonomies;

	/**
	 * Settings constructor.
	 *
	 * @param WP_OSA $wposa_obj
	 */
	public function __construct( $wposa_obj ) {

		$this->wposa_obj = $wposa_obj;
		$this->hooks();
	}

	public function setup() {
		// Список всех публичных CPT.
		$args = array(
			'public' => true,
		);

		$this->post_types = wp_list_pluck( get_post_types( $args, 'objects' ), 'label', 'name' );

		// Список всех зареганных таксономий.
		$args = array(
			'public' => true,
		);

		$this->taxonomies = wp_list_pluck( get_taxonomies( $args, 'objects' ), 'label', 'name' );
	}

	/**
	 * Hooks init.
	 */
	public function hooks() {
		add_action( 'init', [ $this, 'setup' ], 100 );
		add_action( 'init', [ $this, 'fields' ], 111 );
	}

	public function fields() {

		$this->wposa_obj->add_section(
			array(
				'id'    => 'shopping-list',
				'title' => __( 'Shopping List', 'shoppable-recipes' ),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'   => 'insert_way',
				'type' => 'radio',
				'name' => __( 'How to insert widget', 'shoppable-recipes' ),
				'options' => array(
					'posts' => __( 'Automatically, below posts content', 'shoppable-recipes' ),
					'shortcode' => __( 'Manually, using shortcode', 'shoppable-recipes' ),
				),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'   => 'shortcode',
				'type' => 'html',
				'name' => __( 'Widget shortcode', 'shoppable-recipes' ),
				'desc' => __( 'If choose manual insertion, use shortcode <code>[wx-shopping-list]</code>', 'shoppable-recipes' ),)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'      => 'format',
				'type'    => 'radio',
				'name'    => __( 'Widget format', 'shoppable-recipes' ),
				'options' => array (
					'compact' => __('Compact', 'shoppable-recipes'),
					'large'   => __('Large', 'shoppable-recipes'),
				),
				'default' => 'compact',
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'          => 'button-bg',
				'type'        => 'color',
				'name'        => __( 'Button color', 'shoppable-recipes' ),
				'desc'        => __( 'Color description', 'shoppable-recipes' ),
				'placeholder' => __( '#15D18F', 'shoppable-recipes' ),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'          => 'button-border-radius',
				'type'        => 'number',
				'name'        => __( 'Button border radius', 'shoppable-recipes' ),
				'desc'        => __( 'in pixels', 'shoppable-recipes' ),
				'placeholder' => __( '4', 'shoppable-recipes' ),
			)
		);



		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'          => 'button-text-color',
				'type'        => 'color',
				'name'        => __( 'Button text color', 'shoppable-recipes' ),
				'desc'        => __( 'Color description', 'shoppable-recipes' ),
				'placeholder' => __( '#FFFFFF', 'shoppable-recipes' ),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'          => 'button-text',
				'type'        => 'text',
				'name'        => __( 'Button text', 'shoppable-recipes' ),
				'desc'        => __( 'Color description', 'shoppable-recipes' ),
				'placeholder' => __( 'Get ingredients', 'shoppable-recipes' ),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'          => 'link-text-color',
				'type'        => 'color',
				'name'        => __( 'Link text color', 'shoppable-recipes' ),
				'desc'        => __( 'Color description', 'shoppable-recipes' ),
				'placeholder' => __( '#FFFFFF', 'shoppable-recipes' ),
			)
		);

		$this->wposa_obj->add_section(
			array(
				'id'    => 'support',
				'title' => __( 'Support', 'shoppable-recipes' ),
			)
		);

		$this->wposa_obj->add_field(
			'support',
			array(
				'id'   => 'help',
				'type' => 'html',
				'name' => __( 'Need help?', 'shoppable-recipes' ),
				'desc' => __( 'You can contact me via <a href="https://t.me/PaulFedorov" target="_blank">Telegram</a> or <a href="mailto:paul.fedorov@gmail.com" target="_blank">e-mail</a>.', 'shoppable-recipes' ),
			)
		);

		//$this->wposa_obj->add_field(
		//	'support',
		//	array(
		//		'id'   => 'mark',
		//		'type' => 'html',
		//		'name' => __( 'Оценка', 'shoppable-recipes' ),
		//		'desc' => __( 'Хотите оценить плагин ★★★★★?<br />Сделать это можно на <a href="https://wordpress.org/support/plugin/shoppable-recipes/reviews/?rate=5#new-post" target="_blank">официальном странице</a> плагина.', 'shoppable-recipes' ),
		//	)
		//);
	}
}

// eol.
