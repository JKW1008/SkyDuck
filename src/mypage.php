<?php
    include "./inc/common.php";
    include "./inc/dbconfig.php";

    $db = $pdo;

    include "./inc/member.php";

    $mem = new Member($db);

    if ($ses_id == '') {
        echo "<script>
            alert('로그인해주세요');
            window.location.href = './member_login.php';
        </script>";
    };

    if ($ses_grade != 'common_member') {
        echo "<script>
            alert('잘못된 접근');
            window.location.href = './index.php';
        </script>";
    };

    $memArr = $mem->getInfoFormId($ses_id);
    // print_r($memArr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemberInput</title>

</head>

<body>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="./js/mypage.js"></script>
    <div id="inputform">
        <!-- Array ( [IDX] => 1 [ID] => znqptkzp [Password] => $2y$10$WIwOEqcAyCDtWmq6Th/.auHtKJKlMzQIUl9Aao/Ed1YPeiw.AINBW
        [Email] => znqptkzp@gmail.com [Name] => 정강우 [MobileNumber] => 010-8564-4780 [PhoneNumber] => 010-8564-4780
        [ZipCode] => 13529 [Address] => (백현동, 카카오 판교 아지트) [DetailAddress] => 2층 [SignupDate] => 2024-01-31 02:30:16 ) -->

        <input type="hidden" name="idx" value="<?= $memArr['IDX']; ?>">
        <input type="hidden" name="email_chk" id="email_chk" value="0">
        <input type="hidden" name="old_email" id="old_email" value="<?= $memArr['Email']; ?>">

        <label for="member_id">아이디</label>
        <input type="text" name="id" id="member_id" value="<?= $memArr['ID'] ?>" placeholder="아이디를 입려해 주세요" readonly>
        <label for="member_password">비밀번호</label>
        <input type="password" name="password" id="member_password" placeholder="비밀번호를 입력해 주세요">
        <label for="member_password_check">비밀번호확인</label>
        <input type="password" name="password_check" id="member_password_check" placeholder="비밀번호를 다시 입력해 주세요">
        <div id="emailWrap">
            <label for="member_email">이메일</label>
            <?php
        $email = $memArr['Email'];
        $parts = explode('@', $email);
        $beforeAtSymbol = $parts[0];
        $domain = $parts[1];
    ?>
            <input type="text" id="member_email" name="email" value="<?= $beforeAtSymbol ?>" placeholder="이메일을 입력해주세요">

            <select name="email_domain" id="email_domain">
                <option value="gmail.com" <?= ($domain == 'gmail.com') ? 'selected' : '' ?>>gmail.com</option>
                <option value="naver.com" <?= ($domain == 'naver.com') ? 'selected' : '' ?>>naver.com</option>
                <option value="kakao.com" <?= ($domain == 'kakao.com') ? 'selected' : '' ?>>kakao.com</option>
                <option value="hanmail.net" <?= ($domain == 'hanmail.net') ? 'selected' : '' ?>>hanmail.net</option>
                <option value="manual_input"
                    <?= (!in_array($domain, ['gmail.com', 'naver.com', 'kakao.com', 'hanmail.net'])) ? 'selected' : '' ?>>
                    직접입력</option>
            </select>

            <input type="text" id="manual_email_input"
                value="<?= (!in_array($domain, ['gmail.com', 'naver.com', 'kakao.com', 'hanmail.net'])) ? $domain : '' ?>"
                placeholder="이메일을 입력해 주세요">

            <button id="btn_member_email_check" type="button">이메일 중복확인</button>
        </div>

        <label for="member_name">이름</label>
        <input type="text" name="name" id="member_name" placeholder="이름을 입력해 주세요" value="<?= $memArr['Name'] ?>">
        <div id="mobileWrap">
            <?php
                $mobileNumber = $memArr['MobileNumber'];
                $mparts = explode('-', $mobileNumber);
            ?>
            <label for="member_mobile">전화 번호</label>
            <input type="text" id="member_mobile" name="member_mobile" pattern="[0-9]{3}" value="<?= $mparts[0] ?>"> -
            <input type="text" id="member_mobile2" name="member_mobile2" pattern="[0-9]{4}" value="<?= $mparts[1] ?>"> -
            <input type="text" id="member_mobile3" name="member_mobile3" pattern="[0-9]{4}" value="<?= $mparts[2] ?>">
        </div>
        <div id="phoneWrap">
            <label for="member_phone">전화 번호</label>
            <?php
                $phoneNumber = $memArr['PhoneNumber'];
                $pparts = explode('-', $phoneNumber);
            ?>
            <input type="text" id="member_phone" name="member_phone" pattern="[0-9]{3}" value="<?= $mparts[0] ?>"> -
            <input type="text" id="member_phone2" name="member_phone2" pattern="[0-9]{4}" value="<?= $mparts[1] ?>"> -
            <input type="text" id="member_phone3" name="member_phone3" pattern="[0-9]{4}" value="<?= $mparts[2] ?>">
        </div>
        <div id="addressWrap">
            <label for="member_zipcode">우편번호</label>
            <input type="text" name="zipcode" id="member_zipcode" readonly value="<?= $memArr['ZipCode']; ?>">
            <button id="btn_zipicode" type="button">우편번호 찾기</button>
            <div class="w-50">
                <label for="member_addr1">주소</label>
                <input type="text" name="member_addr1" id="member_addr1" placeholder=""
                    value="<?= $memArr['Address']; ?>">
            </div>
            <div class="w-50">
                <label for="member_addr2">상세주소</label>
                <input type="text" name="member_addr2" id="member_addr2" placeholder="상세주소를 입력해 주세요"
                    value="<?= $memArr['DetailAddress'] ?>">
            </div>
        </div>
        <div id="buttonwrap">
            <button id="edit_btn" type="button">수정 확인</button>
        </div>
    </div>
</body>

</html>