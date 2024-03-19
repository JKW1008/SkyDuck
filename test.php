<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 부트스트랩 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!--테일윈드 CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <!-- 제이쿼리 -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    <style type="text/tailwindcss">
        @layer utilities {
      .content-auto {
        content-visibility: auto;
      }
    }
    </style>
    <!-- 폰트 -->
    <style>
        @font-face {
            font-family: 'Pretendard-Regular';
            src: url('https://cdn.jsdelivr.net/gh/Project-Noonnu/noonfonts_2107@1.1/Pretendard-Regular.woff') format('woff');
            font-weight: 400;
            font-style: normal;
        }
    </style>

    <style>
        .off p {
            display: none;
        }

        .on .fourtitle {
            display: none;
        }

        .fourcard {
            display: none;
            opacity: 0;
            transition: all 0.3s;
        }

        .on .fourcard {
            display: block;
            opacity: 1;
        }

        .underline-custom::after {
            content: '';
            display: block;
            width: 168px;
            /* 밑줄의 길이를 조절합니다. */
            height: 2px;
            background: #fff;
            /* 밑줄의 색상을 설정합니다. */
            position: absolute;
            bottom: -3px;
        }

        .underline-custom-visual::after {
            content: '';
            display: block;
            width: 168px;
            /* 밑줄의 길이를 조절합니다. */
            height: 2px;
            background: #fff;
            /* 밑줄의 색상을 설정합니다. */
            position: absolute;
            bottom: -3px;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                        iconred: 'E60A0A',
                        mblack: '#333',
                        loginblue: '#182548',
                        grayService: '#717171',
                        customblue: '#16214D',
                        custombluetransparent: 'rgba(22, 33, 77, 0.00)',
                    }
                }
            }
        }
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />


    <title>Document</title>

</head>

