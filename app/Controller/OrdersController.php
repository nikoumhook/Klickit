<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\OrdersModel;
use \W\Security\AuthorizationModel;

class OrdersController extends Controller 
{
	/**
	 * Liste des commandes
	 */
	public function listOrders()
	{
		$this->show('back/Orders/listOrders');
	}

	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function viewOrders() 
	{
		$this->show('back/Orders/updateOrders');
	}
}