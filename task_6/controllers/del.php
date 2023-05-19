<?php

include 'db.php';

$id_task=$_GET['id_task'];

if($id_task)
{
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
}

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

header("Location:/");

?>