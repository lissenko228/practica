<?php

class Model_Task extends Model
{
    public $dbh;
    function __construct(PDO $dbh)
    {
        $this -> dbh = $dbh;
    }

    public function get_data()
    {
        try {
			$dbh = new PDO('mysql:dbname=tasklist; host=localhost', 'root', '');
		} catch (PDOException $e) {
			die($e->getMessage());
		}

        $id_user = $_SESSION['user']['id'];

        $sth = $dbh -> prepare("SELECT * FROM `tasks` WHERE `id_user` = ?");
        $sth -> execute(array($id_user));
        $tasks = $sth -> fetchAll(PDO::FETCH_ASSOC);

        return $tasks;
    }

}
