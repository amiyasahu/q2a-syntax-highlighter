<?php
	class qa_hljs_admin {

		const SAVE_BTN          = 'ami_hljs_save_button' ;
		const PLUGIN_ENABLED    = 'ami_hljs_enabled' ;
		const CODE_THEME        = 'ami_hljs_code_theme' ;
		const USE_MINIFIED_CSS  = 'ami_hljs_use_minified' ;
		const ADVANCED_SELECTOR = 'ami_hljs_adv_selector' ;

		function option_default($option) {
			switch ($option) {
				case self::PLUGIN_ENABLED:
				case self::USE_MINIFIED_CSS:
					return 1 ;
						break;
				case self::ADVANCED_SELECTOR:
					return '' ; /*an empty string initially*/
						break;

				case self::CODE_THEME:
					return 'github.css' ;
					break;
				default:
					return null ;
					break;
			}
		}

		function admin_form(&$qa_content)
		{

		//	Process form input

			$ok = null;
			if (qa_clicked(self::SAVE_BTN)) {
				qa_opt(self::PLUGIN_ENABLED ,    (bool)qa_post_text(self::PLUGIN_ENABLED));
				qa_opt(self::USE_MINIFIED_CSS ,  (bool)qa_post_text(self::USE_MINIFIED_CSS));
				qa_opt(self::CODE_THEME ,        qa_post_text(self::CODE_THEME));
				qa_opt(self::ADVANCED_SELECTOR , qa_post_text(self::ADVANCED_SELECTOR));
				$ok = qa_lang('admin/options_saved');
			}
		
			//	Create the form for display_header_text();

			$all_themes     = scandir( AMI_HLJS_ASSETS .'/styles/');
			$select_options = array() ;

	        foreach ($all_themes as $theme ) {
	        	if ($theme == "." || $theme == ".." || !ends_with($theme , ".css")) {
	        		continue; 
	        	}

	        	$theme_name = preg_replace("/\\.[^.\\s]{3}$/", "", $theme);    /*remove the css extension */
	        	$theme_name = preg_replace('/[^a-zA-Z0-9]+/', ' ', $theme_name) ; /*remove the special chars */
	        	$theme_name = ucwords( $theme_name );

	        	$select_options[$theme]= $theme_name ;
	        }
	        qa_set_display_rules($qa_content, array(
	            self::USE_MINIFIED_CSS     => self::PLUGIN_ENABLED ,
	            self::CODE_THEME     => self::PLUGIN_ENABLED ,
	            self::ADVANCED_SELECTOR     => self::PLUGIN_ENABLED ,
	            ));

			$fields = array();

			$fields[self::PLUGIN_ENABLED] = array(
				'label' => qa_lang('ami_hljs/hljs_enable'),
				'tags'  => 'NAME="'.self::PLUGIN_ENABLED.'" id="'.self::PLUGIN_ENABLED.'"',
				'value' => qa_opt(self::PLUGIN_ENABLED),
				'type'  => 'checkbox',
			);

			$fields[self::USE_MINIFIED_CSS] = array(
				'id'    => self::USE_MINIFIED_CSS ,
				'label' => qa_lang('ami_hljs/use_minified_css'),
				'tags'  => 'NAME="'.self::USE_MINIFIED_CSS.'" ',
				'value' => qa_opt(self::USE_MINIFIED_CSS),
				'type'  => 'checkbox',
			);

			$fields[self::CODE_THEME] = array(
				'id'    => self::CODE_THEME ,
				'label'   => qa_lang('ami_hljs/select_a_theme'),
				'tags'    => 'NAME="'.self::CODE_THEME.'" ',
				'value'   => ucwords(preg_replace('/[^a-zA-Z0-9]+/', ' ',(preg_replace("/\\.[^.\\s]{3}$/", "", qa_opt(self::CODE_THEME))))),
				'type'    => 'select',
				'options' => $select_options ,
			);

			$fields[self::ADVANCED_SELECTOR] = array(
				'id'    => self::ADVANCED_SELECTOR ,
				'label' => qa_lang('ami_hljs/advanced_selector'),
				'tags' => 'NAME="'.self::ADVANCED_SELECTOR.'" ',
				'value' => qa_opt(self::ADVANCED_SELECTOR),
				'type' => 'textarea',
				'rows' => '3',
				'note' => qa_lang('ami_hljs/advanced_selector_note'),
			);
			
			return array(
				'ok' => ($ok) ? $ok : null,
				
				'fields' => $fields,
				
				'buttons' => array(
					array(
					'label' => qa_lang_html('main/save_button'),
					'tags' => 'NAME="'.self::SAVE_BTN.'"',
					),
				),
			);
		}
	}

