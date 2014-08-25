<?php
	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}

	require_once QA_INCLUDE_DIR.'qa-theme-base.php';
	require_once QA_INCLUDE_DIR.'qa-app-blobs.php';
	require_once QA_INCLUDE_DIR.'qa-app-users.php';

	class qa_html_theme_layer extends qa_html_theme_base {
		
		function head_css() {
			qa_html_theme_base::head_css();
			if ($this->template == 'question' && qa_opt(qa_hljs_admin::PLUGIN_ENABLED)) {
				$selected_theme  = qa_opt(qa_hljs_admin::CODE_THEME);
		    	if (!$selected_theme ) {
		    		$selected_theme  = "github.css" ;
		    	}
		    	$suffix = "/" ;
		    	$minify_opt  = qa_opt(qa_hljs_admin::USE_MINIFIED_CSS);
		    	if (!!$minify_opt) {
		    		$suffix = ".min/" ;
		    	}
		    	$root_theme_url = qa_opt('site_url').'qa-plugin/'.AMI_HLJS_DIR_NAME.'/assets/styles'.$suffix ;
		    	$theme_url = $root_theme_url . $selected_theme ;
				$this->output('<link rel="stylesheet" href="'.$theme_url.'">');
				$this->output('<style>','.hljs {overflow-y: scroll;}','</style>');
			}
		}

		function head_script()
		{
			if ($this->template == 'question' && qa_opt(qa_hljs_admin::PLUGIN_ENABLED)) {
			    $js_url = qa_opt('site_url').'qa-plugin/'.AMI_HLJS_DIR_NAME.'/assets/highlight.pack.js' ;
				if (!isset($this->content['script']['hljs_script'])) {
					$this->content['script']['hljs_script'] = '<script src="'.$js_url.'" type="text/javascript"></script>' ;
				}
			}
			qa_html_theme_base::head_script();
		}
		function body_script()
		{
			qa_html_theme_base::body_script();
			if ($this->template == 'question' && qa_opt(qa_hljs_admin::PLUGIN_ENABLED)) {
				$this->output(
					'<script type="text/javascript">',
						'$(document).ready(function() {
										hljs.configure({tabReplace: \'    \'});
						  				//$(\'pre code\').each(function(i, e) {hljs.highlightBlock(e)});' 
				);
				$advanced_selector = qa_opt(qa_hljs_admin::ADVANCED_SELECTOR);
				if (!empty($advanced_selector)) {
						$this->output(
								  	'$(\''.$advanced_selector.'\').each(function(i, e) {hljs.highlightBlock(e)});'
						);
				}

				$this->output('});'); /*end of the document.ready function */
				$this->output('</script>');
			}
		}
	}
	/*
		Omit PHP closing tag to help avoid accidental output
	*/