<?php

class Controller_Auth extends Controller
{
    
    function action_index()
    {
        $connect = mysqli_connect('localhost', 'root', '', 'tasklist');
        $login = $_POST['login'];
        $login = addslashes($login);
        $login  =  $connect->real_escape_string($login);
        
        $pass = $_POST['pass'];
        $auth = $_POST['auth'];

        if ($pass && $login) {
            $str_auth = "SELECT * FROM `users` where `login` = '$login' AND `password` = '$pass'";
            $run_auth = mysqli_query($connect,$str_auth);
            $count = mysqli_num_rows($run_auth);
            $auth = mysqli_fetch_array($run_auth);
    
            if ($count == 1) {
                $_SESSION['user'] = array(
                    'id'  => $auth['id'],
                    'login'  => $auth['login'],
                );
            } else {
                $str_add = "INSERT INTO `users` (`login`, `password`, `created_at`) VALUES ('$login', '$pass', CURRENT_TIMESTAMP)";
                $run_add = mysqli_query($connect,$str_add);
    
                if ($run_add) {
                    $str_auth = "SELECT * FROM `users` where `login` = '$login' AND `password` = '$pass'";
                    $run_auth = mysqli_query($connect,$str_auth);
                    $auth = mysqli_fetch_array($run_auth);
    
                    $_SESSION['user'] = array(
                        'id'  => $auth['id'],
                        'login'  => $auth['login'],
                    );
                }
            }
        } else {
            $_SESSION['error'] = "Заполните все поля";
        }
	
        $this->view->generate('auth_view.php', 'template_view.php');
    }

}