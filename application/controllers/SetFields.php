<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	require FCPATH . 'vendor/autoload.php';
	/**
	* Controller for handling search using solarium package 
	* using composer package in Vendor Folder
	*
	* 
	*/

	class SetFields extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->config->load('solarium');
			$this->client = new Solarium\Client($this->config->item('solarium_endpoint'));
		}

		/**
		* Select all the records
		*
		* Using solarium packages
		*/
		public function setFields() {
			// Create select query
			$query = $this->client->createSelect();

			// Set Fields what you want
			$query->setFields(array('id','product_price'));

			// Store result
			$result = $this->client->select($query);
			
			// Get total product coun t using - getNumFound() function
			echo 'Number Of Product: '.$result->getNumFound() . PHP_EOL;

			foreach ($result as $document) {
			
			echo '<hr/><table border="1">';
			
			// the documents are also iterable, to get all fields
			foreach($document AS $field => $value)
			{
				// this converts multivalue fields to a comma-separated string
				if(is_array($value)) $value = implode(', ', $value);
				echo '<tr><th>' . $field . '</th><td>' . $value . '</td></tr>';
			}
				echo '</table>';
			}
		}
	}
?>