<?php
/**
 * Class to work with data of user instances, extends class _Database_
 */
class User extends Database
{
    /**
    * Private user object attributes needed for every new user instance.
    */
    private $id;
    private $name;
    private $email;
    private $password;

    /**
     * 
     */
    public function __construct() {
        $id = null;
        $name = null;
        $email = null;
        $password = null;

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Method to add new user to the DB.
     * 
     * First check if such email is not yet registered in the DB. If such email found, throw an error message.
     * If such email not found, insert new instance in the DB with given parameters.
     * 
     * @param string $name, $email and $password achieved through a POST Sign-up form in index.php.
     * 
     */
    public function addUser($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $date = date('Y-m-d');

        $sql = "SELECT * FROM users WHERE email='$this->email'";
        $exists = $this->connect()->query($sql);

        if ($exists->num_rows>0) {
            echo "<p class='alert'>This email is already registered!</p>";
        } else {
            $sql = "INSERT INTO users (name, email, password, created) VALUES ('$this->name', '$this->email', '$this->password', '$date')";
            $db = $this->connect()->query($sql);
        }

    }

    /**
     * Method to find user instance in the DB upon Login.
     * 
     * First check if user exists in the DB. If user with such email not found, throw alert message.
     * If found a user with given email, check if input password is the same as in DB. If so, 
     * save user data in the session and redirect user to welcome page.
     * 
     * @param string $email and $password achieved through a POST Login form in index.php.
     * 
     */
    public function findUser($email, $password){
        session_start();
        $this->email = $email;
        $this->password = $password;
        $sql = "SELECT * FROM users WHERE email='$this->email'";
        $exists = $this->connect()->query($sql);

        if ($exists->num_rows<1) {
            echo "<p class='alert'>User was not found!</p>";
        } else {
            while ($row = $exists->fetch_assoc()){
                $data[]=$row;
            }
            foreach ($data as $value) {
                $name = $value["name"];
                $password = $value["password"];
            }
            if ($password == $this->password) {
                $_SESSION['user'] = $name;
                header('Location: welcome.php');
            } else {
                echo "<p class='alert'>Incorrect password!</p>";
            }

        }
    }

    /**
     * Method to retrieve user id from the DB.
     * 
     * Fetch user with given email from the DB. If such user exists, return current user id.
     * 
     * @param string $email achieved through a POST Sign-up form in index.php.
     * @param int $id retrieved from DB user instance.
     */
    public function findId($email)
    {
        $this->email = $email;
        $sql1 = "SELECT * FROM users WHERE email = '$this->email'";
        $result = $this->connect()->query($sql1);

        $rowNum = $result->num_rows;
        if ($rowNum>0) {
            while ($row = $result->fetch_assoc()){
                $data[]=$row;
            }
            foreach ($data as $value) {
                $id = $value['id'];
            }
            return $id;
        }
    }
}
?>