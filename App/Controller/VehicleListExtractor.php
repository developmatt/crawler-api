<?php 

namespace App\Controller;

use App\Model\Vehicle;

	class VehicleListExtractor {

        public $htmlContainer;

		public function getVehicleFromHtmlContainer($htmlContainer) {

            preg_match_all('/<div class=\"anuncio-container\" data-rolagem-infinita data-target>(.*?)<i class="icon icon-pin align-middle"><\/i>/', $htmlContainer, $pregResults);

			$this->htmlContainer = $pregResults[0];

			$vehicleList = [];

			foreach ($this->htmlContainer as $key => $resultContainer) {
				$currentVehicle = new Vehicle();
				$currentVehicle->name = $this->getName($resultContainer);
				$currentVehicle->description = $this->getDescription($resultContainer);
				$currentVehicle->year = $this->getYear($resultContainer);
				$currentVehicle->mileAge = $this->getMileage($resultContainer);
				$currentVehicle->fuel = $this->getFuel($resultContainer);
				$currentVehicle->gear = $this->getGear($resultContainer);
				$currentVehicle->accessories = $this->getAccessories($resultContainer);
				$currentVehicle->price = $this->getPrice($resultContainer);
				$currentVehicle->pictures = [$this->getPicture($resultContainer)];
				$vehicleList[] = $currentVehicle;
			}

			return $vehicleList;
		}

		public function getPicture($resultContainer) {
			preg_match_all('/(?<=<span class=\"thumbnail\"> <figure>)(.*?)(?=<\/figure>)/', $resultContainer, $figureResults);
			preg_match_all('/(?<=<img src=")(.*?)(?=" alt=")/', $figureResults[0][0], $results);
			return $results[0][0];
		}

		public function getName($resultContainer) {
			preg_match_all('/(?<=<div class=\"card-header\"> <h4>)(.*?)(?=<\/h4>)/', $resultContainer, $results);
			return $results[0][0];
		}

		public function getDescription($resultContainer) {
			preg_match_all('/(?<=<div class="description"> <span><b>)(.*?)(?=<\/b><\/span>)/', $resultContainer, $results);
			return trim($results[0][0]);
		}

		public function getYear($resultContainer) {
			preg_match_all('/(?<=<i class="icon icon-calendar"><\/i> <span>)(.*?)(?=<\/span>)/', $resultContainer, $results);
			return $results[0][0];
		}

		public function getMileage($resultContainer) {
			preg_match_all('/(?<=<i class="icon icon-velocity"><\/i> <span>)(.*?)(?=<\/span>)/', $resultContainer, $results);
			return preg_replace("/[^0-9]/", "", $results[0][0]);
		}

		public function getFuel($resultContainer) {
			preg_match_all('/(?<=<i class="icon icon-fuel"><\/i> <span>)(.*?)(?=<\/span>)/', $resultContainer, $results);
			return $results[0][0];	
		}

		public function getGear($resultContainer) {
			preg_match_all('/(?<=<i class="icon icon-gearbox"><\/i> <span>)(.*?)(?=<\/span>)/', $resultContainer, $results);
			return trim($results[0][0]);	
		}

		public function getAccessories($resultContainer) {
			preg_match_all('/(?<=<div class="acessorio"><span class="ponto">&bull;<\/span>)(.*?)(?=<\/div>)/', $resultContainer, $results);
			return $results[0][0];
		}

		public function getPrice($resultContainer) {
			preg_match_all('/(?<=<h4 title="Preço do veículo">)(.*?)(?=<\/a>)/', $resultContainer, $results);
			return trim(preg_replace("/[^0-9]/", "", strip_tags($results[0][0]))) / 100;
		}
	}
 ?>