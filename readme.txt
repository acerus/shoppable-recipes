=== Whisk Recipe Widgets ===
Contributors: paulfedorov
Tags: whisk, shoppable recipes, widgets, ingredients, save to whisk, shopping list, recipe widgets
Requires at least: 4.0
Tested up to: 5.6
Requires PHP: 5.6.20
Stable tag: 1.1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Lightweight plugin that adds interactive Save to Whisk & Shopping List widgets for you recipes.

== Description ==
Let your visitors [Save your recipes](https://whisk.com/recipe-box-app/) to their Whisk accounts or create instant [Shopping Lists](https://whisk.com/grocery-list-app/) and go shopping for ingredients in seconds.
It is compatible with all popular recipe plugins which support Schema.org or JSON-ld. Plugin is very light and has zero impact on Google PageSpeed metrics.

== Demo ==
[Demo recipe](https://demo.whisk.com/pizza-alla-napoletana/)

= How to use =
Activate the plugin and use this shortcode to display Whisk Widgets: `[whisk-widget]`.
Alternatively, you can add this PHP snippet to your theme's or plugin's template: ``` <?php echo do_shortcode( "[whisk-widget]" ) ?>`

= Plugin options =
There are some options, that helps you change:

- Widget format (Compact or Large).
- Button border radius
- Link color
- Add to Cart button visibility
- Tracking ID

Whisk Apps are available on [Google Play](https://getwhisk.com/download-android), [App Store](https://getwhisk.com/download-ios), [Galaxy Store](https://galaxy.store/whisk) or [Web](http://my.whisk.com/).
After you save a recipe via Whisk Widget it is instantly available in apps too. Very convenient for shopping, sharing with friends, creating recipe collections, etc.

== Frequently Asked Questions ==
= What is the difference between widget formats? =
<strong>Compact widget</strong> is simply a button that saves your recipe to Whisk, where you can check it's nutrition, share with friends,
post reviews, pictures and comments and do so much more, including adding all the recipes ingredients to a shopping list.

<strong>Large widget</strong> has 2 buttons: one for Saving Recipes. The other one is Add to Cart button that allows your visitors to buy all the
necessary ingredients from the nearest grocer with a single click. It is a very convenient feature, though mostly useful in US/UK.
Widget can auto-detect visitor's country and hide this button if there are no supported retailers in visitor's country.
You can also disable this button in plugin's settings.

= Where can I find full list of integrated retailers for Shopping List functionality? =
Check out official Whisk website [here](https://whisk.com/partners/?filter=retailers). They have Walmart and Tesco!

= How does it work? =
Built on top of [Whisk Widget Builder](https://developers.whisk.com/tools/widget-builder), this plugin utilizes Whisk SDK to scan for proper recipe microdata and send it to Whisk Platform in just one click.

= Does it load a lot of 3rd-party scripts? =
No! We care about your website performance and initially preload a very tiny (1kb) loader script that passively detects user interaction and loads all the Whisk scripts after some action was performed by a real user.
This way there is no impact on Google PageSpeed metrics and SEO.

= Is it free? =
Yes, the plugin, Whisk widgets and [Whisk Apps](https://whisk.com/download/) are totally free.

== Screenshots ==

1. Save Recipe button (compact widget)
2. Save Recipe & Add to Cart button (large widget)
3. Saved Recipes in Whisk App
4. Plugin settings
5. Shopping list widget
6. Publisher integration example

== Changelog ==
= v 1.1.3 (16.11.2021) =
* new feature: ability to use completely custom widget code. Might be useful for some publishers with specific needs.
= v 1.1.2 (16.11.2021) =
* a better readme :)
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
