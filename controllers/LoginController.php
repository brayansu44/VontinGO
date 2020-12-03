<?php

	require 'models/Login.php';
	require 'models/user.php';
/**
	 * Clase Controlador Login
	 */
	class LoginController
	{
		private $model;
		private $user;

		public function __construct()
		{
			$this->model = new Login;
			$this->user = new User;
		}
 
		public function index()
		{
			if (isset($_SESSION['user'])) {
				if ($_SESSION['user']->rol === 'Administrador') {
					header('location: ?controller=home');
				}elseif ($_SESSION['user']->rol === 'Docente') {
					header('location: ?controller=user&method=indexTeacher');
				}elseif ($_SESSION['user']->rol === 'Estudiante') {
					$id = $_SESSION['user']->id;
					$StudentStatus = $this->model->getStatusStudent($id);
					// var_dump($StudentStatus[0]->status_idFK);
					// die();
					$status = $StudentStatus[0]->status_idFK;
					if ($status == 5) {
						header('location: ?controller=login&method=logout');
					}else{

					header('location: voting');
					}
				}
			}else{
				require "views/index.php";
			}
		}

		public function indexLogin()
		{
			if (isset($_SESSION['user'])) {
				header('location: ?controller=home');
			}else{
				require "views/login.php";
			}
		}

			

		public function login()
		{
				$validateUser = $this->model->validateUser($_POST);
			if (!isset($_SESSION['user'])) {
				if ($validateUser === true) {
					if ($_SESSION['user']->rol === 'Administrador') {
						header('location: ?controller=home');
					}elseif ($_SESSION['user']->rol === 'Docente') {
						header('location: ?controller=user&method=indexTeacher');
					}elseif ($_SESSION['user']->rol === 'Estudiante') {
						header('location: voting');
					} 
				} else {
					$error = [
						'errorMessage' => $validateUser,
						'document' => $_POST['document']
					];
					require "views/login.php";
				}
			}else{
				header('location: ?controller=login');
			}
			
		}


		public function logout()
		{
			if (isset($_SESSION['user'])) 
				session_destroy();

			header('location: ?controller=login');
		}

			public function logout2()
		{
			if (isset($_SESSION['user'])) 
				if (isset($_REQUEST['id'])) 
				{
					$id = $_REQUEST['id'];
					$data = [
						'name' => $_SESSION['user']->name,
						'lastName' => $_SESSION['user']->last_name,
						'document' => $_SESSION['user']->document,
						'email' => $_SESSION['user']->email
					];
					// var_dump($data);
					// die();
					$dataAll = $this->user->getDataAll($id);
				 	$this->user->studentVoteStatus($id);
				 	$this->user->sendemailVoteCertificate($data,$dataAll);
				}
				session_destroy();

			header('location: ?controller=login');
		}
		
	}