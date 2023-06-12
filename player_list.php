<?php
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?php
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from player";
    
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>Player ID</th>
            <th>Player Name</th>
            <th>Birthdate</th>
        </tr>
        </thead>
        <?php
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['player_id']}</td>";
            echo "<td>{$row['player_name']}</td>";
            echo "<td>{$row['birthdate']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
</div>
<?php include("footer.php") ?>
