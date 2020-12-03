<?php
	 
	/**
	 * Clase CandidacyController
	 */

	require 'models/Candidacy.php';


	class CandidacyController
	{
		private $model;


		public function __construct()
		{
			$this->model = new Candidacy;

		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$candidacies = $this->model->getAll();
			require 'views/candidacy/listCandidacy.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';
			require 'views/candidacy/NewCandidacy.php';
			
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newCandidacy($_REQUEST);			
			header('Location: ?controller=candidacy');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getCandidateTypeById($id);
				require 'views/layout.php';
			} else {
				echo "Error";
			}
		}

		//muestra la vista de editar propuesta
		public function editProposal()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getProposalById($id);
				require 'views/layout.php';
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editCandidacy($_POST);			
				header('Location: ?controller=candidacy');				
			} else {
				echo "Error";
			}
		}
 
		// Realiza el proceso de guardar propuesta
		public function saveProposal()
		{
			$this->model->newProposal($_REQUEST);			
			header('Location: ?controller=candidacy');
		}

		public function getByIdProposal()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
                $data = $this->model->getProposalById($id);
                $candidateP = $this->model->getCandidacyPById($id);
                require 'views/layout.php';
                require 'views/candidacy/showProposal.php';
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function updateProposal()
		{
			if(isset($_POST)) {
				$this->model->editProposal($_POST);			
				header('Location: ?controller=candidacy');				
			} else {
				echo "Error";
			}
		}

		public function deleteProposal()
		{
		
			$this->model->deleteProposal($_REQUEST);
			header('Location: ?controller=candidacy');	
			
		}



	}