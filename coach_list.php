<?php
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$query = "select * from coach order by coach_id desc";
$res = mysqli_query($conn, $query);

if (!$res) {
    die('Query Error : ' . mysqli_error());
}
?>

<div class="container">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>코치명</th>
            <th>생년월일</th>
            <th>나이</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            $birthdate = new DateTime($row['birthdate']);
            $today   = new DateTime('today');
            $age = $birthdate->diff($today)->y;
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['coach_name']}</td>";
            echo "<td>{$row['birthdate']}</td>";
            echo "<td>{$age}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</div>

<?php include("footer.php") ?>

