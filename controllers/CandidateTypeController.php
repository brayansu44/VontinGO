<?php
	
	/**
	 * Clase UserController
	 */

	require 'models/CandidateType.php';


	class CandidateTypeController
	{
		private $model;


		public function __construct()
		{
			$this->model = new CandidateType;

		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$CandidateTypes = $this->model->getAll();

			require 'views/candidatetype/listcandidatetype.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';
			require 'views/candidatetype/newCandidateType.php';
			
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newCandidateType($_REQUEST);			
			header('Location: ?controller=CandidateType');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				// require 'views/layout.php';
				// require 'views/candidatetype/editcandidatetype.php';
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editCandidateType($_POST);			
				header('Location: ?controller=CandidateType');				
			} else {
				echo "Error";
			}
		}

		public function updateStatus()
		{
			$user = $this->model->getUserById($_REQUEST['id']);
			$data = [];
			if ($user[0]->status_idfk == 1) {
				
				$data = [
							'id'=> $user[0]->id, 
							'status_idfk' => 2
						];

			}
			elseif ($user[0]->ID_ESTADO_FK == 2) {
			 	 
			 	$data = [
			 				'id'=> $user[0]->id, 
			 				'status_idfk' => 1
			 			];

			} 

			$this->model->editUser($data);
			header('Location: ?controller=user');
			
		}
	}