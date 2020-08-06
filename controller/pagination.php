<?php
require_once 'connect.php';
require_once '../controller/userController.php';

class Pagination extends DB {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function paginate($paginationArr, $requestArr = []) {

        $page_no = !empty($paginationArr['page_no']) ? $paginationArr['page_no'] : 0;
        $total_no_of_pages = !empty($paginationArr['total_no_of_pages']) ? $paginationArr['total_no_of_pages'] : 0;
        $previous_page = !empty($paginationArr['previous_page']) ? $paginationArr['previous_page'] : 0;
        $next_page = !empty($paginationArr['next_page']) ? $paginationArr['next_page'] : 0;
        $second_last = !empty($paginationArr['second_last']) ? $paginationArr['second_last'] : 0;
        
        $requestId = !empty($requestArr) ? '&' . $requestArr['key'] . '=' . $requestArr['value'] : ''; 
        ?>
        <table border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="page">
                    <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
                </td>
                <td>
                    <ul class="nav">
                        <?php
                        if ($page_no > 1) {
                            echo "<li><a href='?page_no=1'>&#10218;</a></li>";
                        }
                        if ($page_no == 1) {
                            echo "<li><a class = 'disabled'>&#10218;</a></li>";
                            echo "<li><a class = 'disabled'>&#10216;</a></li>";
                        }
                        ?>
                        <li>
                            <?php
                            if ($page_no > 1) {
                                //$t="galleryShow.php?page_no=".$previous_page."&id=".$album_id;
                                // echo $t;
                                // exit;

                                echo "<a href='?page_no=".$previous_page.$requestId."'> &#10216;</a>";
                            }
                            ?>

                        </li>


                        <?php
                        if ($total_no_of_pages <= 5) {
                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                if ($counter == $page_no) {
                                    echo "<li class='active'><a>$counter</a></li>";
                                } else {
                                    echo "<li><a href='?page_no=".$counter.$requestId."'>$counter</a></li>";
                                }
                            }
                        } elseif ($total_no_of_pages > 10) {
                            if ($page_no < 3) {
                                for ($counter = $page_no; $counter < ($page_no + 2); $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='active'><a>$counter</a></li>";
                                    } else {
                                        echo "<li><a href='?page_no=".$counter.$requestId."'>$counter</a></li>";
                                    }
                                }
                                echo "<li><a>...</a></li>";
                                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                            } elseif ($page_no >= 3 && $page_no < 9) {
                                for ($counter = $page_no; $counter < ($page_no + 2); $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='active'><a>$counter</a></li>";
                                    } else {
                                        echo "<li><a href='?page_no=".$counter.$requestId."'>$counter</a></li>";
                                    }
                                }
                                echo "<li><a>...</a></li>";
                                for ($counter = $total_no_of_pages - 1; $counter <= $total_no_of_pages; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='active'><a>$counter</a></li>";
                                    } else {
                                        echo "<li><a href='?page_no=".$counter.$requestId."'>$counter</a></li>";
                                    }
                                }
                            } else {
                                for ($counter = $page_no; $counter <= $total_no_of_pages; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='active'><a>$counter</a></li>";
                                    } else {
                                        echo "<li><a href='?page_no=".$counter.$requestId."'>$counter</a></li>";
                                    }
                                }
                            }
                        }
                        ?>
                        <li <?php
                if ($page_no >= $total_no_of_pages) {
                    echo "class='disabled'";
                }
                        ?>>
                            <?php
                                if ($page_no < $total_no_of_pages) {


                                    echo "<a href='?page_no=".$next_page.$requestId."'>&#10217;</a>";
                                }
                                ?>
                        </li>

                        <?php
                        if ($page_no < $total_no_of_pages) {
                            echo "<li><a href='?page_no=".$total_no_of_pages.$requestId."'>&#10219;</a></li>"; //&rsaquo;&rsaquo;
                        }
                        if ($page_no == $total_no_of_pages) {
                            echo "<li><a class = 'disabled'>&#10217;</a></li>";
                            echo "<li><a class = 'disabled'>&#10219;</a></li>";
                        }
                        ?>
                    </ul>
                </td>
            </tr>
        </table>

        <?php
    }

//End Class    
}
