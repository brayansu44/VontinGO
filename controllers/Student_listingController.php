<?php
	
	/**
	 * Clase Student_listingController
	 */

	require 'models/Student_listing.php';
	require 'models/User.php';
	require 'models/Course.php';



	class Student_listingController
	{
		private $model;


		public function __construct()
		{
			$this->model = new Student_listing;
			$this->User = new User;
			$this->Course = new Course;

		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$students = $this->model->getAll();
			$users=$this->User->getAll();
			$courses=$this->Course->getAll();

			require 'views/student_listing/listStudent_listing.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';
			
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newStudent_listing($_REQUEST);			
			header('Location: ?controller=student_listing');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editStudent_listing($_POST);			
				header('Location: ?controller=student_listing');			
			} else {
				echo "Error";
			}
		}

			//Realiza el proceso de borrar
		public function delete()
		{
		
			$this->model->deleteStudent_listing($_REQUEST);
			header('Location: ?controller=student_listing');	
			
		}
	}	