<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	require FCPATH . 'vendor/autoload.php';
	/**
	* Controller for handling search using solarium package 
	* using composer package in Vendor Folder
	*
	* 
	*/

	class PageLimit extends CI_Controller {
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
		public function pageLimit() {
			// Create select query
			$query = $this->client->createSelect();

			// Search result depends on product_price
			$query->setQuery('product_price:"2.5"');

			// Set starting number and number of product count
			// this line load static
			$query->setStart(5)->setRows(100);

			// If you want dynamic use this below line
			/*
				$start_at = 5; or like $this->input->post('start_at')
				$total_rows = 100; or like $this->input->post('total_rows')

				$query->setStart($start_at)->setRows($total_rows);
			*/

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