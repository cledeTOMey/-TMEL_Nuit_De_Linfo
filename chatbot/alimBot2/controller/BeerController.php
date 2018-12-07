<?php

class BeerController extends Controller {


	public function index() {
		$this->render("index", Beer::findAll());
	}

	public function view() {
		try {
			$b = new Beer(parameters()["id"]);
			$this->render("view", $b);
		} catch (Exception $e) {
			(new SiteController())->render("index");
			// $this->render("error");
		}
	}


	public function add() {
		if (isset(parameters()["name"])) {
			$beer = new Beer();
			//$beer->idbeer = parameters()["idbeer"];
			$beer->name = parameters()["name"];
			$beer->degree = parameters()["degree"];
			$beer->brewery = new Brewery(parameters()["brewery"]);
			//var_dump($beer);
			$this->render("index", Beer::findAll());
		} else {
			$this->render("add");
		}
	}


}


