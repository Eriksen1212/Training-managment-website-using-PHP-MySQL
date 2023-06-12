<?php
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$feedback_id = $_GET['feedback_id'];

$query = "select feedback.feedback_id, player.player_name, coach.coach_name, feedback.feedback_content, feedback.feedback_date from feedback join player on feedback.player_id = player.player_id join coach on feedback.coach_id = coach.coach_id where feedback_id = $feedback_id";

$res = mysqli_query($conn, $query);
if (!$res) {
     die('Query Error : ' . mysqli_error());
}

$feedback = mysqli_fetch_assoc($res);
if (!$feedback) {
    msg("피드백이 존재하지 않습니다.");
}
?>

<div class="container">
    <h1>피드백 상세 정보</h1>
    <p>
        <label for="feedback_id">피드백 ID:</label>
        <input type="text" id="feedback_id" name="feedback_id" value="<?=$feedback['feedback_id']?>" readonly/>
    </p>
    <p>
        <label for="player_name">선수명:</label>
        <input type="text" id="player_name" name="player_name" value="<?=$feedback['player_name']?>" readonly/>
    </p>
    <p>
        <label for="coach_name">코치명:</label>
        <input type="text" id="coach_name" name="coach_name" value="<?=$feedback['coach_name']?>" readonly/>
    </p>
    <p>
        <label for="feedback_content">피드백 내용:</label>
        <textarea id="feedback_content" name="feedback_content" readonly><?=$feedback['feedback_content']?></textarea>
    </p>
    <p>
        <label for="feedback_date">피드백 날짜:</label>
        <input type="text" id="feedback_date" name="feedback_date" value="<?=$feedback['feedback_date']?>" readonly/>
    </p>
</div>

<?php include("footer.php") ?>