<body class=" relative transition-all font-[Pretendard-Regular] pb-[500px] ">
    <header id="mainHeader" class="z-[999] fixed w-full h-16 flex justify-center items-center bg-white duration-300 shadow-md">
        <div class="container max-w-[1024px] flex flex-row justify-between px-10">
            <a href="./">
                <div class="h-full ">
                    <img class="w-full h-full object-contain" src="./image/logo/SkyDuck_Logo.png" alt="">
                </div>
            </a>
            <div class="flex flex-row gap-4 items-center">
                <div class="flex flex-row gap-4 items-center max-[640px]:hidden">
                    <a href="./intro.php">
                        <div>회사소개</div>
                    </a>
                    <a href="./portfolio.php">
                        <div>포트폴리오</div>
                    </a>
                    <a href="./board.php">
                        <div>게시판</div>
                    </a>
                    <a href="./qna.php">
                        <div>견적문의</div>
                    </a>
                    <a href="./login.php">
                        <div class="w-[65px] h-[39px] bg-[#333333] rounded-md flex justify-center items-center text-white">로그인</div>
                    </a>
                </div>
                <div id="MenuToggleBtn" class="hidden p-2 max-[640px]:block rounded-lg bg-[#004190] hover:bg-white hover:opacity-75"><img src="./image/icon/toggleBtn.png" alt=""></div>
            </div>
        </div>
    </header>
    <div id="ToggleMenu" class="fixed w-screen h-full top-0 left-[100%] bg-[#F1F3F6] z-[1000] duration-150">
        <div class=" relative w-full h-full flex flex-col justify-start items-center">
            <div class=" absolute top-8 w-full flex justify-between px-10 items-center">
                <div><a href="./"><img src="./image/logo/SkyDuck_Logo.png" alt=""></a></div>
                <div id="ToggleCloseBtn" class="w-[22px] h-[22px]"><img src="./image/icon/btn_X.png" alt="X"></div>
            </div>
            <div class="w-full flex flex-col text-[16px] font-bold pt-24 px-4 gap-6">
                <a href="./login.php" class="w-full h-[60px] flex justify-between items-center rounded-xl bg-white px-4">
                    <div>로그인</div>
                    <img src="./image/icon/bracket_R.png" alt="">
                </a>
                <div class="w-full flex flex-col bg-white px-2 rounded-xl py-3">
                    <a href="./intro.php" class="w-full flex justify-between items-center rounded-xl  px-3 py-2">
                        <div>회사소개</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                    <a href="./portfolio.php" class="w-full flex justify-between items-center rounded-xl  px-3 py-2">
                        <div>포트폴리오</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                    <a href="./board.php" class="w-full flex justify-between items-center rounded-xl  px-3 py-2">
                        <div>게시판</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                    <a href="./qna.php" class="w-full flex justify-between items-center rounded-xl  px-3 py-2">
                        <div>견적문의</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                </div>



            </div>
        </div>
    </div>

    <section class="portfolioPage">
        <div id="Title" class="">

            <div class="pt-16"></div>
            <div class="w-full h-[380px] flex justify-center items-center text-white " style="background-image: url(./image/titleBg/portfolio.png);">
                <div class="flex justify-center items-center flex-col  ">
                    <div id="pageTitle" class="text-[72px] font-semibold tracking-wider">포트폴리오</div>
                    <div id="pageSubTitle" class=""></div>
                </div>
            </div>

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
                    <div id="divAll" class="grid grid-cols-3 max-[740px]:grid-cols-2 max-[390px]:grid-cols-1 gap-4 max-[390px]:gap-4 items-center overflow-hidden object-fill">

                        <!-- <div  class=" hover:scale-110 after:absolute hover:after:block   hover:after:bg-black "><img src="./data/portfolio/add_1.jpg" alt=""></div> -->
                        <!-- <div><img src="../data/portfolio/add_2.jpg" alt=""></div> -->
                        <!-- <div><img src="../data/portfolio/env_1.jpg" alt=""></div> -->
                        <!-- <div><img src="../data/portfolio/env_2.jpg" alt=""></div> -->
                        <!-- <div><img src="../data/portfolio/vi_1.jpg" alt=""></div> -->

                        <script src="./js/portfolioList_all.js"></script>

                    </div>
                </div>
                <div class="hidden p-4 rounded-lg" id="listAd" role="tabpanel" aria-labelledby="listAd-tab">
                    <div id="divAd" class="grid grid-cols-3 max-[740px]:grid-cols-2 max-[390px]:grid-cols-1 gap-4 max-[390px]:gap-4 items-center overflow-hidden object-fill">

                        <script src="./js/portfolioList_Ad.js"></script>

                    </div>
                </div>
                <div class="hidden p-4 rounded-lg" id="listVi" role="tabpanel" aria-labelledby="listVi-tab">
                    <div id="divVi" class="grid grid-cols-1 max-[740px]:grid-cols-2 max-[390px]:grid-cols-1 gap-4 max-[390px]:gap-4 items-center overflow-hidden object-fill">

                        <script src="./js/portfolioList_Vi.js"></script>

                    </div>
                </div>
                <div class="hidden p-4 rounded-lg" id="listEnv" role="tabpanel" aria-labelledby="listEnv-tab">
                    <div id="divEnv" class="grid grid-cols-1 max-[740px]:grid-cols-2 max-[390px]:grid-cols-1 gap-4 max-[390px]:gap-4 items-center overflow-hidden object-fill">

                        <script src="./js/portfolioList_Env.js"></script>

                    </div>
                </div>
                <div class="hidden p-4 rounded-lg" id="listWeb" role="tabpanel" aria-labelledby="listWeb-tab">
                    <div id="divWeb" class="grid grid-cols-3 max-[740px]:grid-cols-2 max-[390px]:grid-cols-1 gap-4 max-[390px]:gap-4 items-center overflow-hidden object-fill">

                        <script src="./js/portfolioList_Web.js"></script>

                    </div>
                </div>
                <div class="hidden p-4 rounded-lg" id="listEct" role="tabpanel" aria-labelledby="listEct-tab">
                    <div id="divEct" class="grid grid-cols-3 max-[740px]:grid-cols-2 max-[390px]:grid-cols-1 gap-4 max-[390px]:gap-4 items-center overflow-hidden object-fill">

                        <script src="./js/portfolioList_Ect.js"></script>

                    </div>
                </div>
            </div>
        </article>
    </section>
    <!-- 헤더 관련 스크립트 -->
    <footer class="absolute bottom-0 w-full h-[400px] flex justify-center bg-[#333333]">
        <div class="max-w-[1440px] w-full h-full  flex flex-col min-[790px]:flex-row justify-around min-[790px]:justify-between px-8 min-[390px]:px-6 items-start min-[790px]:items-end min-[790px]:pb-24">
            <div class="text-[#c7c1c1] flex flex-col gap-4">
                <div><img class="w-[138px]" src="./image/logo/footer_logo.png" alt=""></div>
                <div class="flex flex-col gap-1 ">
                    <div>대구광역시 북구 산격로 OOO길 OOO</div>
                    <div class="flex flex-col min-[500px]:flex-row gap-2">
                        <div>Mobile : 010-7540-0153</div>
                        <div>Fax : 0508-957-0153</div>
                    </div>
                    <div>E-mail : skyduck_ds@naver.com</div>
                    <div>Copyright © SKYDUCKDESIGN Co.</div>
                </div>
            </div>
            <div class=" text-white min-[790px]:h-full flex items-end max-[790px]:w-full max-[790px]:justify-center">
                <div class="flex flex-row gap-4 ">
                    <a href="tel:01031861144">
                        <div class="w-10 h-10"><img class="w-full h-full" src="./image/icon/footer_call_icon.png" alt=""></div>
                    </a>

                    <a href="tel:01031861144">
                        <div class="w-10 h-10"><img class="w-full h-full" src="./image/icon/footer_kakao_icon.png" alt=""></div>
                    </a>

                    <a href="tel:01031861144">
                        <div class="w-10 h-10"><img class="w-full h-full" src="./image/icon/footer_insta_icon.png" alt=""></div>
                    </a>

                    <a href="tel:01031861144">
                        <div class="w-10 h-10"><img class="w-full h-full" src="./image/icon/footer_blog_icon.png" alt=""></div>
                    </a>
                </div>
            </div>
        </div>
    </footer>




    <!-- 부트스트랩 CDN 스크립트 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script>
        if (window.location.pathname == '/index.php') {
            window.location.href = "/";
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>


    <!-- 헤더 토글 스크립트 -->
    <script>
        document.getElementById('MenuToggleBtn').addEventListener('click', function() {
            document.getElementById('ToggleMenu').classList.remove('left-[100%]');
            document.getElementById('ToggleMenu').classList.add('left-0');
        });
    </script>
    <script>
        document.getElementById('ToggleCloseBtn').addEventListener('click', function() {
            document.getElementById('ToggleMenu').classList.remove('left-0');
            document.getElementById('ToggleMenu').classList.add('left-[100%]');
        });
    </script>

</body>

</html>