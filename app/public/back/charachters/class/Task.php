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
    private $_taskID;
    private $_item;
    private $_status;
    private $_end_time;
    private $_release_time;
    private $_value;
    private $_peach;
    private $_income;
    private $_days;
    private $_char_cycle;
    private $_filename;

    public function setTaskID($taskID)
    {
        $this->_taskID = $taskID;
    }
    public function setItem($item)
    {
        $this->_item = $item;
    }
    public function setStatus($status)
    {
        $this->_status = $status;
    }
    public function setProperties($end_time_1, $end_time_2, $release_time_1, $release_time_2, $value, $peach, $income, $days, $char_cycle, $filename)
    {
        // $end_time_array_1 = explode(':', $end_time_1);
        // $end_time_array_2 = explode(':', $end_time_2);
        //
        // $release_time_array_1 = explode(':', $release_time_1);
        // $release_time_array_2 = explode(':', $release_time_2);

        // $this->_end_time = $end_time_array_1[0].','.$end_time_array_2[0];
        // $this->_release_time = $release_time_array_1[0].','.$release_time_array_2[0];

        $this->_end_time = $end_time_1 . ',' . $end_time_2;
        $this->_release_time = $release_time_1 . ',' . $release_time_2;
        $this->_value = $value;
        $this->_peach = $peach;
        $this->_income = $income;
        $this->_days = $days;
        $this->_char_cycle = $char_cycle;
        $this->_filename = $filename;
    }

    // __construct
    public function __construct()
    {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    // create Task
    public function createTask()
    {
        try {
            $sql = 'INSERT INTO todo_list (task, status, end_time, release_time, value, peach, income, days, char_cycle, image)  VALUES (:task, :status, :end_time, :release_time, :value, :peach, :income, :days, :char_cycle, :image)';
            $data = [
                'task' => $this->_item,
                'status' => $this->_status,
                'end_time' => $this->_end_time,
                'release_time' => $this->_release_time,
                'value' => $this->_value,
                'peach' => $this->_peach,
                'income' => $this->_income,
                'days' => $this->_days,
                'char_cycle' => $this->_char_cycle,
                'image' => $this->_filename
            ];
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            $status = $this->db->lastInsertId();
            return $status;
        } catch (Exception $err) {
            die("Oh noes! There's an error in the query! ".$err);
        }
    }

    // update Task
    public function updateTask()
    {
        try {
            if ($this->_filename == 'NULL') {
                $sql = "UPDATE todo_list SET  status=:status, task=:task, end_time=:end_time, release_time=:release_time, value=:value, peach=:peach, income=:income, days=:days, char_cycle=:char_cycle WHERE id=:task_id";
                $data = [
                'status' =>$this->_status,
                'task_id' => $this->_taskID,
                'task' => $this->_item,
                'end_time' => $this->_end_time,
                'release_time' => $this->_release_time,
                'value' => $this->_value,
                'peach' => $this->_peach,
                'income' => $this->_income,
                'days' => $this->_days,
                'char_cycle' => $this->_char_cycle
            ];
            } else {
                $sql = "UPDATE todo_list SET  status=:status, task=:task, end_time=:end_time, release_time=:release_time, value=:value, peach=:peach, income=:income, days=:days, char_cycle=:char_cycle, image=:image WHERE id=:task_id";
                $data = [
                'status' =>$this->_status,
                'task_id' => $this->_taskID,
                'task' => $this->_item,
                'end_time' => $this->_end_time,
                'release_time' => $this->_release_time,
                'value' => $this->_value,
                'peach' => $this->_peach,
                'income' => $this->_income,
                'days' => $this->_days,
                'char_cycle' => $this->_char_cycle,
                'image' => $this->_filename
            ];
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            $status = $stmt->rowCount();
            return $status;
        } catch (Exception $err) {
            die("Oh noes! There's an error in the query! " . $err);
        }
    }

    // getAll Task
    public function getAllTask()
    {
        try {
            $sql = "SELECT * FROM todo_list WHERE status != :status";
            $stmt = $this->db->prepare($sql);
            $data = [
                'status' => $this->_status,
            ];
            $stmt->execute($data);
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $err) {
            die("Oh noes! There's an error in the query! " . $err);
        }
    }

    // delete Task
    public function deleteTask()
    {
        try {
            $sql = "DELETE FROM todo_list WHERE id=:task_id";
            $stmt = $this->db->prepare($sql);
            $data = [
                'task_id' => $this->_taskID
            ];
            $stmt->execute($data);
            $status = $stmt->rowCount();
            return $status;
        } catch (Exception $err) {
            die("Oh noes! There's an error in the query! " . $err);
        }
    }
}
