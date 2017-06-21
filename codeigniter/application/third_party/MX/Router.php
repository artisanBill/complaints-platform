<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX core module class */
require dirname(__FILE__).'/Modules.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter router class.
 *
 * Install this file as application/third_party/MX/Router.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
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
 **/
class MX_Router extends CI_Router
{
	/**
     * Current module name
     *
     * @var string
     * @access public
     */
    var $module = '';
    var $locations = array();
    /*
     * 分析并构造路由
     */
    function _parse_routes() {
        $locations = $this->config->item('modules_locations');

        if (! $locations ) {
            $locations = array('application/');
        } else if (!is_array($locations)) {
            $locations = array($locations);
        }
        $this->locations = $locations;

        // Apply the current module's routing config
        if ($module = $this->uri->segment(0)) {
            foreach ($this->locations as $location) {
                if (is_file($file = $location . $module . '/config/routes.php')) {
                    include ($file);
                    $route = (!isset($route) or !is_array($route)) ? array() : $route;
                    $this->routes = array_merge($this->routes, $route);
                    unset($route);
                }
            }
        }
        //使用默认
        return parent::_parse_routes();
    }
    /**
     * 检测路径中是否包含需要的控制器文件
     *
     * @access	private
     * @param	array
     * @return	array
     */
    function _validate_request($segments) {
        if (count($segments) == 0) {
            return $segments;
        }
        // Locate the controller with modules support
        if ($located = $this->locate($segments)) {
            return $located;
        }

        return parent::_validate_request($segments);
    }
    /**
     * 寻找controller路径
     *
     * @param	array
     * @return	array
     */
    function locate($segments) {
        
        $module = $segments[0];
        foreach ($this->config->item('modules_locations') as $location) {
            $relative = $location;
            //如果 包含有 modules/$module/controllers文件夹
            //var_dump(is_dir($source = $relative . $module . '/controllers/'));exit;
            if (is_dir($source = $relative . $module . '/controllers/')) {
                $this->module = $module;
                $this->directory =  '../../' . $location . $module . '/controllers/';
                $seg=array_slice($segments,1);
            	$c=count($seg);
            	// var_dump($seg);
            	$i=0;
            	while($c-- > 0) {
            		$ac=current($seg);
            		$next=next($seg);
            		
                	// var_dump($c.'/'.$ac.'/'.$next);
            		// var_dump($source.$ac);
            		if ($ac && is_dir($source . $ac . '/')) {
                		$source .= $ac . '/';
                		$this->directory .= $ac . '/';
                		
            			if($next&&is_dir($source.$next.'/')){
            				// var_dump('next/');
            				$i++;
                			continue;
                		}
	                }
	                //var_dump($ac.'-'.$next);
                    if ($next && is_file($source . ucfirst($next) . '.php')) {
                    	// var_dump('next'.$source . ucfirst($next) . '.php');
                        return array_slice($seg, $i+1);
                    }
					
                    if (is_file($source . ucfirst($ac) . '.php')) {
                    	// var_dump('now'.$source . ucfirst($ac) . '.php');
                        return array_slice($seg, $i);
                    }

            	}

            	//如果有 controllers/$module.php
                if (is_file($source . ucfirst($module) . '.php')) {
                    return $segments;
                }
                
            }
        }
        
    }
    function fetch_module(){
        return $this->module;
    }
}	