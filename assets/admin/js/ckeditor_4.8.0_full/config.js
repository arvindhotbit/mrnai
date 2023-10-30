/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'symbol';
	config.extraPlugins = 'pastefromword';
	config.specialChars = config.specialChars.concat('&#8377;');
	config.specialChars = config.specialChars.concat('&#x20b9;');
	config.specialChars = config.specialChars.concat('₹');
	config.font_names = 'Kruti/Kruti;' + config.font_names;
	config.font_names = 'DevLys/DevLys;' + config.font_names;
	config.font_names = 'Mfdev/Mfdev;' + config.font_names;
	config.font_names = 'Hindi/S23350F0;' + config.font_names;
	// config.allowedContent = true;
	// config.fullPage = true;
};
