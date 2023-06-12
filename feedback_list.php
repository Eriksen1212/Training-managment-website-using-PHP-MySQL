<?php
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

// Search Term
$search_term = mysqli_real_escape_string($conn, $_GET['search']);

// Construct the Query
$query = "select feedback.feedback_id, player.player_name, coach.coach_name, feedback.feedback_content, feedback.feedback_date from feedback join player on feedback.player_id = player.player_id join coach on feedback.coach_id = coach.coach_id WHERE player.player_name LIKE '%$search_term%' OR coach.coach_name LIKE '%$search_term%' OR feedback.feedback_content LIKE '%$search_term%' order by feedback.feedback_id desc";

$res = mysqli_query($conn, $query);
if (!$res) {
     die('Query Error : ' . mysqli_error());
}
?>

<div class="container">
    <form action="feedback_list.php" method="get">
        <input type="text" name="search" placeholder="검색어를 입력하세요.">
        <input type="submit" value="검색">
    </form>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>선수명</th>
            <th>코치명</th>
            <th>피드백 내용</th>
            <th>작업</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['player_name']}</td>";
            echo "<td>{$row['coach_name']}</td>";
            echo "<td>{$row['feedback_content']}</td>";
            echo "<td width='15%'>
                <a href='feedback_form.php?feedback_id={$row['feedback_id']}'><button class='button primary small'>수정</button></a>
                <a href='feedback_detail.php?feedback_id={$row['feedback_id']}'><button class='button primary small'>상세보기</button></a>
                <button onclick='javascript:deleteConfirm({$row['feedback_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(feedback_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "feedback_delete.php?feedback_id=" + feedback_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<?php include("footer.php") ?>
