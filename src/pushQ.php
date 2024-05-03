<aside onclick="expandAside()" id="myAside" class="z-[999] fixed bottom-8 right-8 w-16 h-16 rounded-[100%] bg-white flex justify-center items-center duration-200 overflow-hidden">
    <div id="asideBtn" class="w-16 h-16 flex justify-center items-center rounded-full text-3xl bg-blue-500">
        <img id="asideBtn1" src="./image/icon/paper_plane_w.png" class=" w-full h-full self-center border-2 border-white rounded-full" alt="">
        <img id="asideBtn2" src="./image/icon/bracket_R_white_D.png" alt="" class="w-8 h-8 hidden ">
    </div>
    <form id="asideForm" class="w-full max-w-[1440px] h-[80px] flex hidden justify-center">
        <div id="asideFormInner" class=" flex hidden justify-between items-center gap-8 p-4">
            <div class="text-3xl">
                <h1 class="text-3xl">상담전화</h1>
                <p class="text-[#5879E2] font-bold">010-7540-0153</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <!-- <div>이름 : </div> -->
                    <input class="input_1 border-[#cccccc] placeholder-slate-400" name="이름" rows="4" cols="50" placeholder="성함" required></input>
                </div>
                <div class="flex items-center gap-2">
                    <!-- <div>나이 : </div> -->
                    <input class="input_1 border-[#cccccc] placeholder-slate-400" name="연락처" rows="4" cols="50" placeholder="연락처" required></input>
                </div>
                <div class="flex items-center gap-2">
                    <!-- <div>전화번호 : </div> -->
                    <select class="input_1 text-gray-400 border-[#cccccc] placeholder-slate-400" name="문의내용" placeholder="문의내용" required>
                        <option class="text-[#cccccc]" value="">문의내용</option>
                        <option class="text-[#cccccc]" value="광고·편집">광고·편집</option>
                        <option class="text-[#cccccc]" value="비주얼아이덴티티">비주얼아이덴티티</option>
                        <option class="text-[#cccccc]" value="환경디자인">환경디자인</option>
                        <option class="text-[#cccccc]" value="웹디자인">웹디자인</option>
                        <option class="text-[#cccccc]" value="기타문의">기타문의</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <input type="checkbox">
                    <p>개인정보 수집에 동의합니다.</p>
                </div>
                <button class="w-[150px] h-[64px] bg-gradient-to-r from-[#8273F6] to-[#1651E8] rounded-full font-bold text-2xl text-white" type="button" onclick="sendPushRequest()">상담요청</button> <!-- type="button" 추가 -->
                <!-- <div id="asideCloseBtn" class="w-16 h-16 border-2 flex justify-center items-center rounded-full text-3xl" onclick="expandAside()">></div> -->
            </div>
        </div>
    </form>
</aside>

<script>
    function expandAside() {
        var asideElement = document.getElementById('myAside');
        var asideForm = document.getElementById('asideForm');
        var asideFormInner = document.getElementById('asideFormInner');
        var asideBtn = document.getElementById('asideBtn');
        var asideBtn1 = document.getElementById('asideBtn1');
        var asideBtn2 = document.getElementById('asideBtn2');

        asideElement.classList.toggle('h-16');
        asideElement.classList.toggle('h-[80px]');
        asideElement.classList.toggle('w-20');
        asideElement.classList.toggle('bottom-8');
        asideElement.classList.toggle('bottom-0');
        asideElement.classList.toggle('right-8');
        asideElement.classList.toggle('right-0');
        asideElement.classList.toggle('w-20');
        asideElement.classList.toggle('w-full');
        asideElement.classList.toggle('rounded-[100%]');
        asideElement.classList.toggle('rounded-[0%]');
        asideBtn1.classList.toggle('hidden');
        asideBtn2.classList.toggle('hidden');
        asideForm.classList.toggle('hidden');
        setTimeout(function() {
            asideFormInner.classList.remove('hidden');
        }, 200); // 0.1초 지연
    }

</script>


<script>
    function sendPushRequest() {

        // 입력된 값 확인
        var inputsElements = document.querySelectorAll(".input_1");
        var inputs = {};
        var isEmpty = false;

        inputsElements.forEach(function(element) {
            var inputName = element.getAttribute("name");
            var inputValue = element.value.trim(); // 공백 제거

            if (!inputValue) { // 값이 비어있는 경우
                if (!isEmpty) { // 빈 값에 대한 요청 팝업이 하나만 뜨도록 함
                    // alert(inputName + "을(를) 입력하세요.");
                    element.focus();
                    isEmpty = true;
                }
                return;
            }

            inputs[inputName] = inputValue;
        });

        if (isEmpty) {
            return; // 값이 비어있으면 전송 중지
        }

        // 개인정보 동의 확인
        var consentCheckbox = document.querySelector('input[type="checkbox"]');
        if (!consentCheckbox.checked) {
            alert("개인정보 수집에 동의해야 합니다.");
            return;
        }


        var jsonBody = JSON.stringify(inputs);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/pushQueue.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    alert("문의가 접수되었습니다.");
                    window.location.href = "index.php"; // 성공했을 때 main.php로 이동
                } else {
                    alert("문의접수에 실패하였습니다.");
                    location.reload(); // 실패했을 때 페이지 새로고침
                }
            }
        };
        xhr.send("body=" + encodeURIComponent(jsonBody));
    }
</script>