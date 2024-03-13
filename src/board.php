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

        $title = "문의게시판";
        $subtitle = "";
        $filename = "board";
        $textColor = "";

        render_header($title, $subtitle, $filename, $textColor);
        ?>
    </div>

    <div class=""></div>

    <div class="pt-[80px]">
    </div>

    <div class="w-full h-full flex justify-center">
        <div class="w-full max-w-[1280px] min-[720px]:px-8"> 
            <iframe src="http://nevshune.dothome.co.kr/gnu/bbs/board.php?bo_table=cusBoard1" id="iframe" onload="Height();" frameborder="0" scrolling="no" style="overflow-x:hidden; overflow:auto; width:100%; min-height:800px;"></iframe>
            </div>
        </div>
    </section>
<script type="text/javascript">
    function calcHeight() {
        var the_height =
            document.getElementById('iframe').contentWindow.
        document.body.scrollHeight;

        document.getElementById('iframe').height =
            the_height;

        // document.getElementById('iframe').style.overflow = "hidden";
    }
</script>


<?php
include './footer.php';
?>