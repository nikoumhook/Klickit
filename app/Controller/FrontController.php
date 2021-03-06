<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel;
use \Model\UserModel;
use \Model\BackModel;
use \Model\ResetModel;
use \Model\OrdersModel;
use \Model\BasketModel;
use \Model\ItemModel;
use \Model\MessageModel;
use \Model\GuestbookModel;
use \Model\EventModel;
use \Model\SlideModel;
use \Model\FavoriteModel;
use \W\Security\AuthentificationModel;
use \W\Security\AuthorizationModel;
use \W\Security\StringUtils;
use \PHPMailer;
use \Respect\Validation\Validator as v;

class FrontController extends MasterController
{
	
	/**
	 * Page d'accueil par défaut
	 */
	public function index()
	{	
		$data = [];
		/******************Affichage des commentaires******************/

		$getComment = new GuestbookModel();
		$comments = $getComment->findAllMessageFront();

		/*****************Affichage du slider nouveauté/promotion*****************/

		$getStatut = new ItemModel();
		$statut = $getStatut->findStatut('nouveaute', 'promotion');

		$favorite = new FavoriteModel();
		$favoriteList = '';
		if(!empty($this->getUser())){
			$userFavorite = $favorite->findFavorisItem($_SESSION['user']['id']);

			$myFavorite = '';

			foreach ($userFavorite as $favoris) {
				foreach ($favoris as $value) {
					$myFavorite.= $value.', ';
				}
			}

			$favoriteList = substr($myFavorite, 0, -2);
		}
		
		$getSlide = new SlideModel();

		$lastSlide = $getSlide->realLastSlide();

		$RealLastSlide = implode('', end($lastSlide));

		$i = 0;
		while ($i < 3){
			$i++;
			shuffle($statut);
			switch ($i) {
				case 1:
					$statut1 = array_slice($statut, 0, 4);
					break;
				case 2:
					$statut2 = array_slice($statut, 0, 4);
					break;
				case 3:
					$statut3 = array_slice($statut, 0, 4);
					break;
			}
		}

		$data = [
			'comments'		=> $comments,
			'statut1'		=> $statut1,
			'statut2'		=> $statut2,
			'statut3'		=> $statut3,
			'favorite'		=> explode(', ', $favoriteList),
			'slide'			=> $getSlide->find($RealLastSlide),
		];	


		$this->showStuff('front/index', $data);
	}

	/**
	 * Page de connexion
	 */
	public function login()
	{
		$post = [];
		$error = [];

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(empty($post['pseudo']) && empty($post['password'])) {
				$errors[] = 'Veuillez saisir un pseudo et un mot de passe';
			}
			else {
				$connexion = new AuthentificationModel();
				$idConnexion = $connexion->isValidLoginInfo($post['pseudo'], $post['password']);

				if($idConnexion > 0){
					$userModel = new UserModel();
					$user = $userModel->find($idConnexion);

					$connexion->logUserIn($user);
				}
				elseif($idConnexion === 0) {
					$error = 'Erreur d\'identifiant ou de mot de passe';
				}
			}
		}

		if(!empty($this->getUser())){
			$verification = new AuthorizationModel();

			if($verification->isGranted('Admin')) {
				$this->redirectToRoute('back_index');
			}
			elseif ($verification->isGranted('Utilisateur')) {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$data = [
				'error' => $error,
			];
			$this->showStuff('front/login', $data);			
		}
	}

	/**
	 * Page A propos
	 */
	public function about()
	{
		$this->showStuff('front/Pages/aPropos');
	}

	/**
	 * Page CGV
	 */
	public function cgv()
	{
		$this->showStuff('front/Pages/cgv');
	}

	/**
	 * Page A propos
	 */
	public function contact()
	{	
		$post = [];
		$errors = [];
		$success = false;

		if(!empty($_POST)){

			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}

			if(!v::notEmpty()->length(3,20)->validate($post['firstname'])){
				$errors[] = 'Le prénom doit comporter entre 3 et 20 caractères';
			}

			if(!v::notEmpty()->length(3,20)->validate($post['lastname'])){
				$errors[] = 'Le nom doit comporter entre 3 et 20 caractères';
			}

			if(!v::notEmpty()->length(3,null)->validate($post['subject'])){
				$errors[] = 'Le sujet doit comporter au minimum 3 caractères';
			}

			if(!v::notEmpty()->length(10,null)->validate($post['message'])){
				$errors[] = 'Le message doit comporter au minimum 10 caractères';
			}

			if(!v::notEmpty()->email()->validate($post['email'])){
				$errors[] = 'L\'adresse email n\'est pas valide';
			}

			if(count($errors) === 0){
				$insert = new MessageModel;
				
				$dataInsert = [
					'username'		=> $post['firstname'].' '.$post['lastname'],
					'date_creation'	=> date('Y-m-d H:i:s'),
					'subject'		=> $post['subject'],
					'email'			=> $post['email'],
					'content'		=> nl2br($post['message']),
					'statut'		=> 'NonLu',
				];
				
				

				if($insert->insert($dataInsert)){
					$success = true;
				}else{
					$errors[] = 'Erreur lors de l\'envoi de votre message';
				}
			}
		}

		$data = [
			'errors'	=> $errors,
			'success'	=> $success
		];
		$this->showStuff('front/Pages/contact', $data);
	}

	/**
	 * Page A propos
	 */
	public function legalMention()
	{
		$this->showStuff('front/Pages/legalMention');
	}

	/**
	 * Page Events
	 */
	public function events()
	{
		$getEvent = new EventModel();

		$lastEvent = $getEvent->realLastEvent();

		$RealLastEvent = implode('', end($lastEvent));

		$data = [
			'event' => $getEvent->find($RealLastEvent),
		];

		$this->showStuff('front/Event/viewEvent', $data);
	}

	/**
	 * Page équipe
	 */
	public function team()
	{
		$this->showStuff('front/Pages/team');
	}

	/**
	* Permet d'afficher le panier sur toutes les pages
	*/
	public function showBasket()
	{
		// $getBasket = new BasketModel;
		// $user = $this->getUser(); //On récupère l'utilisateur connecté

		// $userCart = $getBasket->getShoppingCartItem($user['id']); //On récupère son panier

		// $data = [
		//  	'items'	=> $userCart,
		// ];

		$this->showStuff('layoutfront');

	}

	public function reloadBasket()
	{
		$this->showStuff('front/reloadBasket');
	}
}