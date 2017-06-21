<?php

/**
 *	Class Sitemap.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/post/controllers/Sitemap.php
 */

class Sitemap extends Site_Controller
{
	/**
	 * XML
	 */
	public function xml()
	{
		$this->load->model('post_model');

		$doc = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

		// Get all pages
		$articles = $this->post_model->getManyBy(['status', 1]);

		// send em to XML!
		foreach ($articles as $article)
		{
			$node = $doc->addChild('url');

			if(site_url() == '/') {
				$loc = BASE_URL.substr(site_url('post/preview/' . $article->slug), 1);
			}
			else
			{
				$loc = site_url('post/preview/' . $article->slug);
			}

			$node->addChild('loc', $loc);

			if ($article->createOn)
			{
				$node->addChild('lastmod', date('Y-m-d', $article->createOn));
			}
		}

		$this->output
			->set_content_type('application/xml')
			->set_output($doc->asXML());
	}
}
