<?php
	
	/**
	 * Clase RolController
	 */

	require 'models/Proposal.php';
	

	class ProposalController
	{
		private $model;

		public function __construct()
		{
			$this->model = new Proposal;
			
		}

		public function index() 
		{
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$proposals = $this->model->getAll();
			require 'views/candidacy/listCandidacy.php';
		}

		// public function proposalCandidacy() 
		// {
		// 	// require 'views/layout.php';
		// 	// //Llamado al metodo que trae todos los usuarios
		// 	// $proposals = $this->model->getAllProposalCandidacy();

		// 	// require 'views/candidacy/showProposal.php';
		// 	if(isset($_REQUEST['id'])) {
		// 		$id = $_REQUEST['id'];
		// 		$data = $this->model->getAllProposalCandidacy($id);
		// 		require 'views/layout.php';
		// 		require 'views/candidacy/showProposal.php';
		// 	} else {
		// 		echo "Error";
		// 	}
		// }

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';
			require 'views/candidacy/newProposal.php';
		}

		// Realiza el proceso de guardar
		public function save()
		{
			$this->model->newProposal($_REQUEST);			
			header('Location: ?controller=Proposal');
		}

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getProposalById($id);
				require 'views/layout.php';
				require 'views/Proposal/editProposal.php';
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function update()
		{
			if(isset($_POST)) {
				$this->model->editProposal($_POST);			
				header('Location: ?controller=Proposal');				
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de borrar
		public function delete()
		{			
			$this->model->deleteProposal($_REQUEST);		
			header('Location: ?controller=rol');
		}

	}