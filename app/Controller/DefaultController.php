<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
			$this->redirectToRoute('front_index');
	}


	/**
	 * Page404
	 */
	public function notFound()
	{
			$this->showNotFound();
	}

}