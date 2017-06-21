<?php

if ( ! function_exists('treeBuilder'))
{
	/**
	 * Build the html for a tree view
	 *
	 * @param array $items 	An array of items that may or may not have children (under a key named `children` for each appropriate array entry).
	 * @param array $html 	The html string to parse. Example: <li id="{{ id }}"><a href="#">{{ title }}</a>{{ children }}</li>
	 *
	 */
	function treeBuilder($items, $html)
	{
		$output = '';

		if( is_array($items) )
		{
			foreach ($items as $item)
			{
				if (isset($item['children']) and ! empty($item['children']))
				{
					// if there are children we build their html and set it up to be parsed as {{ children }}
					$item['children'] = '<ul>' . treeBuilder($item['children'], $html) . '</ul>';
				}
				else
				{
					$item['children'] = null;
				}

				$ci = get_instance();
				if ( ! class_exists('parser') )
				{
					$ci->load->library('parser');
				}
				// now that the children html is sorted we parse the html that they passed
				$output .= $ci->parser->parse_string($html, $item, true);
			}

			return $output;
		}
	}
}