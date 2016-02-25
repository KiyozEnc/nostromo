@ECHO OFF
@echo Installation en cours
sleep 1
cd src/Models
set /P username=Enter your Database username :
powershell -Command "(Get-Content MConnexion.php.model) -replace 'myUser', '%username%' | Out-File -encoding UTF8 MConnexion22.php"
set /P password=Enter your Database password :
powershell -Command "(Get-Content MConnexion22.php) -replace 'myPassword', '%password%' | Out-File -encoding UTF8 MConnexion22.php"
set /P dbname=Enter your Database Name db:
powershell -Command "(Get-Content MConnexion22.php) -replace 'myDbName', '%dbname%' | Out-File -encoding UTF8 MConnexion22.php"
rename MConnexion22.php MConnexion.php 1>nul

sleep 1
@echo Installation complete
cd ..
del install.bat 1>nul
sleep 1