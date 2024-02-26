function getUrlParams() {
    const params = {};
  
    window.location.search.replace(
      /[?&]+([^=&]+)=([^&]*)/gi,
      function (str, key, value) {
        params[key] = value;
      }
    );
  
    return params;
  }
  

document.addEventListener("DOMContentLoaded", () => {
    // const name = document.querySelector("#name");
    const password = document.querySelector("#password");
    // const email = document.querySelector("#email");
    // const phonenumber 
    const board_write_submit = document.querySelector("#board_write_submit");

    board_write_submit.addEventListener("click", () => {
        // if (name.value == '') {
        //     alert("이름을 입력해 주세요");
        //     name.focus();
        //     return false;
        // };

        if (password.value == '') {
            alert("비밀번호 숫자 4자리를 입력해 주세요");
            password.focus();
            return false;
        };

        const regex = /^\d{4}$/;

        if (!(regex.test(password.value))) {
            alert("올바르지 않은 비밀번호 입니다. 다시 입력해 주세요");
            password.value = '';
            password.focus();
            return false;
        };

        // if (email.value == "") {
        //     alert("이메일이 비어있습니다. 입력해 주세요.");
        //     email.focus();
        //     return false;
        // };


    })
})