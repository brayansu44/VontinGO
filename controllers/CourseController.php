<?php

    require 'models/Course.php';
    require 'models/Grade.php';
	require 'models/WDay.php';
	require 'models/Status.php';
	require 'models/User.php';


	class CourseController
	{
		private $model;


		public function __construct()
		{
            $this->model = new Course;
            $this->grade = new grade;
			$this->WDay = new WDay;
			$this->Status = new Status;
			$this->User = new User;

		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
            $courses = $this->model->getAll();
            $grades=$this->grade->getAll();
			$wdays=$this->WDay->getAll();
			$statuses=$this->Status->getAll();
			$users=$this->User->getAllTeacher();

			require 'views/course/showCourse.php';
		}
		public function indexTwo() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
            $courses = $this->model->getAllTwo();
            $grades=$this->grade->getAll();
			$wdays=$this->WDay->getAll();
			$statuses=$this->Status->getAll();
			$users=$this->User->getAllTeacher();

			require 'views/course/listCourse.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';
			require 'views/course/newCourse.php';
			
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newCourse($_REQUEST);			
			header('Location: ?controller=Course');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
                $data = $this->model->getCourseById($id);
                $grades=$this->grade->getAll();
				$wdays=$this->WDay->getAll();
				$Statuses=$this->status->getAll();
				$users=$this->user->getAllTeacher();
			} else {
				echo "Error";
			}
		}

		//muestra la vista de editar
		public function getByIdCourseEs()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
                $datat = $this->model->getCourseJourById($id);
                $data = $this->model->getCourseStudentsById($id);
                require 'views/layout.php';
                require 'views/course/listEstudents.php';
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editCourse($_POST);			
				header('Location: ?controller=Course');				
			} else {
				echo "Error";
			}
		}
	}