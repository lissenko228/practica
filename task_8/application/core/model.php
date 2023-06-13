<?php

class Model
{
	public $dbh;
	/*
		Модель обычно включает методы выборки данных, это могут быть:
			> методы нативных библиотек pgsql или mysql;
			> методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
			> методы ORM;
			> методы для работы с NoSQL;
			> и др.
	*/

	// метод выборки данных
	public function get_data()
	{	
		try {
			$this -> dbh = new PDO('mysql:dbname=tasklist; host=localhost', 'root', '');
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}