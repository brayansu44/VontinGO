<?php
require_once ("../models/voting.php");

	$curso = new Voting();

	$curso->votar($_POST['id_nav']);
	echo $_POST['id_nav'];
?>	