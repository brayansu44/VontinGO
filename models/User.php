<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

	 
	/**
	 * Modelo de la Tabla users
	 */
	class User
	{
		private $id;
		private $name; 
		private $last_name;
		private $document;
		private $password;
		private $cellphone;
		private $email;
		private $status_idfk;
		private $pdo;
		
		public function __construct()
		{
			try {
				$this->pdo = new Database;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function getAllAdmin()
		{
			try {
				$strSql = "SELECT u.* ,s.status_name FROM users u
							INNER JOIN usurol ur ON ur.user_idfk=u.id
							INNER JOIN roles r ON r.id=ur.role_idfk
							inner join statuses s on s.id=u.status_idfk
							WHERE r.role_name='Administrador'";
				

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function getAllTeacher()
		{
			try {
				$strSql = "SELECT u.*, s.status_name,r.role_name, ur.role_idfk FROM users u
							INNER JOIN usurol ur ON ur.user_idfk=u.id
							INNER JOIN roles r ON r.id=ur.role_idfk
							inner join statuses s on s.id=u.status_idfk
							WHERE r.role_name='Docente' or r.role_name='Administrador'
                            GROUP BY u.id;";
				

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function getAllStudent()
		{
			try {
				$strSql = "
				SELECT u.*, COUNT(ur.role_idfk) as role_name,c.code,sl.id as idsl,sl.course_idfk, s.status_name FROM users u 
					INNER JOIN usurol ur ON ur.user_idfk=u.id 
					INNER JOIN roles r ON r.id=ur.role_idfk 
					inner join statuses s on s.id=u.status_idfk 
					INNER JOIN student_listing sl ON u.id = sl.user_idfk 
					INNER JOIN courses c ON c.id = sl.course_idfk 
					WHERE r.role_name='Candidatura' or role_name='Estudiante' GROUP BY u.name, u.last_name";
				

				//Llamado al metodo general que ejecuta un select a la BD
				$query = $this->pdo->select($strSql);
				//retorna el objeto del query
				return $query;
			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function newUser($user)
		{
			try {
				$data['name'] = $user[0];
				$data['last_name'] = $user[1];
				$data['document'] = $user[2];
				$data['cellphone'] = $user[3];
				$data['email'] = $user[4];
				$data['password'] = $user[5];
				$data['status_idfk'] = 1;
				
				$this->pdo->insert('users', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function saveStudentList($lastIduser,$courseStudent)
		{
			try {
				$data['user_idfk'] = $lastIduser;
				$data['course_idfk'] = $courseStudent;
				$data['status_idfk'] = 6;
				
				$this->pdo->insert('student_listing', $data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}



		public function getLastId()

		{
			try {
				$strSql = "SELECT MAX(id) as id FROM users";
				$query = $this->pdo->select($strSql);
				return $query[0]->id;

			} catch (PDOException $e) {
				return($e->getMessage());
			}
		}
		public function getLastCandidacyId()

		{
			try {
				$strSql = "SELECT MAX(id) as id FROM candidacies";
				$query = $this->pdo->select($strSql);
				return $query[0]->id;

			} catch (PDOException $e) {
				return($e->getMessage());
			}
		}

		public function newRole($role,$lastIduser)
		{
			try {
				$data['user_idfk'] = $lastIduser;
				$data['role_idfk'] = $role;
				$this->pdo->insert('usurol', $data);
				var_dump($data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function newCandidacyScrutinie($lastIdCandidacy)
		{
			try {
				$data['candidacy_idfk'] = $lastIdCandidacy;
				$data['number_votes'] = 0;
				$this->pdo->insert('scrutinies', $data);
				var_dump($data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}


		public function getUserById($id)
		{
			try {
				$strSql = "SELECT * FROM users u 
							WHERE u.id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function getUserStudenListById($id)
		{
			try {
				$strSql = "SELECT sl.* FROM student_listing sl  
				WHERE sl.id =:id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function newStudentCandidacy($candidacyS)
		{
			try {
				$data['candidatetype_idfk'] = $candidacyS[0];
				$data['studentlist_idfk'] = $candidacyS[1];
				$data['id_statusfk'] = 1;
				$this->pdo->insert('candidacies', $data);
				var_dump($data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}


		public function getUserRoleById($id)
		{
			try { 
				$strSql = "SELECT u.* FROM users u 
							INNER JOIN usurol ur ON ur.user_idfk = u.id
							INNER JOIN roles r ON r.id = ur.role_idfk
							WHERE u.id = :id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}
		public function newAdminRole($usurol)
		{
			try {
				$data['user_idfk'] = $usurol[0];
				$data['role_idfk'] = 1;
				$this->pdo->insert('usurol', $data);
				var_dump($data);				
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function editProfile($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('users', $data, $strWhere);		
				return $data;		
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function editTeacher($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('users', $data, $strWhere);		
				return $data;		
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function editUserStatus($data)
		{
			try {
				$strWhere = 'id = '. $data['id'];
				$this->pdo->update('users', $data, $strWhere);		
				return $data;		
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function editStudentUser($courseStudent)
		{
			try {
				$data['id'] = $courseStudent[0];
				$data['name'] = $courseStudent[1];
				$data['last_name'] = $courseStudent[2];
				$data['document'] = $courseStudent[3];
				$data['cellphone'] = $courseStudent[4];
				$data['email'] = $courseStudent[5];
				$strWhere = 'id = '. $courseStudent[0];
				$this->pdo->update('users', $data, $strWhere);		
				return $data;		
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		public function editStudentCourse($editStudentCourse,$user)
		{
			try {
				$data['course_idfk'] = $editStudentCourse;
				$strWhere = 'user_idfk = '. $user;
				$this->pdo->update('student_listing', $data, $strWhere);	
				return $data;		
			} catch(PDOException $e) {
				die($e->getMessage());
			}		
		}

		//obtener listado de roles de un usuario
		public function getRoleUserById($id)
		{
			try {
				$strSql = "SELECT CONCAT(u.name,u.last_name) AS Usuario, r.role_name FROM  		usurol ur
							INNER JOIN users u ON u.id = ur.user_idfk
							INNER JOIN roles r ON r.id = ur.role_idfk
							WHERE u.id=:id";
				$arrayData = ['id' => $id];
				$query = $this->pdo->select($strSql, $arrayData);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function studentVoteStatus($id)
		{
			try {
				$data['status_idFK'] = 5;
				$strWhere = 'user_idfk = '. $id;
				$this->pdo->update('student_listing', $data, $strWhere);

			} catch(PDOException $e) {
				die($e->getMessage());
			}
		}

		public function getDataAll($id)
		{
			try {
				$strSql = "SELECT sl.user_idfk, c.code, w.wday_name, g.grade_name  FROM users u
							INNER JOIN student_listing sl ON u.id = sl.user_idfk
							INNER JOIN courses c ON sl.course_idfk = c.id
							INNER JOIN grades g on g.id = c.grade_idfk
							INNER JOIN working_day w ON w.id = c.wday_idfk 
							WHERE u.id=$id";
				$query = $this->pdo->select($strSql);
				return $query; 
			} catch(PDOException $e) {
				die($e->getMessage());
			}	
		}

		public function sendemail(){
        try{
    $mail = new PHPMailer(true);

    $nombre = $_POST['name'];
    $correo = $_POST['email']; 
    $longitud = 8; 
    $pass = substr(md5(rand()),0,$longitud);


    try{
       $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'Gabosvel2003@gmail.com';                     // SMTP username
    $mail->Password   = 'gabrielvelandia2003';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('Gabosvel2003@gmail.com', 'SI VOTINGO');
    $mail->addAddress($correo, $nombre);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'VERIFICACION DE CUENTA DE USUARIO SI VOTINGO';
    $mail->Body    = '<!DOCTYPE html>
	<html>

	<head>
	    <meta charset="UTF-8">
	    <meta content="width=device-width, initial-scale=1" name="viewport">
	</head>

	<body>
	    <div class="">

	        <table style="width: 100%; background-color: transparent;">
	            <tbody>
	                <tr>
	                    <td>
	                        <table style="text-align: center; background-color: transparent; margin: auto;">
	                            <tbody>
	                                <tr>
	                                    <td>
	                                        <table style="background-color: transparent; width: 700px; border-collapse: collapse; text-align: center;">
	                                            <tbody>
	                                                <tr>
	                                                    <td style="border-radius: 30px 30px 0px 0px; background-color: #efefef; height: 300px;">
	                                                        <table style="background-color: transparent;">
	                                                            <tbody>
	                                                             <tr>
	                                                              <td style="width: 700px; text-align: center;">
	                                                                <table style="background-size: 100%; background-position: left top; background-color: transparent; margin: auto;">
	                                                                     <tbody>
	                                                                      <tr>
	                                                                        <td style="text-align: center; color: #e84c3d;">
	                                                              <h1>SI VOTING GO - VERIFICACIÓN DE CUENTA</h1>
	                                                               </td>
	                                                               </tr>
	                                                               <tr>
	                                                              <td style="text-align: center; margin: auto;">
	                                                                    <img src="https://i.postimg.cc/KYvqhxXd/logoo.png">
	                                                                         <h2 style="font-size: 35px; font-weight: 900; color: #1624a1">Te damos la Bienvenida: 
	                                                                      <span style="color: #e84c3d; font-style: italic;">'.$nombre.'</span>¡</h2>
	                                                                                    </td>
	                                                                                </tr>
	                                                                            </tbody>
	                                                                        </table>
	                                                                    </td>
	                                                                </tr>
	                                                            </tbody>
	                                                        </table>
	                                                    </td>
	                                                </tr>
	                                                <tr>
	                                                    <td style="background-image:url(https://i.postimg.cc/JhB6KKjF/sine-Image.jpg);background-position: center top; background-color: #fff; background-repeat: no-repeat; padding-right: 80px; padding-left: 80px; padding-bottom: 125px;">
	                                                        <table style="background-color: #e84c3d; width: 100%; border-radius: 25px; margin: auto;">
	                                                            <tbody>
	                                                                <tr>
	                                                                    <td>
	                                                                        <table style=" padding: 5%;">
	                                                                            <tbody style="color: #fff; text-align: justify;">
	                                                                                <tr>
	                                                                                    <td>
	                                       			   <p style="font-size: 23px; color: #fff">Hola!</p>
	                                                                                    </td>
	                                                                                </tr>
	                                                                                <tr>
	                                                                                    <td>
	                                                    <p style="font-size: 20px; color: #fff">Estamos encantados de que haya completado su registro.</p>
	                                                       <p style="font-size: 18px; color: #fff">Gracias por unirse a Voting GO¡ hemos generado una contraseña "<span style="font-style: italic; font-weight: 900;">'.$pass.'</span>" puedes cambiarla en un rato :D.</p>
	                                                        <p style="font-size: 12px; color: #fff">Feliz dia - El equipo de Voting GO¡</p>
	                                                                                    </td>
	                                                                                </tr>
	                                                                            </tbody>
	                                                                        </table>
	                                                                    </td>

	                                                                </tr>
	                                                            </tbody>
	                                                        </table>
	                                                    </td>
	                                                </tr>
	                                                
	                                            </tbody>
	                                        </table>
	                                    </td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </td>
	                </tr>
	            </tbody>
	        </table>
	    </div>
	</body>

	</html>';
		 $mail->send();
return $pass;

    }catch(Exeption $e){
          return false;
          die($e->getMessage());
    }   
    
        }catch(Exception $e){
            return false;
            die($e->getMessage());
        }
    }

    //COREO nOTIFICa ADMIN A DOCENTE
    public function sendemailAdminRole(){
        try{
    $mail = new PHPMailer(true);

    $nombre = $_POST['name'];
    $correo = $_POST['email']; 


    try{
       $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'Gabosvel2003@gmail.com';                     // SMTP username
    $mail->Password   = 'gabrielvelandia2003';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('Gabosvel2003@gmail.com', 'SI VOTINGO');
    $mail->addAddress($correo, $nombre);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'CAMBIO DE ROL';
    $mail->Body    = '<!DOCTYPE html>
	<html>

	<head>
	    <meta charset="UTF-8">
	    <meta content="width=device-width, initial-scale=1" name="viewport">
	</head>

	<body>
	    <div class="">

	        <table style="width: 100%; background-color: transparent;">
	            <tbody>
	                <tr>
	                    <td>
	                        <table style="text-align: center; background-color: transparent; margin: auto;">
	                            <tbody>
	                                <tr>
	                                    <td>
	                                        <table style="background-color: transparent; width: 700px; border-collapse: collapse; text-align: center;">
	                                            <tbody>
	                                                <tr>
	                                                    <td style="border-radius: 30px 30px 0px 0px; background-color: #efefef; height: 300px;">
	                                                        <table style="background-color: transparent;">
	                                                            <tbody>
	                                                             <tr>
	                                                              <td style="width: 700px; text-align: center;">
	                                                                <table style="background-size: 100%; background-position: left top; background-color: transparent; margin: auto;">
	                                                                     <tbody>
	                                                                      <tr>
	                                                                        <td style="text-align: center; color: #e84c3d;">
	                                                              <h1>CAMBIO DE ROL DOCENTE - ADMINISTRADOR</h1>
	                                                               </td>
	                                                               </tr>
	                                                               <tr>
	                                                              <td style="text-align: center; margin: auto;">
	                                                                    <img src="https://i.postimg.cc/KYvqhxXd/logoo.png">
	                                                                         <h2 style="font-size: 35px; font-weight: 900; color: #1624a1">Buen Dia: 
	                                                                      <span style="color: #e84c3d; font-style: italic;">'.$nombre.'</span>¡</h2>
	                                                                                    </td>
	                                                                                </tr>
	                                                                            </tbody>
	                                                                        </table>
	                                                                    </td>
	                                                                </tr>
	                                                            </tbody>
	                                                        </table>
	                                                    </td>
	                                                </tr>
	                                                <tr>
	                                                    <td style="background-image:url(https://i.postimg.cc/JhB6KKjF/sine-Image.jpg);background-position: center top; background-color: #fff; background-repeat: no-repeat; padding-right: 80px; padding-left: 80px; padding-bottom: 125px;">
	                                                        <table style="background-color: #e84c3d; width: 100%; border-radius: 25px; margin: auto;">
	                                                            <tbody>
	                                                                <tr>
	                                                                    <td>
	                                                                        <table style=" padding: 5%;">
	                                                                            <tbody style="color: #fff; text-align: justify;">
	                                                                                <tr>
	                                                                                    <td>
	                                       			   <p style="font-size: 23px; color: #fff">Hola!</p>
	                                                                                    </td>
	                                                                                </tr>
	                                                                                <tr>
	                                                                                    <td>
	                                                    <p style="font-size: 20px; color: #fff">Por medio de este correo se le notifica el cambio a tipo administrador en el sistema.</p>
	                                                        <p style="font-size: 12px; color: #fff">Feliz dia - El equipo de Voting GO¡</p>
	                                                                                    </td>
	                                                                                </tr>
	                                                                            </tbody>
	                                                                        </table>
	                                                                    </td>

	                                                                </tr>
	                                                            </tbody>
	                                                        </table>
	                                                    </td>
	                                                </tr>
	                                                
	                                            </tbody>
	                                        </table>
	                                    </td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </td>
	                </tr>
	            </tbody>
	        </table>
	    </div>
	</body>

	</html>';
		 $mail->send();

    }catch(Exeption $e){
          return false;
          die($e->getMessage());
    }   
    
        }catch(Exception $e){
            return false;
            die($e->getMessage());
        }
    }

    //COREO nOTIFICa CANDIDATURA A ESTUDIANTE
    public function sendemailAdminCandidacy(){
        try{
    $mail = new PHPMailer(true);

    $nombre = $_POST['name'];
    $correo = $_POST['email']; 


    try{
       $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'Gabosvel2003@gmail.com';                     // SMTP username
    $mail->Password   = 'gabrielvelandia2003';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('Gabosvel2003@gmail.com', 'SI VOTINGO');
    $mail->addAddress($correo, $nombre);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'POSTULACION A CANDIDATURA';
    $mail->Body    = '<!DOCTYPE html>
	<html>

	<head>
	    <meta charset="UTF-8">
	    <meta content="width=device-width, initial-scale=1" name="viewport">
	</head>

	<body>
	    <div class="">

	        <table style="width: 100%; background-color: transparent;">
	            <tbody>
	                <tr>
	                    <td>
	                        <table style="text-align: center; background-color: transparent; margin: auto;">
	                            <tbody>
	                                <tr>
	                                    <td>
	                                        <table style="background-color: transparent; width: 700px; border-collapse: collapse; text-align: center;">
	                                            <tbody>
	                                                <tr>
	                                                    <td style="border-radius: 30px 30px 0px 0px; background-color: #efefef; height: 300px;">
	                                                        <table style="background-color: transparent;">
	                                                            <tbody>
	                                                             <tr>
	                                                              <td style="width: 700px; text-align: center;">
	                                                                <table style="background-size: 100%; background-position: left top; background-color: transparent; margin: auto;">
	                                                                     <tbody>
	                                                                      <tr>
	                                                                        <td style="text-align: center; color: #e84c3d;">
	                                                              <h1>POSTULACIÓN DE CANDIDATURA</h1>
	                                                               </td>
	                                                               </tr>
	                                                               <tr>
	                                                              <td style="text-align: center; margin: auto;">
	                                                                    <img src="https://i.postimg.cc/KYvqhxXd/logoo.png">
	                                                                         <h2 style="font-size: 35px; font-weight: 900; color: #1624a1">Buen Dia: 
	                                                                      <span style="color: #e84c3d; font-style: italic;">'.$nombre.'</span>¡</h2>
	                                                                                    </td>
	                                                                                </tr>
	                                                                            </tbody>
	                                                                        </table>
	                                                                    </td>
	                                                                </tr>
	                                                            </tbody>
	                                                        </table>
	                                                    </td>
	                                                </tr>
	                                                <tr>
	                                                    <td style="background-image:url(https://i.postimg.cc/JhB6KKjF/sine-Image.jpg);background-position: center top; background-color: #fff; background-repeat: no-repeat; padding-right: 80px; padding-left: 80px; padding-bottom: 125px;">
	                                                        <table style="background-color: #e84c3d; width: 100%; border-radius: 25px; margin: auto;">
	                                                            <tbody>
	                                                                <tr>
	                                                                    <td>
	                                                                        <table style=" padding: 5%;">
	                                                                            <tbody style="color: #fff; text-align: justify;">
	                                                                                <tr>
	                                                                                    <td>
	                                       			   <p style="font-size: 23px; color: #fff">Hola!</p>
	                                                                                    </td>
	                                                                                </tr>
	                                                                                <tr>
	                                                                                    <td>
	                                                    <p style="font-size: 20px; color: #fff">El motivo de este correo es para notificarle su asignación como candidato al mandato estudiantil</p>
	                                                        <p style="font-size: 12px; color: #fff">Feliz dia - El equipo de Voting GO¡</p>
	                                                                                    </td>
	                                                                                </tr>
	                                                                            </tbody>
	                                                                        </table>
	                                                                    </td>

	                                                                </tr>
	                                                            </tbody>
	                                                        </table>
	                                                    </td>
	                                                </tr>
	                                                
	                                            </tbody>
	                                        </table>
	                                    </td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </td>
	                </tr>
	            </tbody>
	        </table>
	    </div>
	</body>

	</html>';
		 $mail->send();

    }catch(Exeption $e){
          return false;
          die($e->getMessage());
    }   
    
        }catch(Exception $e){
            return false;
            die($e->getMessage());
        }
    }

    public function sendemailVoteCertificate($data, $dataAll){
        try{
    $mail = new PHPMailer(true);

    $nombre = $data['name'];
    $apellido = $data['lastName'];
    $documento = $data['document']; 
    $correo = $data['email'];
    $grado = $dataAll[0]->grade_name;
    $curso = $dataAll[0]->code;
    $jornada = $dataAll[0]->wday_name;
 
    // var_dump($nombre,$apellido,$documento,$grado,$curso,$jornada);
    // die();


    try{
       $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'Gabosvel2003@gmail.com';                     // SMTP username
    $mail->Password   = 'gabrielvelandia2003';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('Gabosvel2003@gmail.com', 'SI VOTINGO');
    $mail->addAddress($correo, $nombre);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'CERTIFICACION DE VOTO ELECTORAL - SI VOTINGO';
    $mail->Body    = '<!DOCTYPE html>
	<html>

	<head>
	    <meta charset="UTF-8">
	    <meta content="width=device-width, initial-scale=1" name="viewport">
	</head>

	<body>
	    <div class="">

	        <table style="width: 100%; background-color: transparent;">
	            <tbody>
	                <tr>
	                    <td>
	                        <table style="text-align: center; background-color: transparent; margin: auto;">
	                            <tbody>
	                                <tr>
	                                    <td>
	                                        <table style="background-color: transparent; width: 700px; border-collapse: collapse; text-align: center;">
	                                            <tbody>
	                                                <tr>
	                                                    <td style="border-radius: 30px 30px 0px 0px; background-color: #efefef; height: 300px;">
	                                                        <table style="background-color: transparent;">
	                                                            <tbody>
	                                                             <tr>
	                                                              <td style="width: 700px; text-align: center;">
	                                                                <table style="background-size: 100%; background-position: left top; background-color: transparent; margin: auto;">
	                                                                     <tbody>
	                                                                      <tr>
	                                                                        <td style="text-align: center; color: #e84c3d;">
	                                                              <h1>SI VOTING GO - CERTIFICACION DE VOTO ELECTORAL</h1>
	                                                               </td>
	                                                               </tr>
	                                                               <tr>
	                                                              <td style="text-align: center; margin: auto;">
	                                                                    <img src="https://i.postimg.cc/KYvqhxXd/logoo.png">
	                                                                         <h2 style="font-size: 35px; font-weight: 900; color: #1624a1">Querid@ 
	                                                                      <span style="color: #e84c3d; font-style: italic;">'.$nombre.' '.$apellido.'</span>¡</h2>
	                                                                                    </td>
	                                                                                </tr>
	                                                                            </tbody>
	                                                                        </table>
	                                                                    </td>
	                                                                </tr>
	                                                            </tbody>
	                                                        </table>
	                                                    </td>
	                                                </tr>
	                                                <tr>
	                                                    <td style="background-image:url(https://i.postimg.cc/JhB6KKjF/sine-Image.jpg);background-position: center top; background-color: #fff; background-repeat: no-repeat; padding-right: 80px; padding-left: 80px; padding-bottom: 125px;">
	                                                        <table style="background-color: #e84c3d; width: 100%; border-radius: 25px; margin: auto;">
	                                                            <tbody>
	                                                                <tr>
	                                                                    <td>
	                                                                        <table style=" padding: 5%;">
	                                                                            <tbody style="color: #fff; text-align: justify;">
	                                                                                <tr>
	                                                                                    <td>
	                                       			   <p style="font-size: 23px; color: #fff"> identificado con N° de identidad: '.$documento.'</p>
	                                       			   <p style="font-size: 23px; color: #fff"> Correo: '.$correo.'</p>
	                                       			   <p style="font-size: 23px; color: #fff"> Pertenece al grado: '.$grado.'</p>
	                                       			   <p style="font-size: 23px; color: #fff"> Curso: '.$curso.'</p>
	                                       			   <p style="font-size: 23px; color: #fff"> Jornada: '.$jornada.'</p>
	                                                                                    </td>
	                                                                                </tr>
	                                                                                <tr>
	                                                                                    <td>
	                                                    <p style="font-size: 20px; color: #fff">Tu derecho a voto se ha ejercido satisfactoriamente.</p>
	                                                        <p style="font-size: 12px; color: #fff">Feliz dia - El equipo de Voting GO¡</p>
	                                                                                    </td>
	                                                                                </tr>
	                                                                            </tbody>
	                                                                        </table>
	                                                                    </td>

	                                                                </tr>
	                                                            </tbody>
	                                                        </table>
	                                                    </td>
	                                                </tr>
	                                                
	                                            </tbody>
	                                        </table>
	                                    </td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </td>
	                </tr>
	            </tbody>
	        </table>
	    </div>
	</body>

	</html>';
		 $mail->send();
return $pass;

    }catch(Exeption $e){
          return false;
          die($e->getMessage());
    }   
    
        }catch(Exception $e){
            return false;
            die($e->getMessage());
        }
    }
    
    public function updatepassword($newPassword){
          try {
                $data=$newPassword;
                $strWhere =$_SESSION['user']->id;
                /* MySQL Conexion*/
                $link = mysqli_connect("localhost", "root", '', "si_votingo");
                // Chequea coneccion
                if($link === false){
                    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
                }
                // Ejecuta la actualizacion del registro
                $sql = "UPDATE users SET password = '$data' WHERE id='$strWhere'";
                if(mysqli_query($link, $sql)){
                    //echo "Registro actualizado.";
                } else {
                    echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
                }
                // Cierra la conexion
                mysqli_close($link);        
                return true;
            } catch(PDOException $e) {  
                die($e->getMessage());
            }       
    }

		
		// public function deleteUser($data)
		// {
		// 	try {
		// 		$strWhere = 'id = '. $data['id'];
		// 		$this->pdo->delete('usuario', $strWhere);
		// 	} catch(PDOException $e) {
		// 		die($e->getMessage());
		// 	}	
		// }

		

	}