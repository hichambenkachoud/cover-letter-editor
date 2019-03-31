<?php

/*
*Classe représante un DBFactory
*/

	class DBFactory
	{
		public static function getMySqlConnexionWithPDO()
		{		
			$db = new PDO('mysql:host=localhost;dbname=lettre_motivation','root','');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->exec('SET NAMES utf8');

			session_start();
			return $db;

			
		}
	}	
?>