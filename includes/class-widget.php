<?php
/**
 * @package whisk-recipe-widgets
 */
namespace Whisk\RecipeWidgets;

class Widget {
	/**
	 * @var WP_OSA
	 */
	private $wposa_obj;

	/**
	 * Widget constructor.
	 *
	 * @param WP_OSA $wposa_obj
	 */
	public function __construct($wposa_obj) {
		$this->wposa_obj = $wposa_obj;

		$this->hooks();
	}

	public function hooks() {
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
		add_filter('the_content', [$this, 'append_widget_to_content']);
		add_action('woocommerce_after_single_product_summary', [$this, 'append_widget_to_woocommerce_product'], 30);
		add_shortcode('wx-sl-widget', [$this, 'shortcode']);
	}

	public function enqueue_scripts() {
		$format          = $this->wposa_obj->get_option('format', 'shopping-list');
		$btn_bg          = $this->wposa_obj->get_option('button-bg', 'shopping-list');
		$btn_radius      = $this->wposa_obj->get_option('button-border-radius', 'shopping-list');
		$btn_text_color  = $this->wposa_obj->get_option('button-text-color', 'shopping-list');
		$btn_text        = $this->wposa_obj->get_option('button-text', 'shopping-list');
		$link_text_color = $this->wposa_obj->get_option('link-text-color', 'shopping-list');
		$options         = [
			'format'          => $format,
			'btn_bg'          => $btn_bg,
			'btn_radius'      => $btn_radius,
			'btn_text_color'  => $btn_text_color,
			'btn_text'        => $btn_text,
			'link_text_color' => $link_text_color
		];

		wp_enqueue_script("whisk-sl", "https://cdn.whisk.com/sdk/shopping-list.js", [], '', false);
		var_dump($options);

		if ($options) {

		}

		wp_add_inline_script('whisk-sl', 'var whisk = whisk || {}; whisk.queue = whisk.queue || [];
		whisk.queue.push(function () {
		whisk.shoppingList.defineWidget("MBAO-GAEI-PTUR-ORAJ", {
			styles: {
				size: "large",
				  linkColor: "#577B6F",
				  button: {
						color: "#6E9386",
					textColor: "#2E1D1D",
					borderRadius: 4
				  }
				}
			});
		});');


	}

	/**
	 * Add shortcode `[wx-sl-widget]`.
	 *
	 * @return string
	 */
	public function shortcode() {
		return $this->html();
	}

	/**
	 * Append Pulse widget to post content.
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public function append_widget_to_content($content) {
		if (is_singular() && 'on' === $this->wposa_obj->get_option('auto_append', 'shopping-list')) {
			$content .= $this->html();
		}

		return $content;
	}

	/**
	 * Return widget HTML content.
	 *
	 * @return string
	 */
	public function html() {

		$html = '<div id="MBAO-GAEI-PTUR-ORAJ">';
		$html .= '<script>whisk.queue.push(function () { whisk.display("MBAO-GAEI-PTUR-ORAJ"); }); </script>';
		$html .= '</div>';

		return $html;
	}
}

// eol.
