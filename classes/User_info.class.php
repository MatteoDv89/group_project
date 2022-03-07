<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require('php/config.php');






class User_info
{

    private $nickname;
    private $mail;
    private $password;
    private $role = "user";


    public function __construct(array $data)
    {

        foreach ($data as $key => $value) {

            $methode = 'set' . ucfirst($key);

            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }

    //SETTER



    public function setNickname(string $value)
    {
        if (strlen($value) < 255 && is_string($value)) {

            $this->nickname = $value;
        } else {
            echo "<p class='error-txt'> Le format du nickname n'est pas valide </p>";
        }
    }


    public function setMail(string $value)
    {
        if (strlen($value) < 255 && is_string($value) && filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->mail = $value;
        } else {
            echo "<p class='error-txt'> Adresse email non valide </p>";
        }
    }

    public function setPassword(string $value)
    {
        $regex = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";

        if (strlen($value) < 255 && is_string($value) && preg_match($regex, $value)) {

            $this->password = password_hash($value, PASSWORD_BCRYPT);
        } else {
            echo "<p class='error-txt'> Le mot de passe doit contenir au moins 8caractères, 1 majuscule, 1 chiffre et un caractère spécial. </p>";
        }
    }






    //GETTER

    public function getNickname()
    {
        return  $this->nickname;
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRole()
    {
        return $this->role;
    }

    public function get_user_info()
    {
        $result = array(
            'nickname' => $this->nickname,
            'mail' => $this->mail,
            'password' => $this->password,
            'role' => $this->role
        );

        return $result;
    }
}
