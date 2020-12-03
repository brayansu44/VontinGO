<?php
	
	/**
	 * Clase UserController
	 */ 

	require 'models/User.php';
	require 'models/Role.php';
	require 'models/Course.php';
	require 'models/CandidateType.php';
	require 'models/Candidacy.php';
	require 'models/StudentListing.php';


	class UserController
	{
		private $model;
		private $role;
		private $course;
		private $cType;
		private $sList;

		public function __construct()
		{
			$this->model = new User;
			$this->role = new Role;
			$this->course = new Course;
			$this->cType = new CandidateType;
			$this->sList = new StudentListing;

		}

		public function indexAdmin() 
		{ 
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$users = $this->model->getAllAdmin();
			$roles = $this->role->getAll();

			require 'views/user/listAdmin.php';
		}
		public function viewPorfile() 
		{ 
			require 'views/layout.php';
			require 'views/user/infoUser.php';
		}

		// Realiza el proceso de actualizar
		public function updateProfile()
		{
			if(isset($_POST)) {
				$this->model->editProfile($_POST);			
				header('Location: ?controller=login&method=logout');				
			} else {
				echo "Error";
			}
		}
		public function indexTeacher() 
		{ 
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$users = $this->model->getAllTeacher();
			$roles = $this->role->getAll();

			require 'views/user/listTeacher.php';
		}
		public function indexStudent() 
		{ 
			require 'views/layout.php';
			//Llamado al metodo que trae todos los usuarios
			$users = $this->model->getAllStudent();
			$roles = $this->role->getAll();
			$courses = $this->course->getAll();
			$cTypes = $this->cType->getAll();
			$sLists = $this->sList->GetAll();
			require 'views/user/listStudent.php';
		}

		//muestra la vista de crear
		public function add() 
		{
			require 'views/layout.php';			
		}

		// Realiza el proceso de guardar
		public function saveTeacher()
		{
			$nombre = $_POST['name'];
        	$enviar = $this->model->sendemail();
			$user = [
						$_POST['name'],
						$_POST['last_name'],
						$_POST['document'],
						$_POST['cellphone'],
						$_POST['email'],
						$enviar 
					];
			$correo = $_POST['email'];		
			$this->model->newUser($user);
			$role = 2;			
			$lastIduser = $this->model->getLastId();
			// var_dump($lastIdTeacher);
			// die();
			$this->model->newRole($role,$lastIduser);
			header('Location: ?controller=user&method=indexTeacher');
			
		} 

		public function saveStudent()
		{
			
			try {
				$nombre = $_POST['name'];
        		$enviar = $this->model->sendemail();
				$user = [
						$_POST['name'],
						$_POST['last_name'],
						$_POST['document'],
						$_POST['cellphone'],
						$_POST['email'],
						$enviar
					];
				$correo = $_POST['email'];
				$courseStudent = $_POST['course_idfk'];
				$this->model->newUser($user);
				$role = 3;
				$lastIduser = $this->model->getLastId();
				$this->model->newRole($role,$lastIduser);
				$this->model->saveStudentList($lastIduser,$courseStudent);
				header('Location: ?controller=user&method=indexStudent');
				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
			
		}

		public function getByStudentListId()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getUserStudenListById($id);
			} else {
				echo "Error";
			}
		}
 

		//muestra la vista de editar
		public function edit()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getUserById($id);
				
			} else {
				echo "Error";
			}
		}

		//muestra la vista de editar 
		public function roleUser()
		{
			if(isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				$data = $this->model->getUserRoleById($id);
				
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de Asignar rol admin a un docente
		public function AdminRoleee()
		{
			$nombre = $_POST['name'];
        	$enviar = $this->model->sendemailAdminRole();
			$usurol = [
						$_POST['user_idfk'],
						$enviar
					];
			$correo = $_POST['email'];
			$this->model->newAdminRole($usurol);			
			header('Location: ?controller=user&method=indexAdmin');
		}
 

		public function CandidacyStudent()
		{	

			try {
				$nombre = $_POST['name'];
        		$enviar = $this->model->sendemailAdminCandidacy();
				$candidacyS = [
					$_POST['candidatetype_idfk'],
					$_POST['studentlist_idfk'],
					$enviar
				];
				$correo = $_POST['email'];
				$lastIdUser = $_POST['user_idfk'];
				$this->model->newStudentCandidacy($candidacyS);
				$role = 4;
				$this->model->newRole($role,$lastIdUser);
				$lastIdCandidacy = $this->model->getLastCandidacyId();
				$this->model->newCandidacyScrutinie($lastIdCandidacy);
				header('Location: ?controller=user&method=indexStudent');
				} catch(PDOException $e) {
					die($e->getMessage());
				}
		}



		// Realiza el proceso de actualizar
		public function updateAdmin()
		{
			if(isset($_POST)) {
				$this->model->editUser($_POST);			
				header('Location: ?controller=user&method=indexAdmin');				
			} else {
				echo "Error";
			}
		}
 
		// Realiza el proceso de actualizar
		public function updateTeacher()
		{
			if(isset($_POST)) {
				$this->model->editTeacher($_POST);			
				header('Location: ?controller=user&method=indexTeacher');				
			} else {
				echo "Error";
			}
		}

		// Realiza el proceso de actualizar
		public function updateStudent()
		{
			if(isset($_POST)) {
				$courseStudent = [
					$_POST['id'],
					$_POST['name'],
					$_POST['last_name'],
					$_POST['document'],
					$_POST['cellphone'],
					$_POST['email']
				];
				$this->model->editStudentUser($courseStudent);
				$user=$_POST['id'];
				$editStudentCourse = $_POST['course_idfk'];
				$this->model->editStudentCourse($editStudentCourse,$user);			
				header('Location: ?controller=user&method=indexStudent');				
			} else {
				echo "Error";
			}
		}




		public function updateStatus()
	{
		$users = $this->model->getUserById($_REQUEST['id']);
		$data = [];
		if ($users[0]->status_idfk == 1) {
		$data = ['id' => $users[0]->id, 'status_idfk' => 2];
		
		}elseif($users[0]->status_idfk == 2) {
			$data = ['id' => $users[0]->id, 'status_idfk' => 1];
		}
			$this->model->editUserStatus($data);	
		header('Location: ?controller=user&method=indexTeacher');
	}

		public function saveRole()
		{
			$this->model->newUserRole($_REQUEST);
			$roles = $this->role->getAll();			
			echo json_encode($roles);
        	return;
		}

    // Reset password
   	public function resetpassword()
   	{
        $OldPasword=$_SESSION['user']->password;
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        if ($OldPasword == $currentPassword) {
            $this->model->updatepassword($newPassword);
            header('Location: ?controller=login&method=logout');
        }else{
            echo "La contraseña no coincide";
        }
    }
}
