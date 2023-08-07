<?php
namespace Phppot;

class Member
{

    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->ds = new DataSource();
    }

    /**
     * to check if the username already exists
     *
     * @param string $username
     * @return boolean
     */
    public function isUsernameExists($username)
    {
        $query = 'SELECT * FROM tbl_member where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * to check if the email already exists
     *
     * @param string $email
     * @return boolean
     */
    public function isEmailExists($email)
    {
        $query = 'SELECT * FROM tbl_member where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * to signup / register a user
     *
     * @return string[] registration status message
     */
    public function registerMember()
    {
        $isUsernameExists = $this->isUsernameExists($_POST["username"]);
        $isEmailExists = $this->isEmailExists($_POST["email"]);
        if ($isUsernameExists) {
            $response = array(
                "status" => "error",
                "message" => "Username already exists."
            );
        } else if ($isEmailExists) {
            $response = array(
                "status" => "error",
                "message" => "Email already exists."
            );
        } else {
            
            $query = 'INSERT INTO tbl_member (username, password, email, mobile, address) VALUES (?, ?, ?, ?, ?)';
            $paramType = 'sssss';
            $paramValue = array(
                $_POST["username"],
                $_POST["signup-password"],
                $_POST["email"],
                $_POST["mobile"],
                $_POST["address"],
            );
            $memberId = $this->ds->insert($query, $paramType, $paramValue);
            if (!empty($memberId)) {
                $response = array(
                    "status" => "success",
                    "message" => "You have registered successfully."
                );
            }
        }
        return $response;
    }

    public function getMember($username)
    {
        $query = 'SELECT * FROM tbl_member where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }

    /**
     * to login a user
     *
     * @return string
     */
    public function loginMember()
    {
        $memberRecord = $this->getMember($_POST["username"]);
        $loginPassword = 0;
        if (!empty($memberRecord)) {
            if (!empty($_POST["login-password"])) {
                $password = $_POST["login-password"];
            }
            $storedPassword = $memberRecord[0]["password"];
            $loginPassword = 0;
            if ($password === $storedPassword) {
                $loginPassword = 1;
            }
        } else {
            $loginPassword = 0;
        }
        if ($loginPassword == 1) {
            // login success, so store the member's username in the session
            session_start();
            $_SESSION["username"] = $memberRecord[0]["username"];
            setcookie("user", $memberRecord[0]["username"], time() + (3600 * 24 * 60 * 60));
            setcookie("email", $memberRecord[0]["email"], time() + (3600 * 24 * 60 * 60));
            setcookie("mobile", $memberRecord[0]["mobile"], time() + (3600 * 24 * 60 * 60));
            setcookie("address", $memberRecord[0]["address"], time() + (3600 * 24 * 60 * 60));
            $response = array(
                "status" => "success",
                "message" => "You have logged in successfully."
            );

            session_write_close();
            $url = "./home.php";
            include '../include/db_connection.php';
            
            $username = $memberRecord[0]['username'];
            $email = $memberRecord[0]['email'];
            $mobile = $memberRecord[0]['mobile'];
            
            $query = "INSERT INTO tbl_member_logs(username, email, mobile) VALUES ('$username', '$email', '$mobile')";
            
            mysqli_query($conn,$query);
            mysqli_close($conn);

            header("Location: $url");
        } else if ($loginPassword == 0) {
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
    }
}