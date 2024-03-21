<?php
include "./inc/dbconfig.php";

$db = $pdo;

include "./inc/portfolio.php";
include "./inc/lib.php";

$sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
$sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

$port = new Portfolio($db);

$paramArr = ['sn' => $sn, 'sf' => $sf];

$total = $port->total($paramArr);
$limit = 9; // 각 페이지당 표시되는 항목 수

$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$param = '';

$portArr = $port->list($page, $limit, $paramArr);
?>



<!-- 모달 -->
<div id="imageModal" class="z-[1000] fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="modal-content bg-white rounded-lg overflow-hidden py-5 shadow-lg w-[90%] max-[400px]:w-[95%] max-w-[1080px] h-[90%] max-h-[900px] flex justify-center items-center">
        <div class="w-full max-w-[630px] h-full max-h-[600px]">
            <swiper-container class="mySwiper w-full h-full" pagination="true" navigation="true" loop="true">
                <swiper-wrapper id="modalImageWrapper">
                    <!-- 이미지 슬라이드들이 여기에 추가될 것입니다. -->
                </swiper-wrapper>
            </swiper-container>
        </div>
        <div id="closeModal" class="absolute top-2 right-2 p-2 cursor-pointer rounded-lg overflow-hidden bg-white/25 hover:bg-white/50 w-10 h-10"><img src="./image/icon/btn_X.png" alt="" class=" w-full h-full "></div>
    </div>
</div>



<!-- 이미지 그리드 -->
<div id="divAll" class="grid grid-cols-3 max-[600px]:grid-cols-2 gap-4 max-[600px]:gap-1 items-center">
    <?php foreach ($portArr as $portfolio) : ?>
        <?php $imageRoutes = explode(',', $portfolio['ImageRoute']); ?>
        <?php foreach ($imageRoutes as $index => $imageRoute) : ?>
            <?php if ($index < 1) : ?> <!-- 각 포트폴리오 항목에서 최대 3개의 이미지만 표시 -->
                <div class="relative">
                    <img src="./data/portfolio/<?php echo $imageRoute; ?>" alt="포트폴리오 이미지" class="w-full cursor-pointer" onclick="openModal('./data/portfolio/<?php echo $imageRoute; ?>', '<?php echo $portfolio['Name']; ?>', '<?php echo $portfolio['Category']; ?>', '<?php echo $portfolio['ImageRoute']; ?>')">
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

<script>
    // 모달 열기
    function openModal(imageSrc, name, category, imageRoute) {
        const modal = document.getElementById('imageModal');
        const modalImageWrapper = document.getElementById('modalImageWrapper');
        const modalName = document.getElementById('modalName');
        const modalCategory = document.getElementById('modalCategory');
        
        // 모달 내 이미지 슬라이드 초기화
        modalImageWrapper.innerHTML = '';

        // 이미지 경로를 콤마로 분리하여 배열로 변환
        const imageRoutes = imageRoute.split(',');

        // 각 이미지 경로에 대해 슬라이드 생성
        imageRoutes.forEach(route => {
            // 이미지 슬라이드 생성
            const slide = document.createElement('swiper-slide');
            const img = document.createElement('img');
            img.src = `./data/portfolio/${route.trim()}`; // 이미지 경로 설정
            img.alt = '포트폴리오 이미지';
            img.classList.add('m-auto', 'w-full', 'h-full', 'object-cover');
            slide.appendChild(img);
            modalImageWrapper.appendChild(slide);
        });

        // 모달 내 텍스트 설정
        modalName.textContent = name;
        modalCategory.textContent = category;

        // 모달 열기
        modal.classList.remove('hidden');
    }

    // 모달 닫기
    document.getElementById('closeModal').addEventListener('click', function() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    });
</script>


<div class="d-flex mt-3 justify-content-between align-items-start">
    <?php
    if (isset($sn) && $sn != '' && isset($sf) && $sf != '') {
        $param = '&sn=' . $sn . '&sf=' . $sf;
    }
    echo my_pagination($total, $limit, $page_limit, $page, $param);
    ?>
</div>