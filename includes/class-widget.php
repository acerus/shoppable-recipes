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
	 * @var string
	 */
	private $insertion;

	/**
	 * @var string
	 */
	private $widget_id = 'whisk-widget-id';

	/**
	 * Widget constructor.
	 *
	 * @param WP_OSA $wposa_obj
	 */
	public function __construct($wposa_obj) {
		$this->wposa_obj = $wposa_obj;
		$this->insertion = $wposa_obj->get_option('insert_way', 'shopping-list');

		$this->hooks();
	}

	public function hooks() {
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
		add_filter('the_content', [$this, 'append_widget_to_content']);
		add_action('woocommerce_after_single_product_summary', [$this, 'append_widget_to_woocommerce_product'], 30);
		add_shortcode('wx-shopping-list', [$this, 'shortcode']);
	}

	public function enqueue_scripts() {
		$format          = $this->wposa_obj->get_option('format', 'shopping-list');
		$btn_bg          = $this->wposa_obj->get_option('button-bg', 'shopping-list');
		$btn_radius      = $this->wposa_obj->get_option('button-border-radius', 'shopping-list');
		$btn_text_color  = $this->wposa_obj->get_option('button-text-color', 'shopping-list');
		$btn_text        = $this->wposa_obj->get_option('button-text', 'shopping-list');
		$link_text_color = $this->wposa_obj->get_option('link-text-color', 'shopping-list');
		$options         = [
			'format'     => $format,
			'btn_bg'     => $btn_bg,
			'btn_radius' => $btn_radius,
			'btn_color'  => $btn_text_color,
			'btn_text'   => $btn_text,
			'link_color' => $link_text_color
		];
		?>

		<script>

		<?php ob_start(); ?>

		var whisk = whisk || {};
		whisk.queue = whisk.queue || [];
		whisk.queue.push(function () {
			whisk.shoppingList.defineWidget("<?= $this->widget_id ?>", {
				styles: {
					size: "<?= $options['format'] ?>",
					linkColor: "<?= $options['link_color'] ?>",
					button: {
						color: "<?= $options['btn_bg'] ?>",
						textColor: "<?= $options['btn_color'] ?>",
						borderRadius: <?= $options['btn_radius'] ?>,
						text: "<?= $options['btn_text'] ?>"
					}
				}
			});
		});

		<?php $inline = ob_get_clean(); ?>

		</script>

		<?php
		// auto-insert script and inline widget into all posts, below content
		if ('posts' === $this->insertion && is_singular()) {
			wp_enqueue_script("whisk-sl", "https://cdn.whisk.com/sdk/shopping-list.js", [], '', false);
			wp_add_inline_script("whisk-sl", $inline);

		// auto-insert script for all posts and pages, insert widget shortcode manually
		} elseif ('shortcode' === $this->insertion && (is_singular() || is_page())) {
			wp_enqueue_script("whisk-sl", "https://cdn.whisk.com/sdk/shopping-list.js", [], '', false);
			wp_add_inline_script("whisk-sl", $inline);
		}

	}

	/**
	 * Add shortcode `[wx-sl-widget]`.
	 *
	 * @return string
	 */
	public function shortcode() {
		if ('shortcode' === $this->wposa_obj->get_option('insert_way', 'shopping-list')) {
			return $this->html();
		}

		return null;
	}

	/**
	 * Append Pulse widget to post content.
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public function append_widget_to_content($content) {
		if (is_singular() && 'posts' === $this->wposa_obj->get_option('insert_way', 'shopping-list')) {
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

		$html = '<div id="'. $this->widget_id .'">';
		$html .= '<script>whisk.queue.push(function () { whisk.display("'. $this->widget_id .'"); }); </script>';
		$html .= '</div>';

		return $html;
	}
}

// eol.
