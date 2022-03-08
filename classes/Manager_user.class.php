<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require('php/config.php');


// spl_autoload_register(function ($class) {
//     include './' . $class . '.class.php';
// });

class Manager_user
{

    private $bdd;

    public function __construct(PDO $bdd)
    {
        $this->bdd = $bdd;
    }

    //ADD

    public function add_user(array $user)
    {


        $sql0 = $this->bdd->query("SELECT mail FROM user WHERE mail = '{$user['mail']}'");
        if ($sql0->rowCount() > 0) {
            echo "<p class='error-txt'> L'adresse email existe deja. </p>";
        } else {

            $sql = $this->bdd->prepare("INSERT INTO user (nickname,mail,password,role)
                            VALUES (:nickname,:mail,:password,:role);");
            $sql->bindValue(':nickname', $user['nickname'], PDO::PARAM_STR);
            $sql->bindValue(':mail', $user['mail'], PDO::PARAM_STR);
            $sql->bindValue(':password', $user['password'], PDO::PARAM_STR);
            $sql->bindValue(':role', $user['role'], PDO::PARAM_STR);

            $sql->execute();

            if ($sql->rowCount() > 0) {

                echo "<div class='success-txt'>success</div>";
            } else {
                echo "<div class='error-txt'>something wrong</div>";
            }
            if ($sql) {
                $sql2 = $this->bdd->query("SELECT * FROM user WHERE mail = '{$user['mail']}'");
                $result = $sql2->fetch();

                $_SESSION['user_id'] = $result['id_user'];
                header("Location:index.php");
            }
        }
    }

    public function get_user(array $array)
    {

    


        $sql3 = $this->bdd->query("SELECT * FROM user WHERE mail = '{$array['mail']}'");
        $user = $sql3->fetch();

        if ($sql3->rowCount() > 0) {

            $verify_pass = password_verify($array['password'], $user['password']);
            if ($verify_pass) {
                $_SESSION['user_id'] = $user['id_user'];
                if ($user['role'] == "admin") {
                    $_SESSION['admin'] = "nkksdogljslo822s2Jdll";
                }
                header("Location:index.php");
            } else {
                echo "<div class='error-txt'>Adresse email ou mot de passe incorrect.</div>";
            }
        } else {
            echo "<div class='error-txt'>Cette adresse email n'existe pas.</div>";
        }
    }
}
