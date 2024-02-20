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

        $title = "회사소개";
        $subtitle = "HOME / 회사소개";
        $filename = "intro";

        render_header($title, $subtitle, $filename);
        ?>
    </div>

    <div class=""></div>

    <div class="pt-[80px]">
    </div>
</section>

<section class="w-full relative flex flex-col justify-center items-center">
    <article class="w-full max-w-[1440px] flex flex-col justify-center items-center px-10 py-20" style="background-image: url(./image/Page_intro/Bg_1-1.png); background-size:contain; background-repeat:no-repeat">
        <div class="w-full max-w-[1196px] my-12 border-[#001C7E] border-b-4">
            <div class="text-[46px]">S<span class="text-[34px]">KY</span>D<span class="text-[34px]">UCK</span>DESIGN <span class=" font-bold">소개</span></div>
        </div>

        <div class="w-full max-w-[1196px] my-8 flex flex-col text-[32px] gap-[1em] break-keep">
            <div>
                스카이덕 디자인은 일반 기업 및 각종 단체의 다양한 디자인제작에 대한 <span class="font-bold  ">디자인 컨설팅</span>을 하는 디자인 전문회사입니다
            </div>
            <div>
                <span class="font-bold  ">풍부한 노하우</span>를 갖춘 디자인 전문 인력들로 디자인이 필요한 모든 프로젝트들에 대해 <span class="font-bold  ">감각적인 창의성</span>을 바탕으로 <span class="font-bold  ">세련</span>되며 콘셉과 실용성, 그리고 심미성을 고려한 <span class="font-bold  ">완성도 높은 결과물</span>을 만나실 수 있습니다.
            </div>
            <div>
                카달로그, 리플렛, 브로슈어 등 콘텐츠기획부터 디자인, 촬영과 인쇄를 포함하는 <span class="font-bold  ">원스탑(ONE-STOP) 디자인 컨설팅 서비스</span>를 <span class="font-bold  ">스카이덕 디자인</span>에서 경험해 보세요.
            </div>
        </div>
    </article>
    <article>
        <div class="w-full max-w-[1440px] flex flex-col justify-center items-center px-10 py-20">
            <img src="./image/Page_intro/classification.png" alt="">
        </div>
    </article>
</section>

<?php
include './footer.php';
?>