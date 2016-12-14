<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SlideModel;
use \W\Security\AuthorizationModel;
use \W\Security\AuthentificationModel;
use \Respect\Validation\Validator as v;
use \Intervention\Image\ImageManagerStatic as Image;

class SlideController extends Controller 
{
	/**
	 * Liste des Slides
	 */
	public function listSlide()
	{
		$list = new SlideModel();
		$slide = $list->findAll();

		$data = [
			'slide'	=> $slide,
		];

		if(!empty($_SESSION)){

			$this->show('back/Slide/listSlide', $data);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
	}

	/**
	 * Ajout de Slide
	 */
	public function addSlide()
	{

		$post = [];
		$errors = [];
		$insert = new SlideModel();
		$success = false;

		$folderUpload = getApp()->getConfig('upload_dir_slide'); 
		$fullFolderUpload = $_SERVER['DOCUMENT_ROOT'].$_SERVER['W_BASE'].'/assets'.$folderUpload;

		if(!empty($_POST)){
			$post = array_map('trim', array_map('strip_tags', $_POST));

			if(!v::notEmpty()->length(3,50)->validate($post['title'])){
				$errors[] = 'Le titre du slide doit comporter plus de 3 caractères';
			}

			if(!v::image()->validate($_FILES['picture']['tmp_name'])){
				$errors[] = 'L\'image envoyé n\'est pas une image valide';
			}

			if(!v::size(null, '2MB')->validate($_FILES['picture']['tmp_name'])){
				$errors[] = 'La taille de votre image doit être inférieur à 2MB';
			}

			if(!v::uploaded()->validate($_FILES['picture']['tmp_name'])){
				$errors[] = 'Une erreur est survenue lors de l\'upload de l\'image';
			}

			if(!v::notEmpty()->url()->validate($post['link'])){
				$errors[] = 'L\'url du slide n\'est pas valide';
			}

			if(count($errors) === 0){
				$img = Image::make($_FILES['picture']['tmp_name']);

				switch($img->mime()){
					case 'image/jpg':
					case 'image/jpeg':
						$extension = '.jpg';
					break;
					case 'image/png':
						$extension = '.png';
					break;
					case 'image/gif':
						$extension = '.gif';
					break;
				}

				$imgName = uniqid('slide_').$extension;
				$img->save($fullFolderUpload.$imgName);

				$dataInsert = [
					'title'   => $post['title'],
					'picture' => $imgName,
					'link'	  => $post['link'],
				];

				if($insert->insert($dataInsert)){
					$success = true;
				}
				else {
					$errors[] = 'Erreur lors de l\'ajout en base de données';
				}
			}
		}

		$params = [
			'success'	=> $success,
			'errors'	=> $errors
		];

		if(!empty($_SESSION)){

			$this->show('back/Slide/addSlide', $params);

			if($_SESSION['role'] == 'Utilisateur') {
				$this->redirectToRoute('front_index');
			}
		}
		else {
			$this->redirectToRoute('back_login');
		}
	}
	

	/**
	 * Mise à jour de Slide
	 */
	public function updateSlide()
	{
		$this->show('back/Slide/updateSlide');
	}
}