<?php
/**
 * @package Task class
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *
 */

// include connection class
include("DBConnection.php");
// Task
class Task
{
    protected $db;

    // __construct
    public function __construct()
    {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    public function getPeachData($username)
    {
      try {
          $sql = "SELECT peaches FROM users WHERE username=:username";
          $stmt = $this->db->prepare($sql);
          $data = [
              'username' => $username,
          ];
          $stmt->execute($data);
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          return $result[0]['peaches'];
      } catch (Exception $err) {
          die("Oh noes! There's an error in the query! " . $err);
      }
    }

    public function getAgencyPoints($username)
    {
      try {
          $sql = "SELECT agency_points FROM users WHERE username=:username";
          $stmt = $this->db->prepare($sql);
          $data = [
              'username' => $username,
          ];
          $stmt->execute($data);
          $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          return $result[0]['agency_points'];
      } catch (Exception $err) {
          die("Oh noes! There's an error in the query! " . $err);
      }
    }

    // update Task
    public function updatePeaches($username, $peaches)
    {
        try {
            $sql = "UPDATE users SET  peaches=:peaches WHERE username=:username";
            $data = [
                'username' => $username,
                'peaches' => $peaches,
            ];
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            $status = $stmt->rowCount();
            return $status;
        } catch (Exception $err) {
            die("Oh noes! There's an error in the query! " . $err);
        }
    }

    public function updateAgencyPoints($username, $agency_points)
    {
        try {
            $sql = "UPDATE users SET  agency_points=:agency_points WHERE username=:username";
            $data = [
                'username' => $username,
                'agency_points' => $agency_points,
            ];
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            $status = $stmt->rowCount();
            return $status;
        } catch (Exception $err) {
            die("Oh noes! There's an error in the query! " . $err);
        }
    }

    // getAll Task
    public function getAllUsers()
    {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $err) {
            die("Oh noes! There's an error in the query! " . $err);
        }
    }
}
