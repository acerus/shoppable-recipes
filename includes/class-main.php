<?php
/**
 * @package shoppable-recipes
 *
 */

namespace PaulFedorov\RecipeWidgets;

class Main {

	/**
	 * @var Settings
	 */
	private $settings;


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

		register_activation_hook(SHOPPABLE_RECIPES_FILE, [$this, 'on_activate']);
	}

	/**
	 * Set plugin version.
	 *
	 * @param \WP_Upgrader $upgrader WP_Upgrader instance.
	 * @param array        $options  Array of bulk item update data.
	 */
	public function upgrade(\WP_Upgrader $upgrader, $options) {
		$our_plugin = plugin_basename(SHOPPABLE_RECIPES_FILE);

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
		if ('shoppable-recipes/shoppable-recipes.php' === $plugin_file) {
			$actions[] = sprintf(
				'<a href="%s">%s</a>',
				admin_url('options-general.php?page=SHOPPABLE_RECIPES'),
				esc_html__('Settings', 'shoppable-recipes')
			);
		}

		return $actions;
	}

	public function on_activate() {

		$settings = $this->wposa_obj->get_option('button-bg', 'shopping-list');

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
