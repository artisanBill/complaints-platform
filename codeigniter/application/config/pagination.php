<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Number of Links
|--------------------------------------------------------------------------
|
| How many links should be output for pagination.
|
*/
$config['num_links'] = 8;

/*
|--------------------------------------------------------------------------
| Tags
|--------------------------------------------------------------------------
|
| Control the HTML that gets wrapped around pagination.
|
*/
$config['full_tag_open'] = '<ul class="pagination pagination-lg">';
$config['full_tag_close'] = '</ul>';

$config['first_link'] = '&laquo;';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

$config['prev_link'] = '&laquo;';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="active"><span>';
$config['cur_tag_close'] = '</span></li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$config['next_link'] = '&raquo;';
$config['next_tag_open'] = '<li class="next">';
$config['next_tag_close'] = '</li>';

$config['last_link'] = '&raquo;';
$config['last_tag_open'] = '<li class="last">';
$config['last_tag_close'] = '</li>';

/* End of file pagination.php */