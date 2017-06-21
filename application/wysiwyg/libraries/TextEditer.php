<?php

class TextEditer
{
	/**
	 * Load View
	 *
	 * @return	string	HTML of the comments and form
	 */
	public function loadView($view, $data)
	{
		$ext = pathinfo($view, PATHINFO_EXTENSION) ? '' : '.php';

		if (file_exists(CI::$APP->template->get_views_path().'application/wysiwyg/'.$view.$ext))
		{
			// look in the theme for overloaded views
			$path = CI::$APP->template->get_views_path().'application/wysiwyg/';
		}
		else
		{
			// or look in the module
			list($path, $view) = Modules::find($view, 'wysiwyg', 'views/');
		}

		// add this view location to the array
		CI::$APP->load->setViewPath([$path=>TRUE]);
		CI::$APP->load->vars($data);
		return CI::$APP->load->_ci_load(['_ci_view' => $view, '_ci_return' => true]);
	}

}