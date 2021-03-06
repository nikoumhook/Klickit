<?php
namespace Model;

use \W\Model\UsersModel;

class EventModel extends \W\Model\Model 
{
	public function findAllEvent($page, $max)
	{
		
		$debut = ($page - 1) * $max;

		$sql = 'SELECT * FROM '.$this->table.' ORDER BY id ASC LIMIT :debut, :max';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':max', $max, \PDO::PARAM_INT);
		$sth->bindValue(':debut', $debut, \PDO::PARAM_INT);
		
		$sth->execute(); 

		return $sth->fetchAll();	
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

	/**
	 * Requête pour sélectionner uniquement les ID de la table
	 */
	public function realLastEvent(){
		$sql = $sql = 'SELECT id FROM '.$this->table.' ORDER BY id ASC';

		$sth = $this->dbh->prepare($sql);

		$sth->execute();

		return $sth->fetchAll();
	}
}