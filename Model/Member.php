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
            
            $query = 'INSERT INTO tbl_member (username, password, email, mobile, address,city, state, zip) VALUES (?, ?, ?, ?, ?,?,?,?)';
            $paramType = 'ssssssss';
            $paramValue = array(
                $_POST["username"],
                $_POST["signup-password"],
                $_POST["email"],
                $_POST["mobile"],
                $_POST["address"],
                $_POST["city"],
                $_POST["state"],
                $_POST["zip"]
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
    require 'include/db_connection.php';
    $usernameOrEmail = $_POST["username"];
    $password = $_POST["login-password"];
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        $memberRecord = $this->getMemberByEmail($usernameOrEmail);
    } else {
        $memberRecord = $this->getMemberByUsername($usernameOrEmail);
    }
    if (!empty($memberRecord)) {
        $storedPassword = $memberRecord[0]["password"];

        if ($password === $storedPassword) {
            session_start();
            $_SESSION["username"] = $memberRecord[0]["username"];
            setcookie("user", $memberRecord[0]["username"], time() + (3600 * 24 * 60 * 60));
            setcookie("email", $memberRecord[0]["email"], time() + (3600 * 24 * 60 * 60));
            setcookie("mobile", $memberRecord[0]["mobile"], time() + (3600 * 24 * 60 * 60));
            setcookie("address", $memberRecord[0]["address"], time() + (3600 * 24 * 60 * 60));
            setcookie("city", $memberRecord[0]["city"], time() + (3600 * 24 * 60 * 60));
            setcookie("state", $memberRecord[0]["state"], time() + (3600 * 24 * 60 * 60));
            setcookie("zip", $memberRecord[0]["zip"], time() + (3600 * 24 * 60 * 60));
            $response = array(
                "status" => "success",
                "message" => "You have logged in successfully."
            );

            $username = $memberRecord[0]['username'];
            $email = $memberRecord[0]['email'];
            $mobile = $memberRecord[0]['mobile'];
            
            // Update the count column in tbl_member
            $updateQuery = "UPDATE tbl_member SET count = count + 1 WHERE username = '$username'";
            mysqli_query($conn, $updateQuery);

            $query = "INSERT INTO tbl_member_logs(username, email, mobile) VALUES ('$username', '$email', '$mobile')";
            
            mysqli_query($conn, $query);
            mysqli_close($conn);
            $url = "./home.php";
            header("Location: $url");
            exit();
        }
    }
    $loginStatus = "Invalid username or password.";
    return $loginStatus;
}
                
    public function getMemberByEmail($email)
    {
        $query = 'SELECT * FROM tbl_member WHERE email = ?';
        $paramType = 's';
        $paramValue = array($email);
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }

    /**
     * Get member information by username
     *
     * @param string $username
     * @return array
     */
    public function getMemberByUsername($username)
    {
        $query = 'SELECT * FROM tbl_member WHERE username = ?';
        $paramType = 's';
        $paramValue = array($username);
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }
}