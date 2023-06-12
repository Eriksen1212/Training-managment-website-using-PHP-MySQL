<?php
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "feedback_insert.php";

if (array_key_exists("feedback_id", $_GET)) {
    $feedback_id = $_GET["feedback_id"];
    $query =  "select * from feedback where feedback_id = $feedback_id";
    $result = mysqli_query($conn, $query);
    $feedback = mysqli_fetch_array($result);
    if(!$feedback) {
        msg("피드백이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "feedback_modify.php";
}

$players = array();
$coaches = array();

$query = "select * from player";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $players[$row['player_id']] = $row['player_name'];
}

$query = "select * from coach";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $coaches[$row['coach_id']] = $row['coach_name'];
}

?>

<div class="container">
    <form name="feedback_form" action="<?=$action?>" method="post" class="fullwidth">
        <input type="hidden" name="feedback_id" value="<?=$feedback['feedback_id']?>"/>
        <h3>피드백 <?=$mode?></h3>
        <p>
            <label for="player_id">선수</label>
            <select name="player_id" id="player_id">
                <option value="-1">선택해 주십시오.</option>
                <?php
                    foreach($players as $id => $name) {
                        if($id == $feedback['player_id']){
                            echo "<option value='{$id}' selected>{$name}</option>";
                        } else {
                            echo "<option value='{$id}'>{$name}</option>";
                        }
                    }
                ?>
            </select>
        </p>
        <p>
            <label for="coach_id">코치</label>
            <select name="coach_id" id="coach_id">
                <option value="-1">선택해 주십시오.</option>
                <?php
                    foreach($coaches as $id => $name) {
                        if($id == $feedback['coach_id']){
                            echo "<option value='{$id}' selected>{$name}</option>";
                        } else {
                            echo "<option value='{$id}'>{$name}</option>";
                        }
                    }
                ?>
            </select>
        </p>
        <p>
            <label for="feedback_date">피드백 날짜</label>
            <input type="date" placeholder="피드백 날짜 입력" id="feedback_date" name="feedback_date" value="<?=$feedback['feedback_date']?>"/>
        </p>
        <p>
            <label for="feedback_content">피드백 내용</label>
            <textarea placeholder="피드백 내용 입력" id="feedback_content" name="feedback_content" rows="10"><?=$feedback['feedback_content']?></textarea>
        </p>
        <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

        <script>
            function validate() {
                if(document.getElementById("player_id").value == "-1") {
                    alert ("선수를 선택해 주십시오"); return false;
                }
                else if(document.getElementById("coach_id").value == "-1") {
                    alert ("코치를 선택해 주십시오"); return false;
                }
                else if(document.getElementById("feedback_date").value == "") {
                    alert ("피드백 날짜를 입력해 주십시오"); return false;
                }
                else if(document.getElementById("feedback_content").value == "") {
                    alert ("피드백 내용을 입력해 주십시오"); return false;
                }
                return true;
            }
        </script>

    </form>
</div>
<?php include("footer.php") ?>
