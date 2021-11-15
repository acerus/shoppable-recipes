=== Whisk Recipe Widgets ===
Contributors: paulfedorov
Tags: whisk, shoppable recipes, widgets, ingredients, save to whisk
Requires at least: 4.0
Tested up to: 5.6
Requires PHP: 5.6.20
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Lightweight plugin that adds interactive Save to Whisk and Shopping List widgets for you recipes.

== Description ==
Let your visitors [Save your recipes](https://whisk.com/recipe-box-app/) to their Whisk accounts or create instant [Shopping Lists](https://whisk.com/grocery-list-app/) and go shopping for ingredients in seconds.
It is compatible with all popular recipe plugins with Schema.org or JSON-ld support for recipe cards. Shortcode [whisk-widget] is available to add Whisk Widgets anywhere.

Built on top of [Whisk Widget Builder](https://developers.whisk.com/tools/widget-builder), plugin utilizes Whisk SDK to scan for proper recipe microdata and send it to Whisk Platform in just one click.
Plugin is very light and has zero impact on SEO, doesn't affect PageSpeed at all. It loads all necessary scripts only after real user interaction, not slowing down your website loading speed.

There are some options, that helps you change:

- widget format (compact or large)
- button border radius
- tracking ID

Whisk Apps are available on [Google Play](https://getwhisk.com/download-android), [App Store](https://getwhisk.com/download-ios), [Galaxy Store](https://galaxy.store/whisk) or [Web](http://my.whisk.com/).


== Frequently Asked Questions ==
Is it free?
Yes, the plugin and Whisk widgets are totally free.

Does it load a lot of 3rd-party scripts?
No! We care about your website performance and initially preload a very tiny (1kb) loader script that passively detects user interaction and loads all the Whisk scripts after some action was performed by a real user.
This way there is no impact on Google PageSpeed metrics and SEO.

== Changelog ==
= v 1.1 (15.11.2021) =
* switched to save-recipe mode
* changed shortcode name from [wx-save-recipe] to [whisk-widget]
* introduced load-on-interaction for all whisk scripts. Widgets now have zero impact on PageSpeed performance.
* removed unsupported customization options (in sync with https://developers.whisk.com/tools/widget-builder)
* added tracking_id support
* added an option to hide Add to Cart button in a large widget
* minor plugin refactoring
= v 1.0.4 (18.01.2021) =
* improved description and assets
= v 1.0.3 (14.01.2021) =
* small bug fix in JS
= v 1.0.2 (14.01.2021) =
* add screenshots
= v 1.0.0 (14.01.2021) =
* First release
