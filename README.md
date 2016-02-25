# Nostromo BETA 1.1
### Vol dans l'espace
Pour utiliser le code source de notre projet Nostromo, il vous faut créer votre fichier de configuration pour la base de données qui se situe dans 'models' :
 
#### Installation facile :
 - Exécuter install.bat sous Windows
 - Suivez les étapes 2 et 3 de l'installation normale

#### Installation normale : 
 - Renommez MConnexion.php.model en MConnexion.php
 - Changez les valeurs des variables $user, $password du fichier MConnexion.php correspondant aux informations de votre base de données
 - Implémenter notre script SQL 'Nostromo_BDD.sql' dans votre base de données

#### Initialiser composer :
 - Pour terminer l'installation, il vous faut [composer].
 - Exécuter la commande : php /path/to/composer.phar update au sein du projet nostromo

/path/to/composer.phar fait référence au chemin jusqu'à composer.phar
 
 
[composer]: https://getcomposer.org/download/