<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$feedback_id = $_GET['feedback_id'];

mysqli_autocommit($conn, FALSE); // Autocommit off

$fid_ret = mysqli_query($conn, "select feedback_id from feedback where feedback_id = $feedback_id");

if(mysqli_fetch_array($fid_ret)){
	$ret = mysqli_query($conn, "delete from feedback where feedback_id = $feedback_id");

	if(!$ret)
	{
		mysqli_rollback($conn); // Rollback the transaction
	    msg('Query Error : '.mysqli_error($conn));
	}
	else
	{
		mysqli_commit($conn); // Commit the transaction
	    s_msg ('성공적으로 삭제 되었습니다');
	    echo "<meta http-equiv='refresh' content='0;url=feedback_list.php'>";
	}	
}
else{
	s_msg ('존재하지 않는 피드백입니다.');
    echo "<meta http-equiv='refresh' content='0;url=feedback_list.php'>";
}

mysqli_close($conn); // Close the connection
?>

