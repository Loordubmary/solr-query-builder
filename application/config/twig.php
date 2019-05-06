<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * The following config items are for the integration of
 * the Twig template parsing system into CodeIgniter.
 *
 * @author  Dimas Rullyan Danu <dimasdanz@gmail.com>
 * @link    http://dimasdanz.com
 * @version 1.0.0
 * @license MIT
 */
/**
 * --------------------------------------------------------------------------
 * Template Directory
 * --------------------------------------------------------------------------
 *
 * Set the directory where your templates (view files) are located.
 * Most users will not need to change this directory. It is pre-set
 * to CodeIgniter's default views directory.
 *
 * The default is a ternary op check to see if the CI 3.0+
 * constant VIEWPATH exists. You can customize this as you see fit.
 *
 * @var   string
 * @since 1.0.0
 */
$config['twig']['template_dir'] = VIEWPATH;
/**
 * --------------------------------------------------------------------------
 * File Extension
 * --------------------------------------------------------------------------
 *
 * Set the file extension of the templates (views) you're
 * using with the Twig template library.
 *
 * Common examples: php, html
 * Default: php
 *
 * @var   string
 * @since 1.0.0
 */
$config['twig']['template_ext'] = 'php';
/**
 * --------------------------------------------------------------------------
 * Auto-escape Variables
 * --------------------------------------------------------------------------
 *
 * When TRUE, every variables parsed by Twig will be automatically escaped.
 * If you want to prevent escaping of a variable, use flag: {{ variable|raw }}
 *
 * Default: TRUE
 *
 * @var   boolean
 * @since 1.0.0
 * @see   http://twig.sensiolabs.org/doc/api.html
 */
$config['twig']['environment']['autoescape'] = TRUE;
/**
 * --------------------------------------------------------------------------
 * Cache Directory
 * --------------------------------------------------------------------------
 *
 * When set to TRUE all template loaders cache the compiled templates
 * on the filesystem for future reuse.
 * Default location is application/cache/twig/
 *
 * Or if you want to change the defaul location, you can opt to set a specific
 * path as well (e.g cache/twig)
 *
 * Default: FALSE;
 *
 * @var   boolean|string
 * @since 1.0.0
 */
$config['twig']['environment']['cache'] = FALSE;
/**
 * --------------------------------------------------------------------------
 * Debug
 * --------------------------------------------------------------------------
 *
 * When set to TRUE, the generated templates have a __toString() 
 * method that you can use to display the generated nodes.
 * escaped (via PHP's htmlspecialchars()). If you want to prevent
 * escaping of a variable, use the nofilter flag: {$variable nofilter}
 *
 * Default: FALSE
 *
 * @var   boolean
 * @since 1.0.0
 * @see   http://twig.sensiolabs.org/doc/api.html
 */
$config['twig']['environment']['debug'] = FALSE;
/* End of file twig.php */
/* Location: ./application/config['twig']/twig/twig.php */