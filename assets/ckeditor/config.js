/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.toolbar = [
		{ name: 'basicstyles', 	items: ['Bold','Italic','Underline','Strike','Subscript','Superscript'] },
		{ name: 'paragraph', 	items: ['NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
		{ name: 'clipboard', 	items: ['Cut','Copy','Paste','-','Undo','Redo'] },
		'/',
		{ name: 'styles',		items: [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors', 		items: [ 'TextColor','BGColor' ] },
		{ name: 'insert', 		items: ['Image','Table','HorizontalRule','PageBreak'] }
	];
};
