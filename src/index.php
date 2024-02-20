<?php
include './header.php';
?>

<?php
$currentPath = $_SERVER['REQUEST_URI'];
if ($currentPath == '/index.php') {
    header("Location: /");
    exit();
}
?>

<section class="relative w-full h-screen flex justify-center">
    <video class="z-0 absolute top-0 left-0 w-full h-full object-cover" autoplay muted>
        <source src="./video/mainBgmp4.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="absolute flex flex-col w-full max-w-[1280px] h-full z-1 text-3xl text-[#d9d9d9] items-center top-[25%] gap-16">
        <div class="w-[50%]"><img src="./image/mainpage/subtitle.png" alt=""></div>
        <div class="w-[50%] flex justify-center ">
            <div class="w-full min-[390px]:w-[50%] flex flex-col min-[390px]:flex-row justify-center items-center">
                <img src="./image/mainpage/title-1.png" alt="">
                <img src="./image/mainpage/title-2.png" alt="">
            </div>
        </div>
    </div>
</section>

<div class="pt-[80px] flex  flex-col justify-center items-center">
    <h1 class="font-bold text-[44px] text-mblack mb-[12px]">Service Scope</h1>
    <div class="w-[150px] h-[10px] bg-gradient-to-r from-customblue to-custombluetransparent mb-[24px]"></div>
    <p class="text-xl text-grayService font-bold">원스탑(One-Stop) 디자인 컨설팅 서비스</p>
</div>

<div>
    <img src="./CK_cm08353833_l 4.png" alt="">
</div>

<div>
</div>





<?php $currentPath = $_SERVER['REQUEST_URI'];
$isIndexPage = (strpos($currentPath, '/') !== false); ?> <?php if ($isIndexPage) : ?>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            let header = document.getElementById('mainHeader');
            let isScrolled = false;

            window.addEventListener('scroll', function() {
                if (!isScrolled && window.pageYOffset > 0) {
                    header.classList.add('bg-white');
                    header.classList.add('shadow-md');
                    header.classList.remove('text-white');
                    isScrolled = true;
                } else if (isScrolled && window.pageYOffset === 0) {
                    header.classList.remove('bg-white');
                    header.classList.remove('shadow-md');
                    header.classList.add('text-white');
                    isScrolled = false;
                }
            });

            if (window.pageYOffset > 0) {
                header.classList.add('bg-white');
                header.classList.add('shadow-md');
                header.classList.remove('text-white');
                isScrolled = true;
            } else {
                header.classList.remove('bg-white');
                header.classList.remove('shadow-md');
                header.classList.add('text-white');
                isScrolled = false;
            }
        });
    </script>
<?php endif; ?>

<?php
include './footer.php';
?>