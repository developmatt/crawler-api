<?php

namespace App\Controller;

use App\Model\Vehicle;

	class VehicleExtractor {

		public $htmlContainer;

		public function getVehicleFromHtmlContainer($html) {
			preg_match_all('/(?<=<section class="veiculo-conteudo">)(.*?)(?=<\/section>)/', $html, $pregResults);

			$this->htmlContainer = $pregResults[0][0];
			$vehicle = new Vehicle();
			$vehicle->id = $this->getId($pregResults[0][0]);
			$vehicle->name = $this->getName($pregResults[0][0]);
			$vehicle->description = $this->getDescription($pregResults[0][0]);
			$vehicle->year = $this->getYear($pregResults[0][0]);
			$vehicle->mileAge = $this->getMileAge($pregResults[0][0]);
			$vehicle->fuel = $this->getFuel($pregResults[0][0]);
			$vehicle->gear = $this->getGear($pregResults[0][0]);
			$vehicle->accessories = $this->getAccessories($pregResults[0][0]);
			$vehicle->price = $this->getPrice($pregResults[0][0]);
			$vehicle->pictures = $this->getPictures($pregResults[0][0]);

			return $vehicle;
		}

		public function getId($resultContainer) {
			preg_match_all('/(?<=<div class="mr-print-2">cod:<span>)(.*?)(?=<\/span>)/', $resultContainer, $results);
			return $results[0][0];
		}

		public function getName() {
			preg_match_all('/(?<=itemprop="name">)(.*?)(?=<\/h1>)/', $this->htmlContainer, $results);
			return $results[0][0];
		}

		public function getDescription() {
			preg_match_all('/(?<=<p class="desc"> )(.*?)(?=<\/p>)/', $this->htmlContainer, $results);
			return $results[0][0];
		}

		public function getYear() {
			preg_match_all('/(<span title=\"Ano\/modelo\" itemprop=\"modelDate\")(.*?)(<\/span>)/', $this->htmlContainer, $results);
			return strip_tags($results[0][0]);
		}

		public function getMileAge() {
			preg_match_all('/(?<=itemprop="mileageFromOdometer">)(.*?)(.*?)(?=Km<\/span>)/', $this->htmlContainer, $results);
			return preg_replace("/[^0-9]/", "", $results[0][0]);
		}

		public function getFuel() {
			preg_match_all('/(?<=<span title="Tipo de combustível" itemprop="fuelType">)(.*?)(?=<\/span>)/', $this->htmlContainer, $results);
			return $results[0][0];
		}

		public function getGear() {
			preg_match_all('/(?<=<span title="Tipo de transmissão">)(.*?)(?=<\/span>)/', $this->htmlContainer, $results);
			return $results[0][0];
		}

		public function getAccessories() {
			preg_match_all('/(?<=<span class="description-print">)(.*?)(?=<\/span>)/', $this->htmlContainer, $results);
			return $results[0];
		}

		public function getPrice() {
			preg_match_all('/(?<=<span>R\$<\/span>)(.*?)(?=<\/span>)/', $this->htmlContainer, $results);
			return trim(preg_replace("/[^0-9]/", "", strip_tags($results[0][0]))) / 100;
		}

		public function getPictures() {
			preg_match_all('/(?<=<div class="gallery-thumbs"> <ul class="list-unstyled"> <li class=""> <img data-id=")(.*?)(?=<\/ul>)/', $this->htmlContainer, $results);
			preg_match_all('/(?<=data-src=")(.*?)(?=" class=")/', $results[0][0], $images);
			return $images[0];
		}
	}

 ?>