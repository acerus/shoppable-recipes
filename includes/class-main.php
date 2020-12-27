<?php
/**
 * @package whisk-recipe-widgets
 *
 * @link    https://help.mail.ru/feed/fulltext
 */

namespace Whisk\RecipeWidgets;

class Main {

	/**
	 * @var array список постов для вывода
	 */
	private $post_type;

	/**
	 * @var Settings
	 */
	private $settings;

	/**
	 * @var Notifications
	 */
	private $notifications;

	/**
	 * @var WP_OSA
	 */
	private $wposa_obj;

	/**
	 * @var Widget
	 */
	private $widget;

	/**
	 * @var array $defaults Default settings.
	 */
	private $defaults = [
		'shopping-list' => [
			'insert_way'           => 'shortcode',
			'format'               => 'compact',
			'button-bg'            => '#15D18F',
			'button-border-radius' => 4,
			'button-text-color'    => '#FFFFFF',
			'button-text'          => 'Get ingredients',
			'link-text-color'      => '#FFFFFF',
		],
	];

	/**
	 * @var string $version Plugin version.
	 */
	private $version;

	/**
	 * @var string $slug Plugin slug.
	 */
	private $slug;

	/**
	 * Main constructor.
	 */
	public function __construct() {
		$this->setup();
		$this->hooks();
	}

	/**
	 * Setup.
	 */
	private function setup() {
		$this->wposa_obj = new WP_OSA();
		$this->settings  = new Settings($this->wposa_obj);
		$this->widget    = new Widget($this->wposa_obj);
	}

	/**
	 * Setup hooks.
	 */
	private function hooks() {
		add_filter('plugin_action_links', [$this, 'add_settings_link'], 10, 2);
		add_action('upgrader_process_complete', [$this, 'upgrade'], 10, 2);
		add_filter('admin_footer_text', [$this, 'admin_footer_text']);

		register_activation_hook(WHISK_WIDGETS_FILE, [$this, 'on_activate']);
	}

	/**
	 * Add a post thumbnail to beginning of the feed item.
	 *
	 * @param string $content Item content.
	 * @param int    $post_id Post ID.
	 *
	 * @return string
	 */
	public function add_thumbnail_to_item_content($content, $post_id) {
		if (
			'on' === $this->wposa_obj->get_option('fulltext', 'feed') &&
			'on' === $this->wposa_obj->get_option('post_thumbnail', 'feed') &&
			has_post_thumbnail($post_id)
		) {
			$content = '<figure>' . get_the_post_thumbnail($post_id, 'full') . '</figure>' . $content;
		}

		return $content;
	}

	/**
	 * Add admin footer text.
	 *
	 * @param string $text Default text.
	 *
	 * @return string
	 */
	public function admin_footer_text($text) {

		$current_screen = get_current_screen();

		$white_list = [
			'settings_page_WHISK_WIDGETS',
		];

		if (isset($current_screen) && in_array($current_screen->id, $white_list)) {
			$text = '<span class="mytf-admin-footer-text">';
			$text .= sprintf(__('Enjoyed <strong>Whisk Recipe Widgets</strong>? Please leave us a <a href="%s" target="_blank" title="Rate & review it">★★★★★</a> rating. We really appreciate your support', 'mihdan-yandex-turbo-feed'), 'https://wordpress.org/support/plugin/whisk-recipe-widgets/reviews/#new-post');
			$text .= '</span>';
		}

		return $text;
	}

	/**
	 * Set plugin version.
	 *
	 * @param \WP_Upgrader $upgrader WP_Upgrader instance.
	 * @param array        $options  Array of bulk item update data.
	 */
	public function upgrade(\WP_Upgrader $upgrader, $options) {
		$our_plugin = plugin_basename(WHISK_WIDGETS_FILE);

		if ('update' === $options['action'] && 'plugin' === $options['type'] && isset($options['plugins'])) {
			foreach ($options['plugins'] as $plugin) {
				if ($plugin === $our_plugin) {
					update_option($this->slug . '_version', $this->version, false);
				}
			}
		}
	}


	/**
	 * Add plugin action links
	 *
	 * @param array  $actions
	 * @param string $plugin_file
	 *
	 * @return array
	 */
	public function add_settings_link($actions, $plugin_file) {
		if ('whisk-recipe-widgets/whisk-recipe-widgets.php' === $plugin_file) {
			$actions[] = sprintf(
				'<a href="%s">%s</a>',
				admin_url('options-general.php?page=WHISK_WIDGETS'),
				esc_html__('Settings', 'whisk-recipe-widgets')
			);
			$actions[] = sprintf(
				'<a href="%s" target="_blank">%s</a>',
				esc_url('https://www.kobzarev.com/donate/'),
				esc_html__('Donate', 'whisk-recipe-widgets')
			);
		}

		return $actions;
	}

	public function on_activate() {

		// Смотрим, есть ли настройки в базе данных,
		// если нет - создадим дефолтные.
		$settings = $this->wposa_obj->get_option('charset', 'feed');

		if ( ! $settings) {
			foreach ($this->defaults as $section => $defaults) {
				update_option($section, $defaults, false);
			}
		}

		// Set plugin version.
		update_option($this->slug . '_version', $this->version, false);
	}

}

// eof;
