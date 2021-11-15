/**
 * Hide fields based in widget format
 *
 * @package shoppable-recipes
 */
(function ($) {
	'use strict';

	$(document).ready(function () {

		var formatSelector = $('#save-recipe [type=radio]');
		var selectedFormat = $('#save-recipe [type=radio][name="save-recipe[format]"]:checked');
		var row = $('#save-recipe .form-table tr');
		var linkColor = row.eq(4);
		var hideAddToCart = row.eq(5);

		if (selectedFormat.val() === 'compact') {
			linkColor.hide();
			hideAddToCart.hide();
		}

		formatSelector.change(function () {

			if ($(this).val() === 'large') {
				linkColor.show();
				hideAddToCart.show();
			} else {
				linkColor.hide();
				hideAddToCart.hide();
			}
		});
	});

})(jQuery);
