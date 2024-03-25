<?php
include "../inc/common.php";

include "../inc/dbconfig.php";

$db = $pdo;

include "../inc/member.php";

$mem = new Member($db);

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    header("Location: ../index.php");
    exit();
};

if ($ses_id != 'skyduck_admin') {
    echo "<script>
            alert('접근 권한 없음');
            window.location.href = './admin_login.php';
        </script>";
};

$idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

if ($idx == '') {
    die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
}

$row = $mem->getInfoFormIdx($idx);
// print_r($row); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemberInput</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/main.css">
    <!--테일윈드 CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <!-- 제이쿼리 -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>


</head>

<body>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="./js/admin_member_edit.js"></script>
    <div class="area"></div>
    <nav class="main-menu">
        <ul>
            <li>
                <a href="./admin_main.php">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        메인
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./admin_member.php">
                    <i class="fa fa-globe fa-2x"></i>
                    <span class="nav-text">
                        회원관리
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./admin_business_member.php">
                    <i class="fa fa-comments fa-2x"></i>
                    <span class="nav-text">
                        사업자 회원 관리
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./admin_qna.php">
                    <i class="fa fa-camera-retro fa-2x"></i>
                    <span class="nav-text">
                        문의 관리
                    </span>
                </a>

            </li>
            <li>
                <a href="./admin_board.php">
                    <i class="fa fa-film fa-2x"></i>
                    <span class="nav-text">
                        게시판 관리
                    </span>
                </a>
            </li>
            <li>
                <a href="./admin_portfolio.php">
                    <i class="fa fa-book fa-2x"></i>
                    <span class="nav-text">
                        포트폴리오 관리
                    </span>
                </a>
            </li>
        </ul>

        <ul class="logout">
            <li>
                <a href="?logout=1">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">
                        로그아웃
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="w-4/5 m-auto pt-9">
        <!-- Array ( [IDX] => 1 [ID] => znqptkzp [Password] => $2y$10$WIwOEqcAyCDtWmq6Th/.auHtKJKlMzQIUl9Aao/Ed1YPeiw.AINBW
        [Email] => znqptkzp@gmail.com [Name] => 정강우 [MobileNumber] => 010-8564-4780 [PhoneNumber] => 010-8564-4780
        [ZipCode] => 13529 [Address] => (백현동, 카카오 판교 아지트) [DetailAddress] => 2층 [SignupDate] => 2024-01-31 02:30:16 ) -->

        <input type="hidden" name="idx" value="<?= $row['IDX']; ?>">
        <input type="hidden" name="email_chk" id="email_chk" value="0">
        <input type="hidden" name="old_email" id="old_email" value="<?= $row['Email']; ?>">
        <div class="flex max-[369px]:block ">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_id">아이디 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <div class="flex justify-between gap-1 max-[369px]:block max-[369px]:space-y-2 ">
                    <input class="rounded-md border-[#D9D9D9] w-full max-[369px]:w-full " type="text" name="id" id="member_id" value="<?= $row['ID'] ?>" readonly>
                    <!-- <button class="rounded-md bg-[#182548] w-2/6 text-white font-bold text-base py-2 px-3 max-[369px]:w-full" id="btn_member_id_check" type="button">아이디 중복확인</button> -->
                </div>
                <p class="text-[#7D7D7D] text-xs">(영문소문자/숫자, 4~16자)</p>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_password">비밀번호 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <input class="w-full rounded-md border-[#D9D9D9]" type="password" name="password" id="member_password" placeholder="비밀번호를 입력해 주세요">
                <p class="text-[#7D7D7D] text-xs">(영문 대소문자/숫자/특수문자 중 2가지 이상 조합, 8자~16자)</p>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_password_check">비밀번호확인 <p class="text-red-600">*</p></label></div>
            <input class="w-full  rounded-md border-[#D9D9D9]" type="password" name="password_check" id="member_password_check" placeholder="비밀번호를 다시 입력해 주세요">
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5"><label class="flex pt-2" for="member_email">이메일 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
            <?php
            $email = $row['Email'];
            $parts = explode('@', $email);
            $beforeAtSymbol = $parts[0];
            $domain = $parts[1];
            ?>
                <div class="flex justify-between items-center gap-4 max-[369px]:block">
                    <input class="w-1/4 max-[369px]:w-1/3  rounded-md border-[#D9D9D9]" type="text" id="member_email" name="email" placeholder="이메일을 입력해주세요" value="<?= $beforeAtSymbol ?>">@
                    <select class="w-1/4  max-[369px]:w-1/3   rounded-md border-[#D9D9D9]" name="email_domain" id="email_domain">
                        <option value="manual_input" <?= (!in_array($domain, ['gmail.com', 'naver.com', 'kakao.com', 'hanmail.net'])) ? 'selected' : '' ?>>직접입력</option>
                        <option value="gmail.com" <?= ($domain == 'gmail.com') ? 'selected' : '' ?>>gmail.com</option>
                        <option value="naver.com" <?= ($domain == 'naver.com') ? 'selected' : '' ?>>naver.com</option>
                        <option value="kakao.com" <?= ($domain == 'kakao.com') ? 'selected' : '' ?>>kakao.com</option>
                        <option value="hanmail.net" <?= ($domain == 'hanmail.net') ? 'selected' : '' ?>>hanmail.net</option>
                    </select>
                    <input class="w-1/4  max-[369px]:w-1/4   rounded-md border-[#D9D9D9]" type="text" id="manual_email_input" placeholder="이메일을 입력해 주세요">
                </div>
                <button class="mt-2 rounded-md bg-[#182548] w-full text-white font-bold text-base py-2 px-3 " id="btn_member_email_check" type="button">이메일 중복확인</button>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_name">이름 <p class="text-red-600">*</p></label></div>
            <input class="rounded-md border-[#D9D9D9] w-full" type="text" name="name" id="member_name" placeholder="이름을 입력해 주세요" value="<?= $row['Name'] ?>">
        </div>

        <div class="flex mt-4 max-[369px]:block" id="mobileWrap">
        <?php
            $mobileNumber = $row['MobileNumber'];
            $mparts = explode('-', $mobileNumber);
            ?>
            <div class="w-1/5 pt-2 max-[369px]:w-full"><label for="member_mobile">전화 번호</label></div>
            <div class="w-full flex justify-between items-center gap-2">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_mobile" name="member_mobile" pattern="[0-9]{3}" value="<?= $mparts[0] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9]" type="text" id="member_mobile2" name="member_mobile2" pattern="[0-9]{4}" value="<?= $mparts[1] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9]" type="text" id="member_mobile3" name="member_mobile3" pattern="[0-9]{4}" value="<?= $mparts[2] ?>">
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block" id="phoneWrap">
        <?php
            $phoneNumber = $row['PhoneNumber'];
            $pparts = explode('-', $phoneNumber);
            ?>
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_phone">휴대전화 <p class="text-red-600">*</p></label></div>
            <div class="w-full flex justify-between items-center gap-2">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_phone" name="member_phone" pattern="[0-9]{3}" value="<?= $pparts[0] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_phone2" name="member_phone2" pattern="[0-9]{4}" value="<?= $pparts[1] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_phone3" name="member_phone3" pattern="[0-9]{4}" value="<?= $pparts[2] ?>">
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block" id="addressWrap">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_phone">주소 <p class="text-red-600">*</p></label></div>
            <div class="w-full space-y-2">
                <div class="flex justify-between">
                    <input class=" w-3/5 rounded-md border-[#D9D9D9]" type="text" name="zipcode" id="member_zipcode" readonly value="<?= $row['ZipCode']; ?>">
                    <button class="rounded-md bg-[#182548] w-2/6 text-white font-bold text-base py-2 px-3 " id="btn_zipicode" type="button">우편번호 찾기</button>
                </div>

                <div class="w-full">
                    <input class="w-full rounded-md border-[#D9D9D9]" type="text" name="member_addr1" id="member_addr1" placeholder="" value="<?= $row['Address']; ?>">

                </div>

                <div class="w-full"><input class="w-full rounded-md border-[#D9D9D9]" type="text" name="member_addr2" id="member_addr2" placeholder="상세주소를 입력해 주세요" value="<?= $row['DetailAddress'] ?>"></div>

            </div>
        </div>
    </div>
  
       
        <div class="flex justify-center gap-4 pt-3" id="buttonwrap">
            <button class="rounded-md bg-black text-white font-bold p-[10px]" id="edit_btn" type="button">수정 확인</button>
            <button class="rounded-md bg-black text-white font-bold p-[10px]" id="view_all" type="button">전체보기</button>
        </div>
    
</body>

</html>