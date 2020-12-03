<?php
	
	/**
	 * Clase WDayController
	 */

	require 'models/WDay.php';


	class WDayController
	{
		private $model;


		public function __construct()
		{
			$this->model = new WDay;

		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$working_day = $this->model->getAll();

			require 'views/wday/listWDay.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';
			require 'views/wday/newWDay.php';
			
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newWDay($_REQUEST);			
			header('Location: ?controller=WDay');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getWDayById($id);
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editWDay($_POST);			
				header('Location: ?controller=WDay');				
			} else {
				echo "Error";
			}
		}

		public function delete()
		{
		
			$this->model->deleteWday($_REQUEST);
			header('Location: ?controller=wday');	
			
		}

		
	}