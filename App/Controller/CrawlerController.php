<?php

namespace App\Controller;

use Flame\Controller;
use App\Helper\SimpleHtmlDom;
use App\Model;
use \Exception;

class CrawlerController extends Controller {

	public $html;
	public $vechicleList;
	public $validProductTypes = ['carro', 'moto', 'caminhao'];
	public $urlBase = 'https://seminovosbh.com.br/';

	// https://seminovosbh.com.br/carro/citroen/ano-1999-2010/preco-8000-100000/km-4000-45000/"

	public function search(){

		$query = '';
		$vehicleList = [];

		try {
			if(!$this->isProductTypeValid()) throw new Exception('You must provide product type');
			$query = $this->buildQueryBasedOnParams();
			$vehicleList = $this->getVehicleDataList($this->urlBase . $query);
			// var_dump($vehicleList);
		} catch(Exception $e) {
			echo json_encode([
				"status" => http_response_code(400),
				"message" => $e->getMessage()
			]);
			die;
		}
		echo json_encode([
			"status" => http_response_code(200),
			"data" => $vehicleList
		]);
		// echo json_encode($this->getVehicleDataList('carro/citroen'));
		// echo json_encode($this->getVehicleData('https://seminovosbh.com.br/chevrolet-cobalt-2017-2018--2734255'));

	}

	public function isProductTypeValid() {
		return in_array($_POST['product_type'], $this->validProductTypes);
	}

	public function buildQueryBasedOnParams() {
		$query = '';

		
		if($_POST['product_type']) {
			$query = $_POST['product_type'] . '/';
		}

		
		if($_POST['brand']) {
			$query .= $_POST['brand'] . '/';
		}

		if($_POST['model']) $query .= $_POST['model'] . '/';

		if($_POST['year_from'] || $_POST['year_to']) {
			$query .= 'ano-' . $_POST['year_from'] . '-' . $_POST['year_to'] . '/';
		}

		if($_POST['price_from'] || $_POST['price_to']) {
			$query .= 'preco-' . $_POST['price_from'] . '-' . $_POST['price_to'] . '/';
		}

		if($_POST['km_from'] || $_POST['km_to']) {
			$query .= 'km-' . $_POST['km_from'] . '-' . $_POST['km_to'] . '/';
		}

		if(substr($query, -1) == '/') $query = substr($query, 0, -1);

		if($_POST['page']) $query .= '?page=' . $_POST['page'];


		return $query;
	}

	public function getVehicleData(String $url) {
		$simpleHtmlDom = new SimpleHtmlDom();
		$this->html = $simpleHtmlDom->file_get_html($url);

		$vehicleExtractor = new vehicleExtractor();
		$vehicleData = $vehicleExtractor->getVehicleFromHtmlContainer($this->html);

		return $vehicleData;
	}

	public function getVehicleDataList(String $url) {
		$simpleHtmlDom = new SimpleHtmlDom();
		$this->html = $simpleHtmlDom->file_get_html($url);

		// var_dump($this->html);

		$vehicleListExtractor = new VehicleListExtractor();
		$vehicleList = $vehicleListExtractor->getVehicleFromHtmlContainer($this->html);

		return $vehicleList;
	}

}
?>