<?php

class Sitemap extends Site_Controller
{
	/**
	 * XML method - output sitemap in XML format for search engines
	 *
	 * @return void
	 */
	public function xml()
	{
		$doc = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

		// first get a list of enabled modules, use them for the listing
		$modules = $this->app_model->getAll(['isFrontend' => 1]);

		foreach ( $modules as $module )
		{
			// To understand recursion, you must first understand recursion
			if ($module['slug'] == 'sitemap')
			{
				continue;
			}

			if ( ! file_exists($module['path'] . '/controllers/Sitemap.php'))
			{
				continue;
			}

			if(site_url() == '/')
			{
				$doc->addChild('sitemap')
					->addChild('loc', BASE_URL.substr(site_url($module['slug'].'/sitemap'), 1));
			}
			else
			{
				$doc->addChild('sitemap')
					->addChild('loc', site_url($module['slug'].'/sitemap'));
			}
		}

		$this->output
			->set_content_type('application/xml')
			->set_output($doc->asXML());
	}
}