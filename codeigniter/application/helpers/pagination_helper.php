<?php

if ( ! function_exists('createPagination'))
{
	function createPagination($uri, $total_rows, $limit = null, $uri_segment = 4, $full_tag_wrap = true)
	{
		$ci = & get_instance();
		$ci->load->library('pagination');

		//$current_page = $ci->uri->segment($uri_segment, 0);
		$current_page = (int) $ci->input->get('per_page');
		$suffix = $ci->config->item('url_suffix');

		$limit = $limit === null ? Setting::get('recordsPerPage') : $limit;

		// Initialize pagination
		$ci->pagination->initialize([
			'suffix' 				=> $suffix,
			'base_url' 				=> ( ! $suffix) ? rtrim(site_url($uri), $suffix) : site_url($uri),
			'total_rows' 			=> $total_rows,
			'per_page' 				=> $limit,
			'uri_segment' 			=> $uri_segment,
			'use_page_numbers'		=> true,
			//'reuse_query_string' 	=> true,
			'enable_query_strings' 	=> true,
			'page_query_string' 	=> true,
		]);

		$offset = $limit * ($current_page - 1);
		
		//avoid having a negative offset
		if ($offset < 0) $offset = 0;

		return [
			'current_page' => $current_page,
			'per_page' => $limit,
			'limit' => $limit,
			'offset' => $offset,
			'links' => $ci->pagination->create_links($full_tag_wrap)
		];
	}
}