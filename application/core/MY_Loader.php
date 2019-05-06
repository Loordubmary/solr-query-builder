<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * MY_Loader class extends the core CI_Loader class for Twig.
 *
 * @author  Dimas Rullyan Danu <dimasdanz@gmail.com>
 * @link    http://dimasdanz.com
 * @version 1.0.0
 * @license MIT
 */
class MY_Loader extends CI_Loader {
	/**
	 * Replace the default $this->load->view() method
	 *
	 * This method works identically to CI's default method,
	 * in that you should pass parameters to it in the same way.
	 *
	 * @access	public
	 * @param	string	The template path name.
	 * @param	array	An array of data to convert to variables.
	 * @param	bool	Set to TRUE to return the loaded template as a string.
	 * @return	mixed	If $return is TRUE, returns string. If not, returns void.
	 */
	public function view($template, $data = array(), $return = FALSE) {
		$CI =& get_instance();
		try {
			$output = $CI->twig->render($template, $data);
		} catch (Exception $e) {
			show_error(htmlspecialchars_decode($e->getMessage()), 500, 'Twig Exception');
		}
		// Return the output if the return value is TRUE.
		if ($return === TRUE) {
			return $output;
		}
		// Otherwise append to output just like a view.
		$CI->output->append_output($output);
	}
}