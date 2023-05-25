<?php

class Model_Task extends Model
{
    public function get_data()
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
    }

}
