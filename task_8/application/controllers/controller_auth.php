<?php

class Controller_Auth extends Controller
{
    function __construct()
    {
        $this -> model = new Model_Auth();
        $this -> view = new View();
    }
    
    function action_index()
    {
        $login = $_POST['login'];
        $login = addslashes($login);
        $pass = $_POST['pass'];
        $auth = $_POST['auth'];

        if ($auth) {
            if ($pass && $login) {
                $result = $this -> model -> get_user($login, $pass);
                if ($result) {
                    $_SESSION['user'] = array(
                        'id' => $result['id'],
                        'login' => $result['login'],
                    );
                } else {
                    $result = $this -> model -> reg_user($login, $pass);
                    $result = $this -> model -> get_user($login,$pass);
                    if ($result) {
                        $_SESSION['user'] = array(
                            'id' => $result['id'],
                            'login' => $result['login'],
                        );
                    }
                }
            }
        }
    	
        $this->view->generate('auth_view.php', 'template_view.php');    
    }

}