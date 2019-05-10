<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	require FCPATH . 'vendor/autoload.php';
	/**
	* Controller for handling search using solarium package 
	* using composer package in Vendor Folder
	*
	* 
	*/

	class SimpleFacet extends CI_Controller {
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
		public function simpleFacet() {
			// Create select query
			$query = $this->client->createSelect();

			// get the facetset component
			$facetSet = $query->getFacetSet();

			$facetSet->createFacetField('productPrice')->setField('product_price');

			// Store result
			$result = $this->client->select($query);
			
			// Get total product coun t using - getNumFound() function
			echo 'Number Of Product: '.$result->getNumFound() . PHP_EOL;

			$facet = $result->getFacetSet()->getFacet('productPrice');
			echo '<hr/><table border="1">';
				echo '<tr><th>Product Price</th><th>Total Product count(under this price)</th></tr>';
				foreach ($facet as $value => $count) {
					echo '<tr><td>' . $value . '</td><td>' . $count . '</td></tr>';
				}
			echo '</table><br>';

		}
	}
?>