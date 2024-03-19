<?php
session_start();

include "./inc/dbconfig.php";

$db = $pdo;

include "./inc/Questionboard.php";
include "./inc/lib.php";
include "./inc/reply.php";


$sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
$sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

$Qboard = new Board($db);
$reply = new Reply($db);

$paramArr = ['sn' => $sn, 'sf' => $sf];

$total = $Qboard->total($paramArr);
$limit = 5;
$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$param = '';

$boardArr = $Qboard->list($page, $limit, $paramArr);
?>

<?php
include './header.php';
?>

<?php
$filename = basename(__FILE__, '.php');
?>

<section class="portfolioPage">
    <div id="Title" class="">
        <?php
        include 'pageTitle.php';

        $title = "게시판";
        $subtitle = "";
        $filename = "board";
        $textColor = "";

        render_header($title, $subtitle, $filename, $textColor);
        ?>
    </div>
</section>
<script src="./js/board.js"></script>
<div class="w-[91%] max-w-[1024px] flex-col justify-center items-center m-auto pt-12" id="main_wrap">
    <div>
        <h1 class="text-6xl">Q&A</h1>
        <div class="w-[150px] h-[10px] bg-gradient-to-r from-customblue to-custombluetransparent mb-[24px]"></div>
    </div>
    <div class="flex justify-end">
        <div class=" flex justify-end gap-2 w-1/2 max-[770px]:w-full mb-5">
            <select class="form-select w-25" name="sn" id="sn">
                <option value="2">제목</option>
                <option value="1">번호</option>
            </select>
            <input type="text" class="form-control w-25" id="sf" name="sf">
            <button class=" w-25 rounded-md bg-mblack text-white font-bold p-[10px]" id="btn_search">검색</button>
            <button class=" w-25 rounded-md bg-mblack text-white font-bold p-[10px]" id="btn_all">전체목록</button>
        </div>
    </div>
    <main class="" style="height: calc(100vh - 257px);">

        <table class="mt-3 table table-border table-hover ">
            <colgroup>
                <col width="10%">
                <col width="50%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <tr class="table-secondary border-t-2 border-[#3333] p-0">
                <th class="bg-[#cccccc]">번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
            <?php
            $cnt = 0;
            $ntotal = $total - ($page - 1) * $limit;

            foreach ($boardArr as $row) {
                $number = $ntotal - $cnt;
                $cnt++;
                // 2023-11-11 11:11:11
                $row['posting_time'] = substr($row['posting_time'], 0, 16);
                if ($reply->isRowExists($row['idx'])) {
                    $replyArr = $reply->getInfoBoardIdx($row['idx']);
                    $row['replies'] = $replyArr['title'];
                };
            ?>
                <tr class="detail_page" data-idx="<?= $row['idx']; ?>">
                    <td><?= $number; ?></td>
                    <td>🔒<?= $row['title']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <?php
                    $parts = explode('-', $row['posting_time']);
                    $detailparts = explode(' ', $parts[2]);
                    ?>
                    <td><?= $parts[1]; ?>-<?= $detailparts[0]; ?></td>
                </tr>
                <?php
                if ($reply->isRowExists($row['idx'])) {
                    $replyArr = $reply->getInfoBoardIdx($row['idx']);
                ?>
                    <tr>
                        <td colspan="4">
                            <!-- 전체 열을 합치는 셀 -->
                            <div class="replies" data-idx="<?= $replyArr['question_idx']; ?>">
                                <!-- 답글 정보 출력 -->
                                ↳<?= $replyArr['title']; ?>
                                <!-- 여기에 더 상세한 답글 정보를 추가할 수 있습니다. -->
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            <?php
            }
            ?>
        </table>

        <div class="flex justify-end"><a class="rounded-md bg-mblack text-white font-bold p-[10px]" href="./question_board.php">글쓰기</a></div>
        <div class="m-auto flex justify-center pt-5 ">
            <?php
            if (isset($sn) && $sn != '' && isset($sf) && $sf != '') {
                $param = '&sn=' . $sn . '&sf=' . $sf;
            }

            echo my_pagination($total, $limit, $page_limit, $page, $param);
            ?>
        </div>

    </main>
</div>
<?php
include './footer.php';
?>