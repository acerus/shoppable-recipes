<?php
namespace Whisk\RecipeWidgets;
use WPTRT\AdminNotices\Notices;

class Notifications {
	const URL = 'https://wordpress.org/support/plugin/whisk-recipe-widgets/reviews/?rate=5#new-post';

	/**
	 * @var Notices
	 */
	private $notices;

	/**
	 * @var string $slug Plugni slug.
	 */
	private $slug;

	/**
	 * Notifications constructor.
	 *
	 * @param string $slug
	 */
	public function __construct( $slug = '' ) {
		$this->slug    = $slug;
		$this->notices = new Notices();

		$template  = '<p>';
		$template .= __( 'Hello!', 'whisk-recipe-widgets' );
		$template .= '<br />';
		/* translators: ссылка на голосование */
		$template .= sprintf( __( 'We are very pleased that you by now have been using the <strong>Whisk Recipe Widgets</strong> plugin a few days. Please <a href="%s" target="_blank">rate ★★★★★ plugin</a>. It will help us a lot.', 'whisk-recipe-widgets' ), self::URL );
		$template .= '</p>';

		$this->notices->add(
			'review_dismissed',
			false,
			$template,
			[
				'scope'         => 'user',
				'option_prefix' => $this->slug,
			]
		);

		$this->notices->boot();
	}
}
