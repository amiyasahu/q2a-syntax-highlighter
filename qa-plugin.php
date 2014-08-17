<?php

/*
        Plugin Name: Q2A Syntax Highlighter
        Plugin URI: https://github.com/amiyasahu/q2a-syntax-highlighter
        Plugin Update Check URI: https://raw.github.com/amiyasahu/q2a-syntax-highlighter/master/qa-plugin.php
        Plugin Description: Syntax Highlighter plugin for q2a , powered by Highlighter.js
        Plugin Version: 1.0
        Plugin Date: 2014-08-14
        Plugin Author: Amiya Sahu
        Plugin Author URI: http://amiyasahu.com
        Plugin License: GPLv2
        Plugin Minimum Question2Answer Version: 1.6
*/


        if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
        	header('Location: ../../');
        	exit;
        }

        if (!defined('AMI_HLJS_DIR')) {
                define('AMI_HLJS_DIR', dirname(__FILE__));
        }

        if (!defined('AMI_HLJS_DIR_NAME')) {
                define('AMI_HLJS_DIR_NAME', basename(dirname(__FILE__)));
        }

        if (!defined('AMI_HLJS_ASSETS')) {
                define('AMI_HLJS_ASSETS', (dirname(__FILE__)).'/assets');
        }

        require_once AMI_HLJS_DIR.'/qa-hljs-utils.php';
        require_once AMI_HLJS_DIR.'/qa-hljs-admin.php';

        qa_register_plugin_module('module', 'qa-hljs-admin.php', 'qa_hljs_admin', 'Syntax Highlighter Admin');
        qa_register_plugin_layer('qa-hljs-layer.php', 'Syntax Highlighter Layer');
        qa_register_plugin_phrases('qa-hljs-lang-*.php', 'ami_hljs');

/*
	Omit PHP closing tag to help avoid accidental output
*/
