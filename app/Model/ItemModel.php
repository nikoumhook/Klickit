<?php
namespace Model;

use \W\Model\UsersModel;

class ItemModel extends \W\Model\Model 
{
	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil classique"
	public function listItemClassic($page, $max)
	{
		$debut = ($page - 1) * $max;

		$play = 'SELECT * FROM '.$this->table.' WHERE category = "PlaymobilClassique" LIMIT :debut, :max';

		$classicPlay = $this->dbh->prepare($play);
		$classicPlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$classicPlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$classicPlay->execute();

		return $classicPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Playmobil custom"
	public function listItemCustom($page, $max)
	{
		$debut = ($page - 1) * $max;

		$play2 = 'SELECT * FROM '.$this->table.' WHERE category = "PlaymobilCustom" LIMIT :debut, :max';

		$customPlay = $this->dbh->prepare($play2);
		$customPlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$customPlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$customPlay->execute();

		return $customPlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Pièces Détachées"
	public function listItemPiece($page, $max)
	{
		$debut = ($page - 1) * $max;

		$play3 = 'SELECT * FROM '.$this->table.' WHERE category = "PiecesDetachees" LIMIT :debut, :max';

		$piecePlay = $this->dbh->prepare($play3);
		$piecePlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$piecePlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}

	// Requête pour aller sélectionner tout les articles dans la table "Item" qui ont pour catégorie "Divers"
	public function listItemDivers($page, $max)
	{
		$debut = ($page - 1) * $max;

		$play4 = 'SELECT * FROM '.$this->table.' WHERE category = "Divers" LIMIT :debut, :max';
		$piecePlay = $this->dbh->prepare($play4);

		$piecePlay->bindValue(':max', $max, \PDO::PARAM_INT);
		$piecePlay->bindValue(':debut', $debut, \PDO::PARAM_INT);

		$piecePlay->execute();

		return $piecePlay->fetchAll();
	}

	/** 
	*Méthode pour compter le nombre de résultat 
	* @return le nombre de lignes contenu ds la table
	*/

	public function countResults()
	{
    
    $sql = 'SELECT COUNT(*) as total FROM ' . $this->table;

    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    $result = $sth->fetch();

    return $result['total'];
	}
}