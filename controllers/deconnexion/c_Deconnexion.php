<?php
unset($_SESSION);
session_destroy();
session_start();
$_SESSION['valid'] = 'Déconnecté avec succès';
header("Location:?uc=index");
