<?php
	/**
	* Database class to be used in the main page.
	*/ 
	class Database
	{
		//Private attributes
		private $DB_SERVER;
		private $DB_DATABASE;
		private $DB_USERNAME;
		private $DB_PASSWORD;

		/** 
		* Method to connect to DB with the following attributes.
		* 
		* Set default database variables to establish a connection. Connect to database using mysqli.
		* Return database connection.
		*/
		protected function connect()
		{
			$this->DB_SERVER = "localhost";
			$this->DB_DATABASE = "magebit";
			$this->DB_USERNAME = "magebit";
			$this->DB_PASSWORD = "magebit";
			
			$database = new mysqli ($this->DB_SERVER, $this->DB_DATABASE, $this->DB_USERNAME, $this->DB_PASSWORD);
			return $database;
		}
	}
?>