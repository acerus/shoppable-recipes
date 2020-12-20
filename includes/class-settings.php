<?php
/**
 * @package whisk-recipe-widgets
 * @link https://help.mail.ru/feed/rss
 */
namespace Whisk\RecipeWidgets;

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
				'title' => __( 'Shopping List', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'      => 'format',
				'type'    => 'radio',
				'name'    => __( 'Widget format', 'whisk-recipe-widgets' ),
				'options' => array(
					'compact' => __( 'Compact', 'whisk-recipe-widgets' ),
					'large' => __( 'Large', 'whisk-recipe-widgets' ),
				),
				'default' => 'compact',
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'          => 'button-bg',
				'type'        => 'color',
				'name'        => __( 'Button color', 'whisk-recipe-widgets' ),
				'desc'        => __( 'Color description', 'whisk-recipe-widgets' ),
				'placeholder' => __( '#15D18F', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'          => 'button-text-color',
				'type'        => 'color',
				'name'        => __( 'Button text color', 'whisk-recipe-widgets' ),
				'desc'        => __( 'Color description', 'whisk-recipe-widgets' ),
				'placeholder' => __( '#FFFFFF', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'          => 'button-text',
				'type'        => 'text',
				'name'        => __( 'Button text', 'whisk-recipe-widgets' ),
				'desc'        => __( 'Color description', 'whisk-recipe-widgets' ),
				'placeholder' => __( 'Get ingredients', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'          => 'link-text-color',
				'type'        => 'color',
				'name'        => __( 'Link text color', 'whisk-recipe-widgets' ),
				'desc'        => __( 'Color description', 'whisk-recipe-widgets' ),
				'placeholder' => __( '#FFFFFF', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_field(
			'shopping-list',
			array(
				'id'   => 'auto_append',
				'type' => 'checkbox',
				'name' => __( 'Auto Append', 'whisk-recipe-widgets' ),
				'desc' => __( 'Автоматически добавлять виджет в конец записей', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_section(
			array(
				'id'    => 'contacts',
				'title' => __( 'Contacts', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_field(
			'contacts',
			array(
				'id'   => 'help',
				'type' => 'html',
				'name' => __( 'Помощь', 'whisk-recipe-widgets' ),
				'desc' => __( 'Нужна помощь?<br />По всем вопросам пишите в телеграм <a href="https://t.me/mihdan" target="_blank">@mihdan</a>.', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_field(
			'contacts',
			array(
				'id'   => 'donate',
				'type' => 'html',
				'name' => __( 'Благодарность', 'whisk-recipe-widgets' ),
				'desc' => __( 'Хотите отблагодарить автора?<br />Сделать это можно на <a href="https://www.kobzarev.com/donate/" target="_blank">официальном сайте</a>.', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_field(
			'contacts',
			array(
				'id'   => 'mark',
				'type' => 'html',
				'name' => __( 'Оценка', 'whisk-recipe-widgets' ),
				'desc' => __( 'Хотите оценить плагин ★★★★★?<br />Сделать это можно на <a href="https://wordpress.org/support/plugin/whisk-recipe-widgets/reviews/?rate=5#new-post" target="_blank">официальном странице</a> плагина.', 'whisk-recipe-widgets' ),
			)
		);

		$this->wposa_obj->add_field(
			'contacts',
			array(
				'id'   => 'plugins',
				'type' => 'html',
				'name' => __( 'Плагины автора', 'whisk-recipe-widgets' ),
				'desc' => __( 'Понравился плагин?<br />Остальные полезные плагины автора вы можете посмотреть в <a href="https://profiles.wordpress.org/mihdan/#content-plugins" target="_blank">официальном репозитории</a> wp.org.', 'whisk-recipe-widgets' ),
			)
		);
	}
}

// eol.
