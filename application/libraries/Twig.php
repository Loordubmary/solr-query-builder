<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Twig template engine implementation for CodeIgniter
 *
 * Just a simple implementation of Twig template engine for CodeIgniter. 
 * 
 * @package   			CodeIgniter
 * @subpackage			Twig
 * @category  			Libraries
 * @author    			Dimas Rullyan Danu <dimasdanz@gmail.com>
 * @license   			MIT
 * @version   			1.0.0
 */
class Twig {
	private $CI;
	private $_config = array();
	private $_twig;
	private $_twig_loader;
	
	/**
	* Constructor
	*/
	public function __construct(){
		log_message('debug', 'Twig: library initialized');
		$this->CI =& get_instance();
		$this->_config = $this->CI->config->item('twig');
		try {
			$this->_twig_loader = new Twig_Loader_Filesystem($this->_config['template_dir']);
		} catch (Exception $e) {
			show_error(htmlspecialchars_decode($e->getMessage()), 500, 'Twig Exception');
		}
		//Check if cache is enabled
		if($this->_config['environment']['cache'] === true){
			$this->_config['environment']['cache'] = APPPATH.'cache/twig';
		}
		$this->_twig = new Twig_Environment($this->_twig_loader, $this->_config['environment']);
	}
	/**
	* Render
	* Return rendered string 
	* @access	public
	* @param	string	The template path name.
	* @param	array	An array of data to convert to variables.
	* @return	string	content of the template
	*/
	public function render($template, $data = array()){
		$template = $this->addExtension($template);
		return $this->_twig->render($template, $data);
	}
	/**
	* Display
	* Shortcut to output the template directly.
	* @access	public
	* @param	string	The template path name.
	* @param	array	An array of data to convert to variables.
	* @return	void	echo content directly.
	*
	* I have no idea why I made this
	*/
	public function display($template, $data = array()){
		$this->_twig->display($template, $data);
	}
	/**
	* addExtension
	* Automatically add default extension if it's not there
	* @access	public
	* @param	string	The template name.
	*/
	private function addExtension($template){
		$ext = '.'.$this->_config['template_ext'];
		if(substr($template, -strlen($ext)) !== $ext){
			return $template .= $ext;
		}
		return $template;
	}
}
/* End of file twig.php */
/* Location: ./application/config/twig/twig.php */