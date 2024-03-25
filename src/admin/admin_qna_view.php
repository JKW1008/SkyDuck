<?php
    session_start();

    $ses_id = (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] != '') ? $_SESSION['ses_id'] : '';

    // 로그아웃 로직
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        session_destroy();
        header("Location: ../index.php");
        exit();
    }

    if ($ses_id != 'skyduck_admin') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './admin_login.php';
        </script>";
    }

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/qna.php";
    include "../inc/lib.php";   

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
    };

    $qna = new Qna($db);

    $row = $qna->getInfoFormIdx($idx);
    // print_r($row);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/admin_main.css">
    <link rel="stylesheet" href="./css/admin_qna_view.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
          <!--테일윈드 CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <!-- 제이쿼리 -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</head>

<body>
    <script src="./js/admin_qna_view.js"></script>
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

    <div class="w-4/5 m-auto pt-7">
    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5">
        <div class="flex max-[1100px]:block ">
            <div class="w-1/3 max-[1100px]:w-full ps-2 pb-3">
                <h2 class=" font-bold">
                    <p>상담에 필요한 기본정보를</p>
                    <p>입력해 주세요</p>
                </h2>
            </div class="w-1/5 max-[369px]:w-full">
            <div class="w-full grid grid-cols-2 gap-1 lg:grid-cols-3 ps-2 pb-3">
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="text" id="qna_name" placeholder="이름" name="user_name" value="<?= $row['name'] ?>" readonly>
                </div>
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="tel" id="qna_tel" placeholder="연락처" name="user_phone" value="<?= $row['contact_number'] ?>" readonly>
                    
                </div>
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="email" id="qna_email" placeholder="이메일" name="user_email" value="<?= $row['email'] ?>" readonly>
                    
                </div>
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="text" id="qna_company_name" placeholder="회사명" name="company_name" value="<?= $row['company_name'] ?>" readonly>
                    
                </div>
                <div class="w-full"><input class="rounded-md border-[#D9D9D9] placeholder-slate-400 w-full" type="text" id="qna_grade" placeholder="직급" name="company_rank" value="<?= $row['position'] ?>" readonly></div>
                <div class="w-full"><input class="rounded-md border-[#D9D9D9] placeholder-slate-400 w-full" type="text" id="qna_user_page" placeholder="홈페이지" name="user_homepage" value="<?= $row['website'] ?>" readonly></div>
            </div>
        </div>
    </div>

    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5">
        <div class="flex max-[1100px]:block ">
            <div class="w-1/3 max-[1100px]:w-full ps-2 pb-3">
                <h2 class=" font-bold">
                    <p>어떤 서비스가 필요하신가요?</p>
                    <p>다중선택이 가능합니다.</p>
                </h2>
            </div>
            <div class="w-full grid grid-cols-2 md:grid-cols-4 sm:grid-cols-3 gap-1 ps-2 pb-3  ">
            <?php
                $service_required = explode(',', $row['service_required']);
                // Remove 'on' from each service
                // $service_required = array_map(function($service) {
                //     return str_replace('/on', '', $service);
                // }, $service_required);
                // print_r($service_required);
            ?>
                <div><input type="checkbox" value="Catalog/Brochure" <?= in_array("Catalog/Brochure", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">카타로그/브로슈어</span></div>
                <div><input type="checkbox" value="Leaflet/Pamphlet" <?= in_array("Leaflet/Pamphlet", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">리플렛/팜플릿</span></div>
                <div><input type="checkbox" value="Poster"><span class="ps-2">포스터</span></div>
                <div><input type="checkbox" value="Package" <?= in_array("Poster", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">패키지</span></div>
                <div><input type="checkbox" value="Newsletter/Book" <?= in_array("Newsletter/Book", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">사보/책</span></div>
                <div><input type="checkbox" value="Advertisement" <?= in_array("Advertisement", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">지면광고</span></div>
                <div><input type="checkbox" value="RFP" <?= in_array("RFP", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">제안서</span></div>
                <div><input type="checkbox" value="Others" <?= in_array("Others", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">기타</span></div>
            </div>
        </div>
    </div>

    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5">
        <div class="flex max-[1100px]:block ">
            <div class="w-1/3 max-[1100px]:w-full ps-2 pb-3">
                <h2 class=" font-bold">예산과 일정은 어떻게 되나요</h2>
            </div>
            <div class="w-full flex ps-2 pb-3 space-x-3">
                <div class="w-full flex items-center gap-2">
                    <label class="max-[766px]:hidden w-1/6" for="qna_budget">예산 <span class="text-red-600">*</span></label>
                    <input class="rounded-md border-[#D9D9D9] w-full" type="text" id="qna_budget" placeholder="예산을 입력해 주세요" value="<?= $row['budget'] ?>">
                </div>
                <div class="w-full flex items-center gap-2">
                    <label class="max-[766px]:hidden w-1/6" for="qna_schedule">일정 <span class="text-red-600">*</span></label>
                    <input class="rounded-md border-[#D9D9D9] w-full " type="text" id="qna_schedule" placeholder="일정을 입력해 주세요" value="<?= $row['timeline'] ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5">
        <div class="flex max-[1100px]:block ">
            <div class="w-1/3 max-[1100px]:w-full ps-2 pb-3">
                <h2 class=" font-bold">
                    <p>자세히 알려주시면</p>
                    <p> 정확한 견적에 도움이 됩니다</p>
                </h2>
            </div>
            <div class="w-full flex ps-2 pb-3 space-x-3">
                <textarea class="w-full rounded-md border-[#D9D9D9]  placeholder-slate-400" name="qna_content" id="qna_content" cols="20" rows="10" placeholder="
        제목: ex 카탈로그/브로슈어, 리플렛/팜플렛, 포스터, 제안서 등 
        사이즈: 
        페이지 수:
        인쇄 부수:
        추가설명: ex 종이종류 및 재질/코팅유무/후가공 등
                " readonly><?= $row['additional_notes'] ?></textarea>
            </div>
        </div>
    </div>
    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5"><button class="rounded-md bg-black text-white font-bold p-[10px]" type="button" id="qna_submit">뒤로</button></div>
    </div>
   
</body>

</html>