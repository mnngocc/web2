<?php
include('admin/modules/result/connection.php');
//include('admin/connect.php');
//	session_start();
$username = $_SESSION['login'];

?>
<link rel="stylesheet" type="text/css" href="css/user-manage-cls-std.css">
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-6 info_">
            <div class="s_tittle"><i>Manage > class</i></div>

            <div class="choose">
                <label for="">Course</label>
                <select name="course" id="course">
                    <option data-tchr="" value="">--choose course--</option>
                    <?php
                    $sql = "SELECT * FROM COURSE,CLASS WHERE COURSE.COURSE_ID=CLASS.COURSE_ID AND CLASS.TEACHER='$username'";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo '<option data-tchr="' . $username . '" value="' . $row["COURSE_ID"] . '">' . $row["COURSE_NAME"] . '</option>';
                    }
                    ?>
                </select>


            </div>
            <table id='list-class'>
                <tr>
                    <td>CLASS ID</td>
                    <td>CLASS NAME</td>
                    <td>INFOMATION</td>
                    <td>BEGIN</td>
                    <td>FINISH</td>
                </tr>
            </table>

        </div>
        <script>
            $(document).ready(function($) {
                $('#course').change(function(event) {
                    courseId = $('#course').val();
                    teacherId = $('#course').find(':selected').data('tchr');
                    $.post('site/user-right/ajax-mn-class.php', {
                        "courseid": courseId,
                        "teacherid": teacherId
                    }, function(data) {
                        $('#list-class').html(data);
                    })
                })

            })
        </script>
    </div>

    <div class="clearfix"></div>
</div>
</div>