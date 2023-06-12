<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$feedback_id = $_POST['feedback_id'];
$player_id = $_POST['player_id'];
$coach_id = $_POST['coach_id'];   // new coach_id field
$feedback_content = $_POST['feedback_content'];

mysqli_autocommit($conn, FALSE); // Autocommit off

$query = "update feedback set player_id = '$player_id', coach_id = '$coach_id', feedback_content = '$feedback_content' where feedback_id = $feedback_id";

$result = mysqli_query($conn, $query);

if(!$result) // If query failed
{
    mysqli_rollback($conn); // Rollback the transaction
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    mysqli_commit($conn); // Commit the transaction
    s_msg ('성공적으로 수정 되었습니다');
    echo "<script>location.replace('feedback_list.php');</script>";
}

mysqli_close($conn); // Close the connection
?>



