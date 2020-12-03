<?php
	
	/**
	 * Clase RolController
	 */

	require 'models/Rol.php';
	

	class RolController
	{
		private $model;
		private $status;

		public function __construct()
		{
			$this->model = new Rol;
			
		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$roles = $this->model->getAll();
			require 'views/rol/listRol.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';
			require 'views/rol/newRol.php';
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newRol($_REQUEST);			
			header('Location: ?controller=rol');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getRolById($id);
				require 'views/layout.php';
				require 'views/rol/editRol.php';
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editRol($_POST);			
				header('Location: ?controller=rol');				
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de borrar
		public function delete()
		{			
			$this->model->deleteRol($_REQUEST);		
			header('Location: ?controller=rol');
		}

		public function updateStatus()
		{
			$rol = $this->model->getRolById($_REQUEST['id']);
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