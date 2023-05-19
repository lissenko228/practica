<?php

include 'db.php';

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

header("Location:/");

?>