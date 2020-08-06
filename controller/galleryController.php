<?php

if (!isset($_SESSION['email'])) {
    session_start();
}
require_once 'connect.php';

class Gallery extends DB {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    //Show all Album
    public function getGalleries($columnName, $extra) {
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
        $result2 = $this->db->selectQuery('*', '`gallery`', '', '');
        $num_result = $result2->num_rows;
//        echo $num_result;
//        exit;
        $total_no_of_pages = ceil($num_result / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1
        $extra = 'LIMIT' . ' ' . $offset . ", " . $total_records_per_page;

        $result = $this->db->selectQuery('`album`.event_name, `gallery`.id, `gallery`.image', '`gallery` INNER JOIN `album` ', ' WHERE `album`.id = `gallery`.album_id', $extra);
//        echo '<pre>';
//        print_r($result);
//        exit;
        $returnArr = [
            'result' => $result,
            'result2' => $result2,
            'page_no' => $page_no,
            'offset' => $offset,
            'total_records_per_pages' => $total_records_per_page,
            'total_no_of_pages' => $total_no_of_pages,
            'adjacents' => $adjacents,
            'next_page' => $next_page,
            'previous_page' => $previous_page,
            'second_last' => $second_last,
            'num_result'=>$num_result,
        ];
        return $returnArr;
    }

    //Show single Album Gallery
    public function getGallerry($columnName, $condition, $extra) {
        
        //Pagination
        $album_id = $_REQUEST['id'];
        //echo $album_id;
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
        $condition = 'WHERE album_id = ' . $album_id;
        $res = $this->db->selectQuery('*', 'gallery', $condition, '');
        $num_result = $res->num_rows;

        // echo $total_records;
        // exit;
        $total_no_of_pages = ceil($num_result / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1
        $extra = 'LIMIT' . ' ' . $offset . ", " . $total_records_per_page;
        $result = $this->db->selectQuery('*', 'gallery', $condition, $extra);
        $returnArr = [
            'result' => $result,
            'result2' => $res,
            'page_no' => $page_no,
            'offset' => $offset,
            'total_records_per_pages' => $total_records_per_page,
            'total_no_of_pages' => $total_no_of_pages,
            'adjacents' => $adjacents,
            'next_page' => $next_page,
            'previous_page' => $previous_page,
            'second_last' => $second_last,
            'num_result'=>$num_result,
        ];
        return $returnArr;
    }

    //For a single gallery photo
     public function getGalleryPhoto($columnName, $condition, $extra) {

        return $this->db->selectQuery($columnName, '`gallery`', $condition, $extra);
    }
    //Create a new Album
    public function createGallery($values) {
        $uploadsDir = "../uploads/gallery/";
        foreach ($_FILES['image']['name'] as $key => $val) {
            $album_id = $_POST["id"];


            $fileName = !empty($values['files']['image']['name']) ? uniqid() . $values['files']['image']['name'][$key] : '';
            $tempLocation = $values['files']['image']['tmp_name'][$key];
            $targetFilePath = $uploadsDir . $fileName;
            if (!empty($values['files']['image']['name'][$key])) {
                move_uploaded_file($tempLocation, $targetFilePath);
            }
            $value = "'$album_id', '$fileName'";
            $attributes = "`album_id`, `image`";
            $insert = $this->db->createQuery('`gallery`', $attributes, $value);
            if ($insert === TRUE) {
                $_SESSION['create'] = "Successfully created album";
                header('Location: ../view/showMainGallery.php');
            }
        }
    }

    //Update Gallery
    public function updateGallery($values) {
        $albumID = $values['post']['event'];
        $id = $values['post']['id'];

        $uploadsDir = "../uploads/gallery/";
        $prevImage = $values['post']['prev_image'];
        $fileName = !empty($values['files']['image']['name']) ? uniqid() . $values['files']['image']['name'] : $prevImage;

        $tempLocation = $values['files']['image']['tmp_name'];
        $targetFilePath = $uploadsDir . $fileName;

        $filepath = "../uploads/gallery/" . $prevImage;

        if (!empty($values['files']['image']['name'])) {
            if (move_uploaded_file($tempLocation, $targetFilePath)) {
                if (is_file($filepath)) {
                    unlink($filepath);
                }
            }
        }

        $condition = "`album_id` = '$albumID', `image` = '$fileName' WHERE id = $id";
        $query = $this->db->updateQuery('`gallery`', $condition);
        if ($query === TRUE) {
            $_SESSION['update'] = "User record has been updated Successfully!";
            header('Location:../view/showMainGallery.php');
        }
    }

    //Delete Gallery
    public function deleteGallery($id) {
        //Delete with image
        $condition = 'WHERE id = ' . $id;
        $fileResult = $this->db->selectQuery('image', 'gallery', $condition, '');
        $fileRow = $fileResult->fetch_assoc();
        $filepath = "../uploads/gallery/" . $fileRow['image'];

        $query = $this->db->deleteQuery('`gallery`', $id);
        if ($query === TRUE) {
            $_SESSION['delete'] = "User record has been deleted Successfully!";
            if (is_file($filepath)) {
                unlink($filepath);
            }
            header('Location: ../view/showMainGallery.php');
        }
    }

//End Class
}

$gallery = new Gallery(); //Gallery object
//
//For Create a new Gallery
if (isset($_POST['create'])) {
    $values = ['post' => $_POST, 'files' => $_FILES];
//    echo '<pre>';
//    print_r($values);
//    exit;
    $gallery->createGallery($values);
}

//For Update Gallery
if (isset($_POST['update'])) {
    $values = ['post' => $_POST, 'files' => $_FILES];
//    echo '<pre>';
//    print_r($values);
//    exit;
    $gallery->updateGallery($values);
}

//For Delete a Gallery
if (isset($_POST['delete'])) {
    $id = $_POST['del_id'];
    $gallery->deleteGallery($id);
    // echo $filepath;exit;
}