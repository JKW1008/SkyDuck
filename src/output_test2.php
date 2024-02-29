<?php
include "./inc/dbconfig.php";

try {
    // 쿼리를 준비
    $stmt = $pdo->prepare('SELECT attachments FROM sd_Question_board WHERE idx = 4');

    // 쿼리 실행
    $stmt->execute();

    // 결과를 가져와서 JSON 형식으로 출력
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode(['attachments' => $row['attachments']]);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>