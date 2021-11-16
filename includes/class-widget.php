<?php
/**
 * @package shoppable-recipes
 */
namespace PaulFedorov\RecipeWidgets;

class Widget {
	/**
	 * @var WP_OSA
	 */
	private $wposa_obj;

	/**
	 * @var string
	 */
	private $widget_id = 'whisk-widget';

	/**
	 * Widget constructor.
	 *
	 * @param WP_OSA $wposa_obj
	 */
	public function __construct($wposa_obj) {
		$this->wposa_obj = $wposa_obj;
		$this->setup_hooks();
	}

	public function setup_hooks() {
		add_shortcode('whisk-widget', [$this, 'shortcode']);
		add_filter('script_loader_tag', [$this, 'add_defer_attribute'], 10, 2);
		add_filter('script_loader_tag', [$this, 'add_async_attribute'], 10, 2);
	}

	/**
	 * Add shortcode `[whisk-widget]`.
	 *
	 * @return string
	 */
	public function shortcode() {

		return $this->widget();
	}

	/**
	 * Return widget HTML content.
	 *
	 * @return string
	 */
	public function widget() {

		wp_enqueue_script("whisk-widget-loader", SHOPPABLE_RECIPES_URL . "assets/loader.js", [], '', true);

		$format           = $this->wposa_obj->get_option('format', 'save-recipe');
		$btn_radius       = $this->wposa_obj->get_option('button-border-radius', 'save-recipe');
		$tracking_id      = $this->wposa_obj->get_option('tracking-id', 'save-recipe');
		$link_color       = $this->wposa_obj->get_option('link-color', 'save-recipe');
		$hide_add_to_cart = $this->wposa_obj->get_option('hide-cart', 'save-recipe');

		$custom_widget        = $this->wposa_obj->get_option('custom-widget', 'advanced');
		$custom_widget_toggle = $this->wposa_obj->get_option('toggle-custom-widget', 'advanced');

		$options = [
			'format'           => $format,
			'btn_radius'       => $btn_radius ?: 4,
			'tracking_id'      => $tracking_id,
			'link_color'       => $link_color,
			'hide_add_to_cart' => $hide_add_to_cart
		];


		ob_start(); ?>

		<script id="whisk-widget-init">

		var whisk = whisk || {};
		whisk.queue = whisk.queue || [];
		whisk.queue.push(function () {
			whisk.shoppingList.defineWidget("whisk-widget", {

				<?php if ($custom_widget && $custom_widget_toggle === 'on') : echo $custom_widget; else : ?>

				recipeUrl: 'http://demo.whisk.com/recipes/main-course/pizza-alla-napoletana/',
				trackingId: "<?php if ($options['tracking_id']) {
					echo $options['tracking_id'];
				} ?>",
				onlineCheckout: {
					enabled: <?php if ($options['hide_add_to_cart'] === "on") {
						echo 'false';
					} else {
						echo 'true';
					} ?> },
				styles: {
					type: "save-recipe",
					size: "<?php echo $options['format'] ?>",
					linkColor: "<?php echo $options['link_color'] ?>",
					button: {
						borderRadius: <?php echo $options['btn_radius'] ?>,
					}
				}

				<?php endif; ?>
			});
		});

		(function () {
			'use strict';

			let loadedWidget = false,
				timerId;

			window.addEventListener('scroll', loadWidget);
			window.addEventListener('touchstart', loadWidget);
			document.addEventListener('mouseenter', loadWidget);
			document.addEventListener('click', loadWidget);
			document.addEventListener('DOMContentLoaded', loadFallback);

			function loadFallback () {
				timerId = setTimeout(loadWidget, 5000);
			}

			function loadWidget (e) {

				if (loadedWidget) {
					return;
				}

				setTimeout(
					function () {

						const loader = new WhiskLoader();
						loader.load([
							'https://cdn.whisk.com/sdk/shopping-list.js'
						]).then(() => {
							console.log('Whisk widget loaded');
							whisk.queue.push(function () {
								whisk.display("<?php echo $this->widget_id ?>");
							});
						});

					},
					1000
				);

				loadedWidget = true;

				clearTimeout(timerId);

				window.removeEventListener('scroll', loadWidget);
				window.removeEventListener('touchstart', loadWidget);
				document.removeEventListener('mouseenter', loadWidget);
				document.removeEventListener('click', loadWidget);
				document.removeEventListener('DOMContentLoaded', loadFallback);
			}
		})();

		</script>

		<div style="min-height: 60px" id="<?php echo $this->widget_id ?>"></div>

		<?php return ob_get_clean();
	}

	// Add defer attributes
	// https://matthewhorne.me/defer-async-wordpress-scripts/

	public function add_defer_attribute($tag, $handle) {
		// add script handles to the array below
		$scripts_to_defer = ['whisk-widget-loader'];

		foreach ($scripts_to_defer as $defer_script) {
			if ($defer_script === $handle) {
				return str_replace(' src', ' defer="defer" src', $tag);
			}
		}

		return $tag;
	}

	// Add async attributes
	// https://matthewhorne.me/defer-async-wordpress-scripts/

	public function add_async_attribute($tag, $handle) {
		$scripts_to_async = ['whisk-widget-loader'];

		foreach ($scripts_to_async as $async_script) {
			if ($async_script === $handle) {
				return str_replace(' src', ' async="true" src', $tag);
			}
		}

		return $tag;
	}

}
