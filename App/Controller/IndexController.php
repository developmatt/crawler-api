<?php

namespace App\Controller;

use Flame\Controller;
use App\Helper\SimpleHtmlDom;
use App\Model;

class IndexController extends Controller {

	public $html;
	public $vechicleList;

	public function index(){
		http_response_code(200);
		// echo json_encode($this->getVehicleData('https://seminovosbh.com.br/chevrolet-cobalt-2017-2018--2734255'));
		echo json_encode($this->getVehicleDataList('https://seminovosbh.com.br/carro/citroen'));

	}

	// public function construct() {
		// $this->getVehicleData('https://seminovosbh.com.br/chevrolet-cobalt-2017-2018--2734255');
		// $this->getVehicleDataList('https://seminovosbh.com.br/carro/citroen');
	// }

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

		$vehicleListExtractor = new VehicleListExtractor();
		$vehicleList = $vehicleListExtractor->getVehicleFromHtmlContainer($this->html);

		return $vehicleList;
	}

}
?>