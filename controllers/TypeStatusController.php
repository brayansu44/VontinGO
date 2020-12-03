<?php
	
	/**
	 * Clase RolController
	 */

	require 'models/TypeStatus.php';
	

	class TypeStatusController
	{
		private $model;
		private $typeStatus;
	

		public function __construct()
		{
			$this->model = new TypeStatus;
			
		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$typeStatuses = $this->model->getAll();
			require 'views/typeStatus/listTypeStatus.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';

		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newStatus($_REQUEST);			
			header('Location: ?controller=typeStatus');
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
				header('Location: ?controller=typeStatus');				
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de borrar
		public function delete()
		{			
			$this->model->deleteStatus($_REQUEST);		
			header('Location: ?controller=typeStatus');
		}

		
	}