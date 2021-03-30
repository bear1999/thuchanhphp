<?php

require_once(__DIR__ . "\..\config\db.class.php");

class User
{
    public $UserID;
    public $Username;
    public $Email;
    public $Password;

    public function __construct($username, $email, $pass)
    {
        $this->Username = $username;
        $this->Email = $email;
        $this->Password = $pass;
    }

    public function save()
    {
        $db = new Db();
        // $user = mysqli_real_escape_string($this->Username);
        // $email = mysqli_real_escape_string($this->Email);
        // $pass = md5(mysqli_real_escape_string($this->Password));
        $pass = md5($this->Password);
        $sql = "INSERT INTO users (Username, Email, Password) VALUES 
                ('$this->Username', '$this->Email', '$pass')";
        $result = $db->query_execute($sql);
        return $result;
    }

    public function checkLogin($user, $pass)
    {
        // $db = new Db();
        $db = new mysqli("localhost", "root", "", "ecommerce");
        $pass = md5($pass);   
        $sql = "SELECT * FROM users WHERE Username = '$user' AND Password = '$pass'";
        $result = $db->query($sql);
        return $result;
    }

}
