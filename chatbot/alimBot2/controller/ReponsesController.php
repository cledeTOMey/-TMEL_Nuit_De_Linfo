	<?php

class ReponsesController extends Controller {


	public function index() {
		$this->render("index", Reponses::findAll());
	}

	public function view() {
		$reponse = new Reponses(parameters()["id"]);
		$this->render("view", $reponse);
	}


	public function add() {
		if (isset(parameters()["text_reponse"])) {
			$reponse = new Reponses();
			$reponse->text_reponse = parameters()["text_reponse"];
			$reponse->country = new Motcles(parameters()["motcles"]);
			$this->render("index", Reponses::findAll());
		} else {
			$this->render("add");
		}
	}

}


