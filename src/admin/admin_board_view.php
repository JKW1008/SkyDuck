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

    include "../inc/Questionboard.php";
    include "../inc/reply.php";

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                self.location.href = './admin_board.php';
            </script>
        ");
    };

    $board = new Board($db);
    $reply = new Reply($db);

    $row = $board->getInfoFormIdx($idx);
    $replyrow = $reply->getInfoBoardIdx($idx);
    // print_r($row);
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
    <link rel="stylesheet" href="./css/admin_board_view.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
        <!--테일윈드 CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <!-- 제이쿼리 -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="./js/admin_board_view.js"></script>
</head>

<body>
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
    <div class="w-2/3 m-auto pt-10" id="">
    <table class="w-2/3 ">
        <div class="flex border-t-2 border-black">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="name">이름<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="text" id="name" name="name" required value="<?= $row['name'] ?>" readonly></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="password">비밀번호<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="text" id="password" name="password" min="1000" max="9999" required value="<?= $row['password'] ?>" readonly></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="email">이메일<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="email" id="email" name="email" required value="<?= $row['email'] ?>" readonly></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="phone_number">전화번호<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="tel" id="phone_number" name="phone_number" required value="<?= $row['phone_number'] ?>" readonly></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="title">제목<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="text" id="title" name="title" required value="<?= $row['title'] ?>" readonly></div>
        </div>
        <div>
            <!-- <td><label for="content">Content:</label></td> -->
            <div><textarea class="w-full border-[#C8C8C8] my-6" id="content" name="content" rows="10" required placeholder="
            제목: ex 카탈로그/브로슈어, 리플렛/팜플렛, 포스터, 제안서 등 
            사이즈: 
            페이지 수:
            인쇄 부수:
            추가설명: ex 종이종류 및 재질/코팅유무/후가공 등
                    " readonly><?= $row['content'] ?></textarea></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="attachments">파일</label></div>
            <div class="w-2/6 p-2">
               
                <?php
                $images = explode(", ", $row['attachments']);
                if (!$row['attachments']) {
                    echo '<input class="w-full rounded-[3px] border-[#B7B7B7]" type="file" id="attachments" name="attachments" multiple>';
                }else{
                    for ($i = 0; $i < count($images); $i++) {
                        echo '<h3>' . $images[$i] . '</h3>';
                        echo '<img src="./data/board_attachment/' . $images[$i] . '" alt="설명' . ($i + 1) . '" width=400>';
                    }
                }
                ?>
            </div>
        </div>
        <div class="flex justify-center gap-5 m-auto pt-4">
            <?php
                if (!empty($replyrow)) {
            ?>
            <button class="rounded-md bg-black text-white font-bold p-[10px]" id="reply_view" type="button" data-idx="<?= $row['idx']; ?>">답글보기</button>
            <?php
            } else {
            ?>
            <button class="rounded-md bg-black text-white font-bold p-[10px]" id="reply" type="button" data-idx="<?= $row['idx']; ?>">답글달기</button>
            <?php
            }
            ?>
            <button class="rounded-md bg-black text-white font-bold p-[10px]" id="view_all" type="button">전체보기</button>
        </div>
    </table>
       
    </div>
    
</body>

</html>