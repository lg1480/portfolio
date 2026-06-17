<?php
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=neta9489_louis_portfolio;charset=utf8','neta9489_louis_portfolio_user','lg1480_lg7850',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Erreur: '.$e->getMessage());
    }
?>