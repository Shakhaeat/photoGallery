<?php
if(!isset($_SESSION['email'])){
    session_start();
}
require_once 'connect.php';

class User extends DB {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function getResults($columnName, $tableName, $condition, $extra) {
        if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
            $page_no = $_GET['page_no'];
        } else {
            $page_no = 1;
        }
        $total_records_per_page = 3;
        $offset = ($page_no - 1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2";
        $result2 = $this->db->selectQuery('*', '`users`', '', '');
        $num_result = $result2->num_rows;
//        echo $num_result;
//        exit;
        $total_no_of_pages = ceil($num_result / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1
        $extra = 'LIMIT' . ' ' . $offset . ", " . $total_records_per_page;
        //$result = $users->getResults('*', '`users`', '', $extra);
        
        $result = $this->db->selectQuery($columnName, 'users', $condition, $extra);
        $returnArr = [
            'result'=>$result,
            'result2'=>$result2,
            'page_no'=>$page_no,
            'offset'=>$offset,
            'total_records_per_pages'=>$total_records_per_page,
            'total_no_of_pages'=>$total_no_of_pages,
            'adjacents'=>$adjacents,
            'next_page'=>$next_page,
            'previous_page'=>$previous_page,
            'second_last'=>$second_last,
            'num_result'=>$num_result,
            
        ];
        return $returnArr;
       
        
    }
    
    //For a single user
    public function getuser($columnName, $tableName, $condition, $extra) {

        return $this->db->selectQuery($columnName, 'users', $condition, $extra);
    }


    //For Create new user
    function createUser($values) {

        $firstName = $values['post']['first_name'];
        $lastName = $values['post']['last_name'];
        $email = $values['post']['email'];
        $password = md5($values['post']['password']);
        $phone = $values['post']['phone'];
        $thanaId = $values['post']['thana'];

        $uploadsDir = "../uploads/profile/";
        $fileName = !empty($values['files']['image']['name']) ? uniqid() . $values['files']['image']['name'] : '';
        $tempLocation = $values['files']['image']['tmp_name'];
        $targetFilePath = $uploadsDir . $fileName;
        if (!empty($values['files']['image']['name'])) {
            move_uploaded_file($tempLocation, $targetFilePath);
        }
        $value = "$thanaId, '$firstName', '$lastName', '$email', '$password', '$phone','$fileName'";
        $attributes = "`thana_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `image`";
        $insert = $this->db->createQuery('`users`', $attributes, $value);
        if ($insert === TRUE) {
            $_SESSION['create'] = "Successfully created user";
            header('Location: ../view/userShow.php');
        } else {
            echo 'dkfjdlkf';
        }
    }

//
//    //For Update a user
    function updateUser($values) {
        $firstName = $values['post']['first_name'];
        $lastName = $values['post']['last_name'];
        $email = $values['post']['email'];
        $phone = $values['post']['phone'];
        $thana_id = $values['post']['thana'];
        //$image = $values['post']['image'];
        $id = $values['post']['id'];

        $uploadsDir = "../uploads/profile/";
        $prevImage = $values['post']['prev_image'];
        $fileName = !empty($values['files']['image']['name']) ? uniqid() . $values['files']['image']['name'] : $prevImage;

        $tempLocation = $values['files']['image']['tmp_name'];
        $targetFilePath = $uploadsDir . $fileName;

        $filepath = "../uploads/profile/" . $prevImage;

        if (!empty($values['files']['image']['name'])) {
            if (move_uploaded_file($tempLocation, $targetFilePath)) {
                if (is_file($filepath)) {
                    unlink($filepath);
                }
            }
        }

        $condition = "`thana_id`=$thana_id,`first_name` = '$firstName',`last_name` = '$lastName', `email` = '$email',`phone` = '$phone', `image` = '$fileName' WHERE id = $id";
        $query = $this->db->updateQuery('`users`', $condition);
        if ($query === TRUE) {
            $_SESSION['update'] = "User record has been updated Successfully!";
            header('Location:../view/userShow.php');
        }
    }

//
//    //For Delete a user
    function deleteUser($id) {

        //Delete with image
        $condition = 'WHERE id = ' . $id;
        $fileResult = $this->db->selectQuery('image', 'users', $condition, '');
        $fileRow = $fileResult->fetch_assoc();
        $filepath = "../uploads/profile/" . $fileRow['image'];

        $query = $this->db->deleteQuery('`users`', $id);
        if ($query === TRUE) {
            $_SESSION['delete'] = "User record has been deleted Successfully!";
            if (is_file($filepath)) {
                unlink($filepath);
            }
            header('Location: ../view/userShow.php');
        }
    }
    
    public function getThana($columnName, $condition, $extra) {
       // echo $this->db->selectQuery($columnName, 'thana', $condition, $extra);
        return $this->db->selectQuery($columnName, 'thana', $condition, $extra);
    }

    public function getDistricts($columnName, $condition, $extra) {
        return $this->db->selectQuery($columnName, 'districts', $condition, $extra);
    }
    public function getDivision($columnName, $condition, $extra) {
        return $this->db->selectQuery($columnName, 'divisions', $condition, $extra);
    }
    //End of Class
}

//Create User object
$user = new User();

//For Create a new User
if (isset($_POST['create'])) {
    $values = ['post' => $_POST, 'files' => $_FILES];
//    echo '<pre>';
//    print_r($values);
//    exit;
    $user->createUser($values);
}

//For Update User
if (isset($_POST['update'])) {
    $values = ['post' => $_POST, 'files' => $_FILES];
    $user->updateUser($values);
}

//For Delete a User
if (isset($_POST['delete'])) {
    $id = $_POST['del_id'];
    $user->deleteUser($id);
    // echo $filepath;exit;
}
?>
