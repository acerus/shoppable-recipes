<?php
/**
 * @package shoppable-recipes
 * @link    https://help.mail.ru/feed/rss
 */
namespace PaulFedorov\RecipeWidgets;

class Settings {
	/**
	 * @var WP_OSA
	 */
	private $wposa_obj;

	/**
	 * Settings constructor.
	 *
	 * @param WP_OSA $wposa_obj
	 */
	public function __construct($wposa_obj) {

		$this->wposa_obj = $wposa_obj;
		$this->hooks();
	}

	/**
	 * Hooks init.
	 */
	public function hooks() {
		add_action('init', [$this, 'fields'], 111);
		add_action('admin_enqueue_scripts', [$this, 'settings_js_enqueue']);
	}

	public function settings_js_enqueue($hook_suffix) {
		wp_enqueue_script('whisk-settings', SHOPPABLE_RECIPES_URL . 'assets/options.js');

	}

	public function fields() {

		$this->wposa_obj->add_section(
			[
				'id'    => 'save-recipe',
				'title' => __('Save Recipe Button', 'shoppable-recipes'),
			]
		);

		$this->wposa_obj->add_field(
			'save-recipe',
			[
				'id'   => 'shortcode',
				'type' => 'html',
				'name' => __('Usage', 'shoppable-recipes'),
				'desc' => __('Use shortcode to insert Whisk widgets anywhere on a page:<br/>
							  <code>[whisk-widget]</code><br/><br/>
							  Alternatively, you can use this snippet in your theme or plugin templates: <br/>
							  <code>&lt;?php echo do_shortcode( "[whisk-widget]" ); ?&gt</code>', 'shoppable-recipes'),
			]
		);

		$this->wposa_obj->add_field(
			'save-recipe',
			[
				'id'      => 'format',
				'type'    => 'radio',
				'name'    => __('Widget format', 'shoppable-recipes'),
				'options' => [
					'compact' => __('Compact', 'shoppable-recipes'),
					'large'   => __('Large', 'shoppable-recipes'),
				],
				'default' => 'compact',
			]
		);

		$this->wposa_obj->add_field(
			'save-recipe',
			[
				'id'          => 'button-border-radius',
				'type'        => 'number',
				'name'        => __('Button border radius', 'shoppable-recipes'),
				'desc'        => __('in pixels', 'shoppable-recipes'),
				'placeholder' => __('4', 'shoppable-recipes'),
			]
		);

		$this->wposa_obj->add_field(
			'save-recipe',
			[
				'id'   => 'tracking-id',
				'type' => 'text',
				'name' => __('Tracking ID', 'shoppable-recipes'),
				'desc' => __('This is the unique identifier for business customers. <a target="_blank" href="https://whisk.com/business/">Contact</a> us to get one.', 'shoppable-recipes'),
			]
		);

		$this->wposa_obj->add_field(
			'save-recipe',
			[
				'id'          => 'link-color',
				'type'        => 'color',
				'name'        => __('Recipe Box Link color', 'shoppable-recipes'),
				'placeholder' => '#15D18F'
			]
		);

		$this->wposa_obj->add_field(
			'save-recipe',
			[
				'id'   => 'hide-cart',
				'type' => 'checkbox',
				'name' => __('Add to Cart', 'shoppable-recipes'),
				'desc' => __('Hide Add to Cart Button', 'shoppable-recipes')
			]
		);

		$this->wposa_obj->add_section(
			[
				'id'    => 'support',
				'title' => __('Support', 'shoppable-recipes'),
			]
		);

		$this->wposa_obj->add_field(
			'support',
			[
				'id'   => 'validator',
				'type' => 'html',
				'name' => __('Widget is not working?', 'shoppable-recipes'),
				'desc' => __('First of all, make sure your recipe has valid structured data for Widget to use.
							  Use <a target="_blank" href="https://developers.whisk.com/tools/recipe-content-validator">Whisk Recipe Validator</a>.
							  Most of the times there is a problem with a recipe structured data and there is not enough data for widgets to pick up.', 'shoppable-recipes'),
			]
		);

		$this->wposa_obj->add_field(
			'support',
			[
				'id'   => 'help',
				'type' => 'html',
				'name' => __('Need help?', 'shoppable-recipes'),
				'desc' => __('You can contact me via <a href="https://t.me/PaulFedorov" target="_blank">Telegram</a> or <a href="mailto:paul.fedorov@gmail.com" target="_blank">e-mail</a>.', 'shoppable-recipes'),
			]
		);
	}
}
