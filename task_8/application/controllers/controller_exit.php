<?php

class Controller_Exit extends Controller
{
    function action_index()
    {
        session_unset();
        $this -> view -> generate('auth_view.php', 'template_view.php');
    }
}