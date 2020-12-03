<?php
	
	/**
	 * Clase UserController
	 */

	require 'models/voting.php';



	class VotingController
	{
		private $model;



		public function __construct()
		{
			$this->model = new Voting;

		}

		public function elections()
		{
			//Llamado al metodo que trae todos los usuarios
			$candidacies = $this->model->getAll();
			require 'views/voting/voting.php';	
		}



		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->VoteRegister($_POST);			
				header('Location: ?controller=voting&method=elections');				
			} else {
				echo "Error";
			}
		}


	}	