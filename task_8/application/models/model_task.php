<?php

class Model_Task extends Model
{
    function __construct()
    {
        $this -> model = new Model();
    }

    // получение заданий
    public function get_tasks()
    {
        $id_user = $_SESSION['user']['id'];

        $sth = $this -> model -> get_data() -> prepare("SELECT * FROM `tasks` WHERE `id_user` = ?");
        $sth -> execute(array($id_user));
        $tasks = $sth -> fetchAll(PDO::FETCH_ASSOC);

        return $tasks;
    }

     // добавление заданий
    public function add_task($data)
    {
        $stmt = $this -> model -> get_data() -> prepare("INSERT INTO tasks (id_user, description) VALUES (:id_user, :description)");
        $stmt -> bindParam(':id_user', $data['id_user']);
        $stmt -> bindParam(':description', $data['description']);
        $result = $stmt->execute();

        return $result;
    }

    // удалить задачу
    public function del_task($id)
    {
        $stmt = $this -> model -> get_data() -> prepare("DELETE FROM tasks WHERE id = :id");
        $stmt -> bindParam(':id', $id);
        $result = $stmt -> execute();

        return $result;
    }

    // удалить все задачи
    public function del_all($id_user)
    {
        $stmt = $this -> model -> get_data() -> prepare("DELETE FROM tasks WHERE id_user = :id_user");
        $stmt -> bindParam(':id_user', $id_user);
        $result = $stmt -> execute();

        return $result;
    }

    public function status_task($status, $id)
    {
        $stmt = $this -> model -> get_data() ->prepare("UPDATE tasks SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();

        return $result;
    }

    public function status_all($id_user)
    {
        $stmt = $this -> model -> get_data() ->prepare("UPDATE tasks SET status = 2 WHERE id_user = :id_user");
        $stmt->bindParam(':id_user', $id_user);
        $result = $stmt->execute();

        return $result;
    }

}
