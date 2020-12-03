<?php
	/**
	 * Clase HomeController para cargar el home del proyecto
	 */
	class HomeController
	{
		
		public function index()
		{
			require 'views/layout.php';
			require 'views/user/infoUser.php';
		}
		
	}