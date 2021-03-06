<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Security\AuthentificationModel;
use \Model\ResetModel;
use \Model\UserModel;
use \PHPMailer;

class ResetController extends Controller
{
	
	public function reset_pwd($id_token, $token)
	{	

		if(isset($id_token) && !empty($id_token) && isset($token) && !empty($token)){

			$verify = new ResetModel;
			$getInfos = $verify->findByIdToken($id_token);
			
			/**
			 *
			Vérification de la validité du token (pas sûr encore donc mis en commmentaire)
			$date2days = date($getInfos['date_expire'], strtotime("+2 days"));

			if($getInfos['date_expire'] == $date2days){
				$error = 'Le jeton a expiré. Pour réinitialiser le mot de passe, veuillez cliquer <a href="'.$this->generateUrl('back_forgot_pwd').'">ici</a>';
			}
			*
			*/

			if($token != $getInfos['token']){
				$error = 'Le jeton est invalide. Veuillez cliquer <a href="'.$this->generateUrl('back_forgot_pwd').'">ici</a> pour relancer la procédure de réinitialisation de votre mot de passe';
			}else{
				//Insertion du nouveau mot de passe
				$update = new UserModel;
				$post = [];
				$hash = new AuthentificationModel;
				$success = false;
				$error = '';	

				if(!empty($_POST)){
					
					foreach($_POST as $key => $value){
						$post[$key] =trim(strip_tags($value));	
					}

					if(strlen($post['password']) < 8 || strlen($post['password']) > 20){
						$error = 'Votre mot de passe doit comporter entre 8 et 20 caractères';
					}

					if(empty($error)){	
						$newPassword = $hash->hashPassword($post['password']);

						if($update->updateByMail($newPassword, $getInfos['email'])){
							$success = true;
						}
						else{
							$error = 'Erreur lors de la mise à jour du mot de passe';
						}
					}

				}
			}

			
			$data = ['success'=>$success, 'error'=>$error];
			$this->show('back/reset_password',$data);

		}		
		
	}

}