/* global jQuery:false */
/* global SOLEIL_STORAGE:false */

(function() {
	"use strict";

	// Skin-specific scroll actions
	jQuery( document ).on(
		'action.scroll_soleil', function() {
			// Visible on scroll
			soleil_skin_isVisible("h1 i, h2 i, h3 i", "inited");
			soleil_skin_isVisible(".sc_layouts_title_caption i", "inited");
		}
	);

	// Make sure the picture is visible
	function soleil_skin_isVisible(item, className, type = '') {
		var animationElements = jQuery.find(item),
			webWindow = soleil_skin_windowVarsFunction();
		jQuery.each(animationElements, function() {		
			if ( jQuery(this).is(':hidden') ) return;		
			var element = jQuery(this),
				item = soleil_skin_itemVarsFunction(element);	
			if ( item.topPosition != 0 && item.bottomPosition != 0 && (item.bottomPosition >= webWindow.topPosition) && (item.topPosition <= webWindow.bottomPosition)) {
				setTimeout(function() {
					element.addClass(className);
				}, 500);
			} 
		});
	}

	// Browser window size
	function soleil_skin_windowVarsFunction() {
		var webWindow = jQuery( window );
		var windowVars = {
			height: webWindow.height(),
			topPosition: webWindow.scrollTop(),
			bottomPosition: webWindow.height() + webWindow.scrollTop()
		};
		return windowVars;
	}

	// Animated item size
	function soleil_skin_itemVarsFunction(item) {
		var itemVars = {
			height: item.outerHeight(),
			topPosition: item.offset().top,
			bottomPosition: item.offset().top + item.outerHeight()
		};
		return itemVars;
	}
})();