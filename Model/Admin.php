<?php
namespace Phppot;

class Admin
{
    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->ds = new DataSource();
    }

    /**
     * Check if the admin username and password exist and match in the database.
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function isAdminExists($username, $password){
        $query = 'SELECT * FROM tbl_admin WHERE username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $adminRecord = $this->ds->select($query, $paramType, $paramValue);

        if (!empty($adminRecord)) {
            // Compare the entered password with the stored password (plaintext)
            $storedPassword = $adminRecord[0]["password"];
            if ($password === $storedPassword) {
                // Admin login is successful
                return true;
            }
        }

        // Admin login failed
        return false;
    }
}
?>
