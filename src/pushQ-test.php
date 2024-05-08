<div id="myAside" class="w-16 h-16 z-[999] fixed bottom-8 right-8 overflow-hidden flex-col duration-3000 justify-center items-center">
  <div class="w-[91%] m-auto max-w-[1440px]">
    <div onclick="expandAside()" id="asideBtn" class=" fixed bottom-8 right-8 w-16 h-16 flex justify-center items-center  rounded-full text-3xl bg-blue-500 duration-300">
      <img id="asideBtn1" src="./image/icon/paper_plane_w.png" class=" w-full h-full self-center border-2 border-white rounded-full" alt="">
      <img id="asideBtn2" src="./image/icon/bracket_R_white_D.png" alt="" class="w-8 h-8 hidden ">
    </div>
    <div id="asideText" class="text-3xl hidden  max-[500px]:w-full">
      <form id="asideForm" class="w-full  flex justify-between max-[500px]:justify-center hidden">
        <div id="asideFormInner" class="max-[500px]:w-full max-[500px]:flex-col max-[500px]:justify-center  flex  justify-between items-center gap-4">
          <h1 class="text-3xl text-nowrap">상담전화</h1>
          <p class="text-[#5879E2] font-bold">010-7540-0153</p>
          
        <div class="max-[500px]:w-full flex max-[900px]:flex-col justify-between items-center gap-3">
          <div class="w-[30%] max-[900px]:w-full flex items-center">
            <!-- <div>이름 : </div> -->
            <input class="input_1 w-full border-[#cccccc] placeholder-slate-400" name="이름" rows="4" cols="50" placeholder="성함" required></input>
          </div>
          <div class=" w-[30%] max-[900px]:w-full flex items-center">
            <!-- <div>나이 : </div> -->
            <input class="input_1 w-full border-[#cccccc] placeholder-slate-400" name="연락처" rows="4" cols="50" placeholder="연락처" required></input>
          </div>
          <div class="w-[30%] max-[900px]:w-full flex items-center">
            <!-- <div>전화번호 : </div> -->
            <select class="input_1 w-full text-gray-400 border-[#cccccc] placeholder-slate-400" name="문의내용" placeholder="문의내용" required>
              <option class="text-[#cccccc]" value="">문의내용</option>
              <option class="text-[#cccccc]" value="광고·편집">광고·편집</option>
              <option class="text-[#cccccc]" value="비주얼아이덴티티">비주얼아이덴티티</option>
              <option class="text-[#cccccc]" value="환경디자인">환경디자인</option>
              <option class="text-[#cccccc]" value="웹디자인">웹디자인</option>
              <option class="text-[#cccccc]" value="기타문의">기타문의</option>
            </select>
          </div>
          <!-- <div id="asideCloseBtn" class="w-16 h-16 border-2 flex justify-center items-center rounded-full text-3xl" onclick="expandAside()">></div> -->
        </div>
        <div class="flex max-[900px]:flex-col gap-2">
          <div class="flex items-center">
            <input type="checkbox">
            <p class="text-sm text-nowrap">개인정보 수집에 동의합니다.</p>
          </div>
          <button class="w-[150px] h-[64px] bg-gradient-to-r from-[#8273F6] to-[#1651E8] rounded-full font-bold text-2xl text-white" type="button" onclick="sendPushRequest()">상담요청</button> <!-- type="button" 추가 -->
        </div>
      </div>
    </form>
      </div>
  </div>
</div>





<script>
  function expandAside() {
    var asideBtn = document.getElementById('asideBtn');
    var asideBtn1 = document.getElementById('asideBtn1');
    var asideBtn2 = document.getElementById('asideBtn2');
    var asideText = document.getElementById('asideText');
    var asideElement = document.getElementById('myAside');
    var asideForm = document.getElementById('asideForm');

    asideBtn.classList.toggle('bottom-8');
    asideBtn.classList.toggle('bottom-0');
    asideBtn1.classList.toggle('hidden');
    asideBtn2.classList.toggle('hidden');
    asideText.classList.toggle('hidden');
    asideForm.classList.toggle('hidden');
    asideElement.classList.toggle('w-16');
    asideElement.classList.toggle('h-16');
    asideElement.classList.toggle('bg-white');
    asideElement.classList.toggle('w-full');
    asideElement.classList.toggle('bottom-8');
    asideElement.classList.toggle('bottom-0');
    asideElement.classList.toggle('right-8');
    asideElement.classList.toggle('right-0');

  }
</script>