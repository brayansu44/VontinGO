<?php
	
	/**
	 * Clase RolController
	 */

	require 'models/Role.php';
	require 'models/Status.php';

	class RoleController
	{
		private $model;
		private $status;

		public function __construct()
		{
			$this->model = new Role;
			
		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$roles = $this->model->getAll();
			require 'views/role/listRole.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';
			
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newRole($_REQUEST);			
			header('Location: ?controller=role');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getRoleById($id);
			
			
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editRole($_POST);			
				header('Location: ?controller=role');				
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de borrar
		public function delete()
		{			
			$this->model->deleteRole($_REQUEST);		
			header('Location: ?controller=role');
		}

		public function updateStatus()
		{
			$rol = $this->model->getRoleById($_REQUEST['id']);
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