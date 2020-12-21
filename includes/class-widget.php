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
	public function __construct( $wposa_obj ) {
		$this->wposa_obj = $wposa_obj;

		$this->setup();
		$this->hooks();
	}

	public function setup() {}

	public function hooks() {
		add_action( 'init', [ $this, 'enqueue_scripts' ] );
		add_action( 'wp_footer', [ $this, 'init_widget' ] );
		add_filter( 'the_content', [ $this, 'append_widget_to_content' ] );
		add_action( 'woocommerce_after_single_product_summary', [ $this, 'append_widget_to_woocommerce_product' ], 30 );
		add_shortcode( 'mihdan-mailru-pulse-widget', [ $this, 'shortcode' ] );
	}

	public function enqueue_scripts(){
		wp_enqueue_script( "whisk-sl", "https://cdn.whisk.com/sdk/shopping-list.js", [], '', false );
	}

	public function init_widget(){ ?>
		<script>
		var whisk = whisk || {};
		whisk.queue = whisk.queue || [];

		whisk.queue.push(function () {
			whisk.shoppingList.defineWidget("NVFU-JQJX-MXIR-EIQJ");
		});
		</script>
	<?php }

	/**
	 * Add shortcode `[mihdan-mailru-pulse-widget]`.
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
	public function append_widget_to_content( $content ) {
		if ( is_singular( $this->wposa_obj->get_option( 'post_types', 'feed' ) ) && 'on' === $this->wposa_obj->get_option( 'auto_append', 'widget' ) ) {
			$content .= $this->html();
		}

		return $content;
	}

	/**
	 * Append Pulse widget to WooCommerce product single page.
	 */
	public function append_widget_to_woocommerce_product() {
		if ( is_singular( 'product' ) && 'on' === $this->wposa_obj->get_option( 'auto_append', 'widget' ) ) {
			echo $this->html();
		}
	}

	/**
	 * Return widget HTML content.
	 *
	 * @return string
	 */
	public function html() {
		return sprintf(
			'<div class="pulse-widget" data-sid="%s"></div><script async src="https://static.pulse.mail.ru/pulse-widget.js"></script>',
			esc_attr( $this->wposa_obj->get_option( 'id', 'widget' ) )
		);
	}
}

// eol.
