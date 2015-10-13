<?php

require_once 'main.php';

class Article extends Main {

	public function getArticle($numArt)
	{
		try
		{
			return $this->getBdd()->prepare()->execute()->fetch();
		}
		catch (PDOException $e)
		{
			$error = "L'article $numArt n'existe pas.";
			return false;
		}
	}

	public function getArticles()
	{
		try
		{
			return $this->getBdd()->prepare()->execute();
		}
		catch (PDOException $e)
		{
			$error = "Il y a aucun article pour le moment.";
			return false;
		}
	}
}
