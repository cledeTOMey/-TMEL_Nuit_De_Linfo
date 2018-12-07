	<?php

class BreweryController extends Controller {


	public function index() {
		$this->render("index", Brewery::findAll());
	}

	public function view() {
		$brewery = new Brewery(parameters()["id"]);
		$this->render("view", $brewery);
	}


	public function add() {
		if (isset(parameters()["name"])) {
			$brewery = new Brewery();
			$brewery->name = parameters()["name"];
			$brewery->country = new Country(parameters()["country"]);
			$this->render("index", Brewery::findAll());
		} else {
			$this->render("add");
		}
	}

}


