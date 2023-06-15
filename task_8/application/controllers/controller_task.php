<?php

class Controller_Task extends Controller
{
    function __construct()
    {
        $this -> model = new Model_Task();
        $this -> view = new View();
    }

    function action_index() 
    {
        $data = $this -> model -> get_tasks();
        $this -> view -> generate('task_view.php', 'template_view.php', $data);
    }

    function action_addTask()
    {
        $desc = $_POST['desc'];
        $desc = addslashes($desc);
        $add_task = $_POST['add_task'];
        $id_user = $_SESSION['user']['id'];

        if ($add_task) {
            if ( ! empty($desc)) {
                
                $data = array(
                    'id_user' => $id_user,
                    'description' => $desc
                );
        
                $result = $this -> model->add_task($data);
    
                if ( ! $result) {
                    $_SESSION['alert'] = "Задачу добавить не удалось";
                }
                $_SESSION['alert'] = "Задача добавлена";
                
            } else {
                $_SESSION['alert'] = "Заполните все поля";
            }
        }

        $this -> view -> generate('task_view.php', 'template_view.php');
    }

    function action_delTask()
    {
        $id = (int) $_GET['id_task'];
        
        if ($id) {
            $result = $this -> model -> del_task($id);

            if ( ! $result) {
                $_SESSION['alert'] = "Задачу удалить не удалось";
            } 
            $_SESSION['alert'] = "Задача удалена";
        }

        $this -> view -> generate('task_view.php', 'template_view.php');
    }

    function action_delAll()
    {
        $del = $_POST['del_all'];
        $id_user = $_SESSION['user']['id'];

        $alert = "Задачи удалить не удалось";

        if ($del) {
            $result = $this -> model -> del_all($id_user);

            if ($result) {
                $alert = "Задачи удалены";
            } 
        }

        $_SESSION['alert'] = $alert;

        $this->view->generate('task_view.php', 'template_view.php');
    }

    function action_status()
    {
        $ready = $_POST['ready'];
        $unready = $_POST['unready'];
        $id = (int) $_GET['id_task'];
        $status = (int) $_GET['status'];
        $alert = "Ошибка смены статуса";
        
        if ($ready || $unready) {

            if ($id) {

                if ($status == 1) {

                    $status = 2;

                    $result = $this -> model -> status_task($status, $id);

                    if ($result) {
                        $alert = "Статус изменен";
                    }

                } elseif ($status == 2) {
                    
                    $status = 1;

                    $result = $this -> model -> status_task($status, $id);

                    if ($result) {
                        $alert = "Статус изменен";
                    }
                }
            }
        }
        
        $_SESSION['alert'] = $alert;

        $this->view->generate('task_view.php', 'template_view.php');
    }

    function action_changeAll()
    {
        $id_user = $_SESSION['user']['id'];
        $ready_all = $_POST['ready_all'];

        if ($ready_all) {

            if ($id_user) {  
                $result = $this -> model -> status_all($id_user);

                if ( ! $result) {
                    $_SESSION['alert'] = "Ошибка смены статуса";
                }
                $_SESSION['alert'] = "Статус изменен";
            }
        }

        $this->view->generate('task_view.php', 'template_view.php');
    }
}