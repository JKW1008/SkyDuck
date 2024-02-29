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

        $title = "포트폴리오";
        $subtitle = "";
        $filename = "portfolio";
        $textColor = "";

        render_header($title, $subtitle, $filename,$textColor);
        ?>
    </div>
</section>

<section class="relative w-full flex flex-col justify-center items-center mt-24">
    <article class="w-full max-w-[1440px] max-[740px]:px-4">
        <div class="mb-4 ">
            <ul class="flex flex-wrap justify-center -mb-px text-[#333333] text-[20px] font-medium text-center space-x-10 max-[740px]:space-x-2" id="default-tab" data-tabs-active-classes="text-[#333333] hover:text-[#333333] font-bold border-[#001C7E] border-b-0 border-t-4" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1 text-[#333333]" id="listAll-tab" data-tabs-target="#listAll" type="button" role="tab" aria-controls="listAll" aria-selected="false">전체보기</button>
                </li>
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1" id="listAd-tab" data-tabs-target="#listAd" type="button" role="tab" aria-controls="listAd" aria-selected="false">광고·편집</button>
                </li>
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1" id="listVi-tab" data-tabs-target="#listVi" type="button" role="tab" aria-controls="listVi" aria-selected="false">비주얼아이덴티티</button>
                </li>
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1" id="listEnv-tab" data-tabs-target="#listEnv" type="button" role="tab" aria-controls="listEnv" aria-selected="false">환경디자인</button>
                </li>
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation2">
                    <button class="inline-block py-1" id="listWeb-tab" data-tabs-target="#listWeb" type="button" role="tab" aria-controls="listWeb" aria-selected="false">웹디자인</button>
                </li>
                <li class=" flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1" id="listEct-tab" data-tabs-target="#listEct" type="button" role="tab" aria-controls="listEct" aria-selected="false">기타</button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div class="hidden p-4 rounded-lg" id="listAll" role="tabpanel" aria-labelledby="listAll-tab">
                <?php
                include './portfolioList/listAll.php'
                ?>
            </div>
            <div class="hidden p-4 rounded-lg" id="listAd" role="tabpanel" aria-labelledby="listAd-tab">
                <?php
                include './portfolioList/listAd.php'
                ?>
            </div>
            <div class="hidden p-4 rounded-lg" id="listVi" role="tabpanel" aria-labelledby="listVi-tab">
                <?php
                include './portfolioList/listVi.php'
                ?>
            </div>
            <div class="hidden p-4 rounded-lg" id="listEnv" role="tabpanel" aria-labelledby="listEnv-tab">
                <?php
                include './portfolioList/listEnv.php'
                ?>
            </div>
            <div class="hidden p-4 rounded-lg" id="listWeb" role="tabpanel" aria-labelledby="listWeb-tab">
                <?php
                include './portfolioList/listWeb.php'
                ?>
            </div>
            <div class="hidden p-4 rounded-lg" id="listEct" role="tabpanel" aria-labelledby="listEct-tab">
                <?php
                include './portfolioList/listEct.php'
                ?>
            </div>
        </div>
    </article>
</section>
<?php
include './footer.php';
?>