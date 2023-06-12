<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$feedback_id = $_POST['feedback_id'];
$player_id = $_POST['player_id'];
$coach_id = $_POST['coach_id'];
$feedback_content = $_POST['feedback_content'];
$feedback_date = $_POST['feedback_date'];

mysqli_autocommit($conn, FALSE); // Autocommit off

$query = "insert into feedback (feedback_id, player_id, coach_id, feedback_content, feedback_date) values('$feedback_id', '$player_id', '$coach_id', '$feedback_content', '$feedback_date')";

$result = mysqli_query($conn, $query);

if(!$result) // If query failed
{
    mysqli_rollback($conn); // Rollback the transaction
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    mysqli_commit($conn); // Commit the transaction
    s_msg ('성공적으로 입력 되었습니다');
    echo "<script>location.replace('feedback_list.php');</script>";
}

mysqli_close($conn); // Close the connection
?>



