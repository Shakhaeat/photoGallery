<?php

if (!isset($_SESSION['email'])) {
    session_start();
}

require_once 'connect.php';

class Album extends DB {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    //Show all Album
    public function getAlbums($columnName, $condition, $extra) {
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
        $result2 = $this->db->selectQuery('*', '`album`', '', '');
        $num_result = $result2->num_rows;
//        echo $num_result;
//        exit;
        $total_no_of_pages = ceil($num_result / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total pages minus 1
        $extra = 'LIMIT' . ' ' . $offset . ", " . $total_records_per_page;

        $result = $this->db->selectQuery($columnName, '`album`', $condition, $extra);
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
            'num_result' => $num_result,
        ];
        return $returnArr;
    }

    //For  single Album
    public function getAlbum($columnName, $tableName, $condition, $extra) {

        return $this->db->selectQuery($columnName, '`album`', $condition, $extra);
    }

    //Create a new Album
    public function createAlbum($values) {
        $eventName = $values['post']['event'];

        $uploadsDir = "../uploads/cover/";
        $fileName = uniqid() . $values['files']['image']['name'];
        $tempLocation = $values['files']['image']['tmp_name'];
        $targetFilePath = $uploadsDir . $fileName;
        if (!empty($values['files']['image']['name'])) {
            move_uploaded_file($tempLocation, $targetFilePath);
        }
        $value = "'$eventName', '$fileName'";
        $attributes = "`event_name`, `image`";
        $insert = $this->db->createQuery('`album`', $attributes, $value);
        if ($insert === TRUE) {
            $_SESSION['create'] = "Successfully created album";
            header('Location: ../view/albumShow.php');
        } else {
            echo 'dkfjdlkf';
        }
    }

    //Update Album
    public function updateAlbum($values) {
        $eventName = $values['post']['event'];
        $id = $values['post']['id'];

        $uploadsDir = "../uploads/cover/";
        $prevImage = $values['post']['prev_image'];
        $fileName = !empty($values['files']['image']['name']) ? uniqid() . $values['files']['image']['name'] : $prevImage;

        $tempLocation = $values['files']['image']['tmp_name'];
        $targetFilePath = $uploadsDir . $fileName;

        $filepath = "../uploads/cover/" . $prevImage;

        if (!empty($values['files']['image']['name'])) {
            if (move_uploaded_file($tempLocation, $targetFilePath)) {
                if (is_file($filepath)) {
                    unlink($filepath);
                }
            }
        }

        $condition = "`event_name` = '$eventName', `image` = '$fileName' WHERE id = $id";
        $query = $this->db->updateQuery('`album`', $condition);
        if ($query === TRUE) {
            $_SESSION['update'] = "User record has been updated Successfully!";
            header('Location:../view/albumShow.php');
        }
    }

    //Delete Album
    public function deleteAlbum($id) {
        //Delete with Gallery
        $condition = 'WHERE album_id = ' . $id;
        $gFileResult = $this->db->selectQuery('*', 'gallery', $condition, '');
        while ($gFileRow = $gFileResult->fetch_assoc()) {
            //  $gFileRow = $fileResult->fetch_assoc();
            $gFilepath = "../uploads/gallery/" . $gFileRow['image'];
            $query = $this->db->deleteQuery('`gallery`', $gFileRow['id']);
            if ($query === TRUE) {

                if (is_file($gFilepath)) {
                    unlink($gFilepath);
                }
            }
        }

        //Delete with image
        $condition = 'WHERE id = ' . $id;
        $fileResult = $this->db->selectQuery('image', 'album', $condition, '');
        $fileRow = $fileResult->fetch_assoc();
        $filepath = "../uploads/cover/" . $fileRow['image'];

        $query = $this->db->deleteQuery('`album`', $id);
        if ($query === TRUE) {
            $_SESSION['delete'] = "User record has been deleted Successfully!";
            if (is_file($filepath)) {
                unlink($filepath);
            }
            header('Location: ../view/albumShow.php');
        }
    }

//End Class
}

$album = new Album(); //Album object
//For Create a new Album
if (isset($_POST['create'])) {
    $values = ['post' => $_POST, 'files' => $_FILES];
//    echo '<pre>';
//    print_r($values);
//    exit;
    $album->createAlbum($values);
}

//For Update Album
if (isset($_POST['update'])) {
    $values = ['post' => $_POST, 'files' => $_FILES];
    $album->updateAlbum($values);
}

//For Delete a Album
if (isset($_POST['delete'])) {
    $id = $_POST['del_id'];
    $album->deleteAlbum($id);
    // echo $filepath;exit;
}