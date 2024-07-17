function sendPushRequest_1() {

  // 입력된 값 확인
  var inputsElements = document.querySelectorAll(".input_1");
  var inputs = {};
  var isEmpty = false;

  inputsElements.forEach(function (element) {
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
    Swal.fire({
      // title: 'Error!',
      html: '개인정보 수집에 동의해야 합니다!',
      icon: 'warning',
      confirmButtonText: '확인'
    });
    consentCheckbox.focus();
    return;
  }


  var jsonBody = JSON.stringify(inputs);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./pg/pushQueue.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        Swal.fire({
          title: '접수완료',
          html: '상담신청이 성공적으로 접수되었습니다.',
          icon: 'success',
          confirmButtonText: '확인'
        }).then((result) => {
          window.location.href = "index.php";
        });
      } else {
        Swal.fire({
          title: '접수실패',
          html: '메세지 전송에 실패했습니다' + '<br>' + '잠시후 다시 시도해주세요',
          icon: 'error',
          confirmButtonText: '확인'
        });
        swal("Push 메시지 전송에 실패했습니다.").then((result) => {
          location.reload(); // 실패했을 때 페이지 새로고침
        });
      }
    }
  };
  xhr.send("body=" + encodeURIComponent(jsonBody));
}
