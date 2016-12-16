<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\OrdersModel;
use \W\Security\AuthorizationModel;

class OrdersController extends Controller 
{

/***************** BACK *****************/	
	/**
	 * Liste des commandes
	 */
	public function listOrders()
	{
		
		// On instancie le nombre de nb de lignes ds la table
		$nbpage= new OrdersModel();
			$nb=$nbpage->countResults();

		// on definit les variables, page courante et nb de lignes affichées
		$page = (isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
		$max = 15;

		$orders = new OrdersModel();
			$list_orders = $orders->findAllOrders($page, $max);

				$data = [
					'data'	=> $list_orders,
					'max' => $max,
					'page' => $page,
					'nb' => $nb,
						
				];
				
				if(!empty($_SESSION)){

					$this->show('back/Orders/listOrders', $data);

					if($_SESSION['role'] == 'Utilisateur') {
						$this->redirectToRoute('front_index');
					}
				}
				else {
					$this->redirectToRoute('back_login');
				}
	}

	/**
	 * Vu unique d'une commande avec possibilité de changer son statut
	 */
	public function viewOrders() 
	{
		$this->show('back/Orders/updateOrders');
	}


}