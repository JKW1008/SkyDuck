<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['body'])) {
    $inputs = json_decode($_POST['body'], true);

    // 입력값 확인
    foreach ($inputs as $key => $value) {
        if (empty($value)) {
            http_response_code(400); // 잘못된 요청으로 처리
            echo "입력값이 부족합니다.";
            exit;
        }
    }

    $body_content = '';
    foreach ($inputs as $key => $value) {
        $body_content .= $key . ': ' . $value . "\n";
    }

    $ch = curl_init();
    $url = 'http://push.doday.net/api/push';
    $data = array(
        'uuid' => '6974153b33be7e04',
        'secret_key' => 'Ll9hS94t97',
        'code' => 'skyduckdesign',
        'body' => $body_content
    );
    // $data = array(
    //     'uuid' => 'a69e033ff97eb7d6',
    //     'secret_key' => 'hOacbTxluU',
    //     'code' => 'KdPushQueue',
    //     'body' => $body_content
    // );

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // HTTP 응답 코드 가져오기
    curl_close($ch);

    if ($httpCode === 200) {
        http_response_code(200); // 성공적인 요청으로 처리
        echo $result;
    } else {
        http_response_code($httpCode); // 외부 API 요청 실패로 처리
        echo "외부 API와의 통신에 문제가 발생했습니다.";
    }
} else {
    http_response_code(400); // 잘못된 요청으로 처리
    echo "잘못된 요청입니다.";
}
?>