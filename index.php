<!doctype html>
<html>
<head>
    <meta charest="utf-8">
    <title>GHOLI KHAH</title>
    <link href="css/style.css" rel="stylesheet"/>
</head>

<body>
<?php
include "connection.php";
if (isset($_POST['submit1'])){
    $classid=$_POST['txt_classid'];
    $classname=$_POST['txt_class'];
    $ins_sql=" INSERT INTO class(class_id,class_name)  VALUES ('$classid','$classname')";
    $ins_sql_pre=$db->prepare($ins_sql);
    $ins_sql_pre->execute();
}
if (isset($_POST['submit2'])) {
    $classid = $_POST['classid'];
    $stud_id = $_POST['studid'];
    $stud_name = $_POST['stud_name'];
    $stud_family = $_POST['stud_family'];
    $stud_ave = $_POST['stud_ave'];
    $ins_sql = "INSERT INTO student(stud_id,class_id,name,family,ave)  VALUES ($stud_id,'$classid','$stud_name','$stud_family','$stud_ave')";
    $ins_sql_pre = $db->prepare($ins_sql);
    $ins_sql_pre->execute();
}
?>
<div id="wrapper">
    <div id="row1">
        <div id="row1_col1">
            <form action="" method="post">
                <fieldset>
                    <legend>Class</legend>
                    <label>class id:</label><br/>
                    <input type="text" name="txt_classid"/><br/>
                    <label>class name:</label><br/>
                    <input type="text" name="txt_class"/>
                    <input type="submit" name="submit1" value="inser-class"/><br/><br/>
                </fieldset>
            </form>
            <table border="1">
                <tr>
                    <td>classid</td>
                    <td>class name</td>
                    <td>delete</td>
                    <td>edit</td>
                </tr>

                <?php
                include "connection.php";
                $query = "SELECT * FROM class";
                $result = $db->prepare($query);
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    echo "
    <tr>
    <td>" . $row['class_id'] . "</td>
    <td>" . $row['class_name'] . "</td>
    <td><a href='delete.php?id=" . $row['class_id'] . "&&page=1'>delete</a> </td>
    <td><a href='edit.php?id=" . $row['class_id'] . "&&page=1'>edit</a> </td>
    </tr>
    ";
                }
                ?>

            </table>
        </div>

        <div id="row1_col2">
            <form action="" method="post">
                <fieldset>
                    <legend>Student</legend>
                    <label>class id</label><br/>
                    <input type="text" name="classid"/><br/>
                    <label>stud id</label><br/>
                    <input type="text" name="studid"/><br/>
                    <label>name</label><br/>
                    <input type="text" name="stud_name"/><br/>
                    <label>family</label><br/>
                    <input type="text" name="stud_family"/><br/>
                    <label>average</label><br/>
                    <input type="text" name="stud_ave"/><br/>
                    <input type="submit" name="submit2" value="inser-student"/>
                </fieldset>

            </form>
            <table border="1">
                <tr>
                    <td>stud id</td>
                    <td>class id</td>
                    <td>name</td>
                    <td>family</td>
                    <td>average</td>
                    <td>delete</td>
                    <td>edit</td>
                </tr>


                <?php
                include "connection.php";
                $query = "SELECT * FROM student";
                $result = $db->prepare($query);
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    echo "
    <tr>
     <td>" . $row['class_id'] . "</td>
      <td>" . $row['stud_id'] . "</td>
    <td>" . $row['name'] . "</td>
    <td>" . $row['family'] . "</td>
    <td>" . $row['ave'] . "</td>
    <td><a href='delete.php?id=" . $row['stud_id'] . "&&page=2'>delete</a> </td>
    <td><a href='edit.php?id=" . $row['stud_id'] . "&&page=2'>edit</a> </td>
    </tr>
    ";
                }
                ?>

            </table>
        </div>
    </div>
</div>
<div id="show_list">
    <form method="post">
        <label>class name</label><br/>
        <select name="select1" id="select1">
            <?php
            include "connection.php";
            $sql_option=" SELECT * FROM class";
            $sql_option_pre=$db->prepare($sql_option);
            $sql_option_pre->execute();
            while ($rows=$sql_option_pre->fetch(PDO::FETCH_ASSOC)){
                echo "<option value='".$rows['class_id']."'>".$rows['class_name']."</option>";
            }
            ?>
        </select>
        <input type="submit" name="sub" value="select">

    </form>
    <table>
        <tr>
            <td> name </td>
            <td> family </td>
            <td> ave </td>
        </tr>
        <?php
        include "connection.php";
        if (isset($_POST['sub'])){
            echo "<script>alert('ok');</script>";
            $id=$_POST['select1'];
            $sql_show="select * FROM student WHERE class_id=".$id;
            $sql_show_pre=$db->prepare($sql_show);
            $sql_show_pre->execute();
            while ($row=$sql_show_pre->fetch(PDO::FETCH_ASSOC)){
                echo '
                 <tr>
     <td>' . $row['name'] . '</td>
      <td>' . $row['family'] . '</td>
    <td>' . $row['ave'] . '</td>
    </tr>
                ';

            }
        }
        ?>
    </table>
</div>
</body>
</html>




















