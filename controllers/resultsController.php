<?php
	
	/**
	 * Clase RolController
	 */

	require 'models/Results.php';
	

	class ResultsController
	{
		private $model;

		public function __construct()
		{
			$this->model = new Results;
			
		}

		public function index() 
		{
			//Llamado al metodo que trae todos los usuarios
			$results = $this->model->getAll();
			require 'views/layout.php';
			require 'views/results/listResults.php';
		}
	}	