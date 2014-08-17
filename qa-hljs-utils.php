<?php

if (!function_exists('starts_with')) {
	function starts_with($haystack, $needle)
	{
	    return $needle === "" || strpos($haystack, $needle) === 0;
	}
}

if (!function_exists('ends_with')) {
	function ends_with($haystack, $needle)
	{
	    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}
}


/*
	Omit PHP closing tag to help avoid accidental output
*/