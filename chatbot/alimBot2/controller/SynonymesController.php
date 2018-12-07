<?php

class SynonymesController extends Controller {


	public function index() {
		$this->render("index", Synonymes::findAll());
	}

	public function view() {
		try {
			$b = new Synonymes(parameters()["id"]);
			$this->render("view", $b);
		} catch (Exception $e) {
			(new SiteController())->render("index");
			// $this->render("error");
		}
	}


	public function add() {
		if (isset(parameters()["libelle_idsynonyme"])) {
			$synonyme = new Synonymes();
			
			$synonyme->libelle_idsynonyme = parameters()["libelle_idsynonyme"];
			$synonyme->idmot = new Motcles(parameters()["motcles"]);
			
			$this->render("index", Synonymes::findAll());
		} else {
			$this->render("add");
		}
	}


}


