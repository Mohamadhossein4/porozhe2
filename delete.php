<?php session_start(); ob_start();
include "connection.php";
if (isset($_GET['id']) && isset($_GET['page'])) {
    $id = $_GET['id'];
    $page = $_GET['page'];
    switch ($page) {
        case 1:
            $query = "DELETE FROM class WHERE class_id=" . $id;
            $del = $db->prepare($query);
            $del->execute();
            header("location:index.php");
            break;
        case 2:
            $query = "DELETE FROM student WHERE stud_id=" . $id;
            $del = $db->prepare($query);
            $del->execute();
            header("location:index.php");
            break;
    }
}