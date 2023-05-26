<?php

class Controller_Task extends Controller
{
    // function __construct()
    // {
    //     $this->model = new Model_Task();
    //     $this->view = new View();
    // }

    function action_index() 
    {
        $this->view->generate('task_view.php', 'template_view.php');
    }

    function action_addTask()
    {
        $connect=mysqli_connect('localhost', 'root', '', 'tasklist');
        $desc=$_POST['desc'];
        $desc=addslashes($desc);
        $desc = $connect->real_escape_string($desc);

        $add_task=$_POST['add_task'];
        $id_user=$_SESSION['user']['id'];

        if($add_task)
        {
            if($desc)
            {
                $str_add="INSERT INTO `tasks` (`id_user`, `description`, `created_at`, `status`) VALUES ('$id_user', '$desc', CURRENT_TIMESTAMP, '1')";
                $run_add=mysqli_query($connect,$str_add);

                if($run_add)
                {
                    $_SESSION['alert']="Задача добавлена";
                }
                else
                {
                    $_SESSION['alert']="Ошибка добавления";
                }
            }
            else
            {
                $_SESSION['alert']="Заполните все поля";
            }
        }
        $this->view->generate('task_view.php', 'template_view.php');
    }

    function action_delTask()
    {
        // $data = $this->model->get_data();
        $connect=mysqli_connect('localhost', 'root', '', 'tasklist');
        $id_task=$_GET['id_task'];
        $del="DELETE FROM `tasks` WHERE `id` = '$id_task'";
        $run_del=mysqli_query($connect,$del);
        if($run_del)
        {
            $_SESSION['alert']="Задача удалена";
        }
        else
        {
            $_SESSION['alert']="Удалить не удалось";
        }

        $this->view->generate('task_view.php', 'template_view.php');
    }

    function action_delAll()
    {
        $connect=mysqli_connect('localhost', 'root', '', 'tasklist');
        $id_user=$_GET['id_user'];

        if($id_user)
        {
            $del="DELETE FROM `tasks` WHERE `id_user` = '$id_user'";
            $run_del=mysqli_query($connect,$del);
            if($run_del)
            {
                $_SESSION['alert']="Задачи удалены";
            }
            else
            {
                $_SESSION['alert']="Удалить не удалось";
            }
        }
        
        $this->view->generate('task_view.php', 'template_view.php');
    }

    function action_status()
    {
        $connect=mysqli_connect('localhost', 'root', '', 'tasklist');
        $id_task=$_GET['id_task'];
        $status=$_GET['status'];

        if($id_task)
        {
            if($status==1)
            {
                $upd_stat="UPDATE `tasks` SET `status` = '2' WHERE `id` = '$id_task'";
                $upd=mysqli_query($connect,$upd_stat);
                if($upd)
                {
                    $_SESSION['alert']="Задача выполнена";
                }
                else
                {
                    $_SESSION['alert']="Ошибка выполнения";
                }
            }
            elseif($status==2)
            {
                $upd_stat="UPDATE `tasks` SET `status` = '1' WHERE `id` = '$id_task'";
                $upd=mysqli_query($connect,$upd_stat);
                if($upd)
                {
                    $_SESSION['alert']="Задача отменена";
                }
                else
                {
                    $_SESSION['alert']="Ошибка отмены";
                }
            }    
        }

        $this->view->generate('task_view.php', 'template_view.php');
    }

    function action_changeAll()
    {
        $connect=mysqli_connect('localhost', 'root', '', 'tasklist');
        $id_user=$_GET['id_user'];

        if($id_user)
        {
            $upd_stat="UPDATE `tasks` SET `status` = '2' WHERE `id_user` = '$id_user'";
            $upd=mysqli_query($connect,$upd_stat);

            if($upd)
            {
                $_SESSION['alert']="Задача выполнена";
            }
            else
            {
                $_SESSION['alert']="Ошибка выполнения";
            }
        }

        $this->view->generate('task_view.php', 'template_view.php');
    }
}