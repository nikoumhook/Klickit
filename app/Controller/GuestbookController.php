<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\GuestbookModel;
use \W\Security\AuthorizationModel;

class GuestbookController extends Controller 
{


/******************* BACK *********************/
	/**
	 * Liste des messages du Livre d'Or
	 */
	public function listGuestbook()
	{
		$this->show('back/Guestbook/listGuestbook');
	}

	/**
	 * Modification du Livre d'Or
	 */
	public function updateGuestbook()
	{
		$this->show('back/Guestbook/updateGuestbook');
	}

	/**
	 * Suppression des messages du Livre d'Or
	 */
	public function deleteGuestbook()
	{
		$this->show('back/Guestbook/deleteGuestbook');
	}


/******************* FRONT *********************/


	/**
	 * Suppression des messages du Livre d'Or
	 */
	public function affGuestbook()
	{
		$this->show('front/User/guestBook');
	}


}