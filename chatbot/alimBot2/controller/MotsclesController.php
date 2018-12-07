<?php

class MotsclesController extends Controller {


	public function index() {
		$this->render("index", Motscles::findAll());
	}

	public function view() {
		try {
			$bot = new Motscles(parameters()["id"]);
			$this->render("view", $bot);
		} catch (Exception $e) {
			(new SiteController())->render("index");
			// $this->render("error");
		}
	}


	public function add() 
	{
		if (isset(parameters()["libelle_mot"])) 
		{
			$bot = new Motscles();
			//$beer->idbeer = parameters()["idbeer"];
			$bot->libelle_mot = parameters()["libelle_mot"];
			$bot->poid_mot = parameters()["poid_mot"];
			//var_dump($beer);
			$this->render("index", Motscles::findAll());

		} 
		else 
		{
			$this->render("add");
		}
	}


}


