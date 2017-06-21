<?php

class Comments
{
	/**
	 * The name of the module in use
	 * 
	 * @var	string
	 */
	protected $module;

	/**
	 * Singular language key
	 * 
	 * @var	string
	 */
	protected $singular;

	/**
	 * Comment Count
	 *
	 * Setting to 0 by default.
	 *
	 * @var 	int
	 */
	protected $count = 0;

	/**
	 * Count comments
	 *
	 * @return	int	Return the number of comments for this entry item
	 */
	public static function count(string $module, int $urlSlug)
	{
		return (int) CI::$APP->db->where([
			'module'	=> $module,
			'urlSlug'	=> $urlSlug,
			'isActive'	=> TRUE,
		])->count_all_results('comments');
	}

	public function memberForm($data = [])
	{
		return $this->loadView('form', $data);
	}

	public function memberDisplay($data = [])
	{
		return $this->loadView('display', $data);
	}

	/**
	 * Load View
	 *
	 * @return	string	HTML of the comments and form
	 */
	public function loadView($view, $data)
	{
		$ext = pathinfo($view, PATHINFO_EXTENSION) ? '' : '.php';

		if (file_exists(CI::$APP->template->get_views_path().'application/comments/'.$view.$ext))
		{
			// look in the theme for overloaded views
			$path = CI::$APP->template->get_views_path().'application/comments/';
		}
		else
		{
			// or look in the module
			list($path, $view) = Modules::find($view, 'comments', 'views/');
		}

		// add this view location to the array
		CI::$APP->load->setViewPath([$path=>TRUE]);
		CI::$APP->load->vars($data);
		return CI::$APP->load->_ci_load(['_ci_view' => $view, '_ci_return' => true]);
	}

}