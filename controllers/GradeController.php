<?php
	require 'models/Grade.php';
	require 'models/Level.php';


	class GradeController
	{
		private $model;


		public function __construct()
		{
			$this->model = new Grade;
			$this->level = new level;
		}

		public function index() 
		{
			
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$grades = $this->model->getAll();
			
			$levels=$this->level->getAll();

			require 'views/grade/listGrade.php';
		}

		//muestra la vista de crear
		public function add()
		{
			require 'views/layout.php';
			require 'views/grade/newGrade.php';
			
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newgrade($_REQUEST);			
			header('Location: ?controller=Grade');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getGradeById($id);
				$levels=$this->level->getAll();
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editGrade($_POST);			
				header('Location: ?controller=Grade');				
			} else {
				echo "Error";
			}
		}

			//Realiza el proceso de borrar
		public function delete()
		{
		
			$this->model->deleteGrade($_REQUEST);
			header('Location: ?controller=grade');	
			
		}

		
	}