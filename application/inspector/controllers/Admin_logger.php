<?php

class Admin_logger extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'inspector';

	/**
	 * The constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('logs_inspector');
		$this->load->helper('file');
		$this->logsDirtectory = $this->config->item('log_path') ? : show_error(lang('log.path.error'), 500);
		//$this->template->append_js('module::logs_inspector.js');
	}

	/**
	 * Show logs
	 * @return void
	 */
	public function index()
	{
		$data['logs'] = array_reverse(get_dir_file_info($this->logsDirtectory ) );
		$this->template
			->build('admin/preview', $data);
	}

	public function view($filename = NULL)
	{
		$filepath = $this->logsDirtectory . $filename . '.php';
		$file = file($filepath);
		$load_count = 100;
		if (isset($_POST['textFilter']) && trim($_POST['textFilter']) != '')
		{
			$textFilter = $_POST['textFilter'];
			$this->session->set_flashdata('success', sprintf(lang('log.filter.search'), $textFilter));
		}
		else
		{
			$textFilter = '';
		}
		if (isset($_POST["fromCount"]))
		{
			$fromCount = $_POST["fromCount"];
		}
		else
		{
			$fromCount = 0;
		}

		$data['countLines'] = count($file) - 2;

		$indexCount = 100;
		if (isset($_POST['indexCount']))
		{
			$indexCount = $_POST['indexCount'];
		}

		$pagging = count($file);
		$start = count($file) - $indexCount;
		$ends = $start + 100;
		$start = ($start < 2)? 2 : $start;

		$data['from'] = $fromCount - $pagging;
		$data['to'] = $pagging;

		$types = [];
		$lines = [];

		for ($i = $start; $i < $ends && isset($file[$i]); $i++)
		{
			if (trim($file[$i]) != '' & ($textFilter == '' ||  strpos($file[$i], $textFilter) !== false))
			{
				$parsed = explode(' --> ', $file[$i]);
				if (count($parsed) == 3)
				{
					$row = explode(' - ',$parsed[0]);
					$row[2] = trim(str_replace('Severity: ', '', $parsed[1]));
					$row[3] = trim($parsed[2]);
				}
				else
				{
					if (count($parsed) == 2)
					{
						$row = explode(' - ',$parsed[0]);
						$aux = explode(': ',$parsed[1]);
						if (count($aux) == 2)
						{
							$row[2] = trim($aux[0]);
							$row[3] = trim($aux[1]);
						}
						else
						{
							$row[2] = 'Message';
							$row[3] = trim($parsed[1]);
						}
					}
					else
					{
						$row[0] = 'ERROR';
						$row[1] = '';
						$row[3] = trim($file[$i]);
						$row[2] = 'Undefined';
					}
				}
				$lines[] = $row;
				if (isset($types[$row[2]]))
				{
					$types[$row[2]]++;
				}
				else
				{
					$types[$row[2]] = 1;
				}
			}
		}
		$lines = array_reverse($lines);
		$indexCount += 100;

		$data['lines']			= $lines;
		$data['types']			= $types;
		$data['textFilter']	= $textFilter;
		$data['indexCount']	= $indexCount;
		$data['filename']		= $filename;

		if ($this->input->is_ajax_request())
		{
			$this->template->set_layout(FALSE);
			$html = $this->load->view('admin/tables/log_table', $data, TRUE);
			return $this->template->build_json([
				'html'		=> $html,
				'indexCount' => $indexCount,
				'count'		=> count($lines)
			]);
		}
		else
		{
			$this->template
			->build('admin/log', $data);
		}
	}

	public function plain($filename)
	{
		echo "<pre>";
		echo file_get_contents($this->logsDirtectory . $filename . '.php');
		echo "</pre>";
	}

	public function download($filename)
	{
		$fileFullPath = $this->logsDirtectory . $filename . '.php';
		if (file_exists($fileFullPath))
		{
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename='.basename($fileFullPath).'.log');
		    header('Content-Transfer-Encoding: binary');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($fileFullPath));
		    flush();
		    readfile($fileFullPath);
		    exit;
		}
	}

	public function downloadFilter( $filename )
	{
		list($filename, $textFilter) = explode('_', $filename);
		$fileFullPath = $this->logsDirtectory . $filename . '.php';
		$textFilter = trim($textFilter);
		if (file_exists($fileFullPath) && $textFilter != '')
		{
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename=' . basename($fileFullPath) . '-filter-'.$textFilter . '.log');
		    header('Content-Transfer-Encoding: binary');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($fileFullPath));

			$file = file($fileFullPath);
			for ($i = 2; $i < count($file); $i++)
			{
				if (trim($file[$i]) != '' & ($textFilter == '' ||  strpos($file[$i], $textFilter) !== false))
				{
					echo $file[$i];
				}
			}
		    readfile($file);
		    exit;
		}
	}

	public function delete( $filename )
	{
		if (unlink($this->logsDirtectory  . $filename . '.php'))
		{
			$this->session->set_flashdata('success', sprintf($this->lang->line('log.deleteSuccess'), $filename));
		}
		else
		{
			$this->session->set_flashdata('success', sprintf($this->lang->line('log.deleteSrror'), $filename));
		}
		redirect('logsInspector/logger');
	}
}
