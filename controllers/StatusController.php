<?php
	
	/**
	 * Clase RolController
	 */

	require 'models/Status.php';
	require 'models/TypeStatus.php';
	

	class StatusController
	{
		private $model;
		private $typeStatus;


		public function __construct()
		{
			$this->model = new Status;
			$this->typeStatus = new TypeStatus;
		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$statuses = $this->model->getAll();
			$typeStatuses = $this->typeStatus->getAll();
			require 'views/status/listStatus.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';
			$typeStatuses = $this->typeStatus->getAll();
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newStatus($_REQUEST);			
			header('Location: ?controller=status');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getStatusById($id);
			
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editStatus($_POST);			
				header('Location: ?controller=status');				
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de borrar
		public function delete()
		{			
			$this->model->deleteStatus($_REQUEST);		
			header('Location: ?controller=status');
		}

		public function updateStatus()
		{
			$status = $this->model->getRolById($_REQUEST['id']);
			$data = [];
			if ($rol[0]->status_id == 1) {
				
				$data = [
							'id_rol'=> $rol[0]->id_rol, 
							'status_id' => 2
						];

			}
			elseif ($rol[0]->status_id == 2) {
			 	 
			 	$data = [
			 				'id_rol'=> $rol[0]->id_rol, 
			 				'status_id' => 1
			 			];

			} 

			$this->model->editRol($data);
			header('Location: ?controller=rol');
			
		}
	}