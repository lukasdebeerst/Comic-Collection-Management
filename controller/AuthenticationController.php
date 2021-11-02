<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../dao/AuthenticationDAO.php';
require_once __DIR__ . '/../dao/LogDAO.php';

class AuthenticationController extends Controller {


    function __construct() {
        $this->authenticationDAO = new AuthenticationDAO();
        $this->logDAO = new LogDAO();
    }


    public function index(){
        if(!empty($_POST['action'])){
            if($_POST['action'] === "login"){
                if(!empty($_POST['email'])){
                    if(!empty($_POST['password'])){
                        $login = $this->authenticationDAO->checkLogin($_POST['email']);
    
                        if($login){
                            $this->set('login', $login);
                            if(password_verify($_POST['password'], $login['password'])){
                                $timestamp = date('Y-m-d H:i:s');
                                $_SESSION['currentUser'] = array(
                                    'id' => $login['id'],
                                    'firstName' => $login['firstName'],
                                    'lastName' => $login['lastName'],
                                    'mail' => $login['mail'],
                                    'status' => $login['status']
                                );
                                //LOGFILE
                                $log = $this->logDAO->newAction($_SESSION['currentUser']['id'], 'login', $timestamp);
                                if($log){
                                    header('Location: index.php?page=homeScreen');
                                }
                            } 
                            else {
                                $_SESSION['error'] = "Het wachtwoord kwam niet overeen met het account";
                            }
                        } else {
                            $_SESSION['error'] = "Het account werd niet gevonden";
                        }
                    } else {
                        $_SESSION['error'] = "Gelieve een wachtwoord in te voeren"; 
                    }
    
                } else {
                    $_SESSION['error'] = "Gelieve een emailadres in te voeren";
                }
            }

            if($_POST['action'] === "register"){
                $password = password_hash($_POST['createPassword'], PASSWORD_DEFAULT);
                $this->set('password', $password);
            }
            
        }

    }

}


?>
