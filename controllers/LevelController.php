<?php

	require 'models/Level.php';
	require 'models/grade.php';


	class LevelController
	{
		private $model;


		public function __construct()
		{
			$this->model = new Level;
			$this->grade = new grade;
		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$levels = $this->model->getAll();

			require 'views/level/listLevel.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			$grades=$this->grade->getAll();
			require 'views/layout.php';
			require 'views/level/newLevel.php';
			
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newLevel($_REQUEST);			
			header('Location: ?controller=level');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getLevelById($id);
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editLevel($_POST);			
				header('Location: ?controller=level');				
			} else {
				echo "Error";
			}
		}

			//Realiza el proceso de borrar
		public function delete()
		{
		
			$this->model->deleteLevel($_REQUEST);
			header('Location: ?controller=level');	
			
		}

		
	}