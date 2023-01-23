<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2019 - 2022, CodeIgniter Foundation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @copyright	Copyright (c) 2019 - 2022, CodeIgniter Foundation (https://codeigniter.com/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter HTML Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/userguide3/helpers/html_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('heading'))
{
	/**
	 * Heading
	 *
	 * Generates an HTML heading tag.
	 *
	 * @param	string	content
	 * @param	int	heading level
	 * @param	string
	 * @return	string
	 */
	function heading($data = '', $h = '1', $attributes = '')
	{
		return '<h'.$h._stringify_attributes($attributes).'>'.$data.'</h'.$h.'>';
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('ul'))
{
	/**
	 * Unordered List
	 *
	 * Generates an HTML unordered list from an single or multi-dimensional array.
	 *
	 * @param	array
	 * @param	mixed
	 * @return	string
	 */
	function ul($list, $attributes = '')
	{
		return _list('ul', $list, $attributes);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('ol'))
{
	/**
	 * Ordered List
	 *
	 * Generates an HTML ordered list from an single or multi-dimensional array.
	 *
	 * @param	array
	 * @param	mixed
	 * @return	string
	 */
	function ol($list, $attributes = '')
	{
		return _list('ol', $list, $attributes);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('_list'))
{
	/**
	 * Generates the list
	 *
	 * Generates an HTML ordered list from an single or multi-dimensional array.
	 *
	 * @param	string
	 * @param	mixed
	 * @param	mixed
	 * @param	int
	 * @return	string
	 */
	function _list($type = 'ul', $list = array(), $attributes = '', $depth = 0)
	{
		// If an array wasn't submitted there's nothing to do...
		if ( ! is_array($list))
		{
			return $list;
		}

		// Set the indentation based on the depth
		$out = str_repeat(' ', $depth)
			// Write the opening list tag
			.'<'.$type._stringify_attributes($attributes).">\n";

		// Cycle through the list elements.  If an array is
		// encountered we will recursively call _list()

		static $_last_list_item = '';
		foreach ($list as $key => $val)
		{
			$_last_list_item = $key;

			$out .= str_repeat(' ', $depth + 2).'<li>';

			if ( ! is_array($val))
			{
				$out .= $val;
			}
			else
			{
				$out .= $_last_list_item."\n"._list($type, $val, '', $depth + 4).str_repeat(' ', $depth + 2);
			}

			$out .= "</li>\n";
		}

		// Set the indentation for the closing tag and apply it
		return $out.str_repeat(' ', $depth).'</'.$type.">\n";
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('img'))
{
	/**
	 * Image
	 *
	 * Generates an <img /> element
	 *
	 * @param	mixed
	 * @param	bool
	 * @param	mixed
	 * @return	string
	 */
	function img($src = '', $index_page = FALSE, $attributes = '')
	{
		if ( ! is_array($src) )
		{
			$src = array('src' => $src);
		}

		// If there is no alt attribute defined, set it to an empty string
		if ( ! isset($src['alt']))
		{
			$src['alt'] = '';
		}

		$img = '<img';

		foreach ($src as $k => $v)
		{
			if ($k === 'src' && ! preg_match('#^(data:[a-z,;])|(([a-z]+:)?(?<!data:)//)#i', $v))
			{
				if ($index_page === TRUE)
				{
					$img .= ' src="'.get_instance()->config->site_url($v).'"';
				}
				else
				{
					$img .= ' src="'.get_instance()->config->base_url($v).'"';
				}
			}
			else
			{
				$img .= ' '.$k.'="'.$v.'"';
			}
		}

		return $img._stringify_attributes($attributes).' />';
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('doctype'))
{
	/**
	 * Doctype
	 *
	 * Generates a page document type declaration
	 *
	 * Examples of valid options: html5, xhtml-11, xhtml-strict, xhtml-trans,
	 * xhtml-frame, html4-strict, html4-trans, and html4-frame.
	 * All values are saved in the doctypes config file.
	 *
	 * @param	string	type	The doctype to be generated
	 * @return	string
	 */
	function doctype($type = 'xhtml1-strict')
	{
		static $doctypes;

		if ( ! is_array($doctypes))
		{
			if (file_exists(APPPATH.'config/doctypes.php'))
			{
				include(APPPATH.'config/doctypes.php');
			}

			if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/doctypes.php'))
			{
				include(APPPATH.'config/'.ENVIRONMENT.'/doctypes.php');
			}

			if (empty($_doctypes) OR ! is_array($_doctypes))
			{
				$doctypes = array();
				return FALSE;
			}

			$doctypes = $_doctypes;
		}

		return isset($doctypes[$type]) ? $doctypes[$type] : FALSE;
	}
}

// ------------------------------------------------------------------------

if (! function_exists('script_js')) {
	/**
	 * Script
	 *
	 * Generates tags of javascript embebed codes
	 *
	 * @param array|string $src       Script source or an array of scrits sources
	 * @param array|string $attributes    Sabtibutes or array of atributes taht will be put in all the tags
	 * @param bool $xhtml  will be XHTML or just simple HTML one to put CDATA inside
	 */
	function script_js($src = '', $attributes = '', $xhtml = FALSE)
	{
		$script   = '';
		$satribs  = '';
		$isjs = FALSE;
		$open_only = FALSE;

		if ( ! is_array($src)) {
			if ( trim($src) == '' OR $src == NULL ) {
				$open_only = TRUE;
			}
			$attributes['src'] = $src;
		}

		if ( ! is_array($src) AND ! is_array($attributes)) {
			$isjs = strripos($attributes,'type');
			$attributes['attributes'] = $attributes;
		}
		else {
			if ( is_array($src) AND ! is_array($attributes)) {
				foreach ($src as $k => $v) {
					if ( strripos($k,'type') === TRUE AND strripos($v,'javascript') === TRUE ) {
						$isjs = TRUE;
					}
					$satribs .= $k . (null === $v ? ' ' : '="' . $v . '" ');
				}
			}
			else {
				foreach ($attributes as $k => $v) {
					if ( strripos($k,'type') === TRUE AND strripos($v,'javascript') === TRUE ) {
						$isjs = TRUE;
					}
					$satribs .= $k . (null === $v ? ' ' : '="' . $v . '" ');
				}
			}
		}

		if ( $isjs === FALSE ) {
			$satribs .= ' type="text/javascript"';
		}

		foreach ($src as $k => $v) {
			$script .= '<script ' . $satribs . '>' . PHP_EOL;
			if ( $xhtml ) $script .= '//<![CDATA[' . PHP_EOL;
			$script .= $v . PHP_EOL;
			if ( $xhtml ) $script .= '//]]>' . PHP_EOL;
			if ( $open_only ) $script .= '</script>' . PHP_EOL;
		}

		return $script;
	}
}

// ------------------------------------------------------------------------

if (! function_exists('script_tag')) {
	/**
	 * Script
	 *
	 * Generates link to a JS file
	 *
	 * @param array|string $src       Script source or an array of attributes
	 * @param bool         $indexPage Should indexPage be added to the JS path
	 */
	function script_tag($src = NULL, $indexPage = false)
	{
		if( $src === NULL ) $src = '';
		
		$open_only = FALSE;
		$contenido = '';

		$script   = '<script ';
		if (! is_array($src)) {
			if ($indexPage == TRUE AND trim($src) != '') {
				$src = site_url();
			}
			if ( trim($src) == '' OR $content == NULL) {
				$open_only = TRUE;
			}
			if ( strpos($src, 'src') !== FALSE ) {
				$src = array('src' => $src);
			}
		}
		foreach ($src as $k => $v) {
			if ($k === 'src' AND $indexPage === true) {
				$src[$k] = site_url($v);
			}
			if ( ! array_key_exists('type', $src) ) {
				$src['type'] = 'text/javascript';
			}
			if ( $k === 'content' ) {
				$contenido = $v;
				continue;
			}
			$script .= $k . (null === $v ? ' ' : '="' . $v . '" ');
		}

		$script .= '>';

 		if ( $open_only !== TRUE ) {
			$script .= $contenido;
			$script .= '</script>';
		}
		
		return $script;
   }
}

// ---------------------------------------------------------------------

if ( ! function_exists('script_close'))
{
	/*
	 * script tag helper for close tag
	 * @name: script_close
	 * @return String
	 */
	function script_close()
	{
		return '</script>';
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('link_tag'))
{
	/**
	 * Link
	 *
	 * Generates link to a CSS file
	 *
	 * @param	mixed	stylesheet hrefs or an array
	 * @param	string	rel
	 * @param	string	type
	 * @param	string	title
	 * @param	string	media
	 * @param	bool	should index_page be added to the css path
	 * @return	string
	 */
	function link_tag($href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = FALSE)
	{
		$CI =& get_instance();
		$link = '<link ';

		if (is_array($href))
		{
			foreach ($href as $k => $v)
			{
				if ($k === 'href' && ! preg_match('#^([a-z]+:)?//#i', $v))
				{
					if ($index_page === TRUE)
					{
						$link .= 'href="'.$CI->config->site_url($v).'" ';
					}
					else
					{
						$link .= 'href="'.$CI->config->base_url($v).'" ';
					}
				}
				else
				{
					$link .= $k.'="'.$v.'" ';
				}
			}
		}
		else
		{
			if (preg_match('#^([a-z]+:)?//#i', $href))
			{
				$link .= 'href="'.$href.'" ';
			}
			elseif ($index_page === TRUE)
			{
				$link .= 'href="'.$CI->config->site_url($href).'" ';
			}
			else
			{
				$link .= 'href="'.$CI->config->base_url($href).'" ';
			}

			$link .= 'rel="'.$rel.'" type="'.$type.'" ';

			if ($media !== '')
			{
				$link .= 'media="'.$media.'" ';
			}

			if ($title !== '')
			{
				$link .= 'title="'.$title.'" ';
			}
		}

		return $link."/>\n";
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('meta'))
{
	/**
	 * Generates meta tags from an array of key/values
	 *
	 * @param	array
	 * @param	string
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	function meta($name = '', $content = '', $type = 'name', $newline = "\n")
	{
		// Since we allow the data to be passes as a string, a simple array
		// or a multidimensional one, we need to do a little prepping.
		if ( ! is_array($name))
		{
			$name = array(array('name' => $name, 'content' => $content, 'type' => $type, 'newline' => $newline));
		}
		elseif (isset($name['name']))
		{
			// Turn single array into multidimensional
			$name = array($name);
		}

		$str = '';
		foreach ($name as $meta)
		{
			$type		= (isset($meta['type']) && $meta['type'] !== 'name')	? 'http-equiv' : 'name';
			$name		= isset($meta['name'])					? $meta['name'] : '';
			$content	= isset($meta['content'])				? $meta['content'] : '';
			$newline	= isset($meta['newline'])				? $meta['newline'] : "\n";

			$str .= '<meta '.$type.'="'.$name.'" content="'.$content.'" />'.$newline;
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('br'))
{
	/**
	 * Generates HTML BR tags based on number supplied
	 *
	 * @deprecated	3.0.0	Use str_repeat() instead
	 * @param	int	$count	Number of times to repeat the tag
	 * @return	string
	 */
	function br($count = 1)
	{
		return str_repeat('<br />', $count);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('nbs'))
{
	/**
	 * Generates non-breaking space entities based on number supplied
	 *
	 * @deprecated	3.0.0	Use str_repeat() instead
	 * @param	int
	 * @return	string
	 */
	function nbs($num = 1)
	{
		return str_repeat('&nbsp;', $num);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('div_tag'))
{
	/*
	 * div tag helper
	 * @name: div
	 * @param: String $content
	 * @param: String $attributes like class
	 * @return String
	 */
	function div_tag($content = '', $attributes = '')
	{
		$srcs = array();
		$script = '';
		$open_only = FALSE;

		if ( ! is_array($content) ) {
			if ( trim($content) == '' OR $content == NULL) {
				$open_only = TRUE;
			}
			$srcs['content'] = $content;
		}

		if ( trim($srcs['content']) == '') {
			$open_only = TRUE;
		}

		if ( ! is_array($attributes)) {
			$srcs['attributes'] = $attributes;
		}
		else {
			foreach ($atributes as $k => $v) {
			// for attributes without values, like async or defer, use NULL.
				$satribs .= $k . (null === $v ? ' ' : '="' . $v . '" ');
			}
			$srcs['attributes'] = $satribs;
		}

		$script .= '<div '.$srcs['attributes'].'>';
		if ( $open_only !== TRUE ) {
			$script .= $srcs['content'];
			$script .= '</div>';
		}

		return $script;
	}

}

// ------------------------------------------------------------------------

if ( ! function_exists('div_close'))
{
	/*
	 * div tag helper for close tag
	 * @name: div_close
	 * @return String
	 */
	function div_close()
	{
		return '</div>';
	}
}

if ( ! function_exists('div_open'))
{
	/*
	 * div tag helper for close tag
	 * @name: div_open
	 * @param: String $attributes like class
	 * @return String
	 */
	function div_open($attributes = '')
	{
		return div_tag('', $attributes);
	}

}

