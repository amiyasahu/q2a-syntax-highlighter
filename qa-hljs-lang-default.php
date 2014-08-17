<?php


if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}

return array(
	/*languages for admin panel*/
	'hljs_enable'            => 'Enable the Syntax Highlighter' ,
	'select_a_theme'         => 'Select a highlighter theme ' ,
	'use_minified_css'       => 'Use minified css ' ,
	'advanced_selector'      => 'Advanced JQuery selectors -- eg: $(\'selector\') -- (give only the selector string )' ,
	'advanced_selector_note' => '<b>**NOTE::</b>This will be used if you are using a different selector element to place your code (only for advanced users other wise leave it empty)' ,
);

/*
	Omit PHP closing tag to help avoid accidental output
*/