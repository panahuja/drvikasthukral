/**

 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.

 * For licensing, see LICENSE.html or http://ckeditor.com/license

 */



CKEDITOR.editorConfig = function( config ) {

    config.filebrowserImageBrowseUrl = 'assets/ckeditor/ckfinder/ckfinder.html?type=Files';

	CKEDITOR.config.allowedContent = true; 

	config.allowedContent = true;

	config.ignoreEmptyParagraph = false;

	config.extraAllowedContent = 'table[class]';

	CKEDITOR.dtd.$removeEmpty.span = 0;   

   };



