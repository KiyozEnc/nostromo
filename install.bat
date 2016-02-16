@ECHO OFF
@echo 'Installation en cours'
sleep 3
rename models\MConnexion.php.model MConnexion.php 1>nul
del install.bat 1>nul