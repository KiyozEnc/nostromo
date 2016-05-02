# Site web pour nostromo PPE
### Vol dans l'espace
Pour utiliser le code source de notre projet Nostromo, il vous faut suivre les instructions suivantes :

#### Installation :
 - Exécuter install.bat sous Windows
 - Indiquer les informations demandées
 - Implémenter notre script SQL 'Nostromo_BDD.sql' dans votre base de données liée aux informations indiquées ultérieurement
 - Changer l'encodage du fichier src/Models/MConnexion.php en UTF8 SANS BOM sans quoi vous obtiendrez une erreur de namespace sur n'importe quelle page
 - Initialiser Composer
 
#### Initialiser Composer :
 - Pour terminer l'installation, il vous faut [composer].
 - Exécuter la commande : php /path/to/composer.phar update --no-dev au sein du projet nostromo

/path/to/composer.phar fait référence au chemin jusqu'au fichier composer.phar précédemment récupéré grâce à l'installation de [composer]

[composer]: https://getcomposer.org/download/

#### Documentations

Les documentations sont disponibles dans le dossier docs
