function isId(asValue) {
	var regExp = /^[a-z]+[a-z0-9]{5,19}$/g;
 
	return regExp.test(asValue);
}

function isEmailId(asValue) {
	var regExp = /^[a-z]+[a-z0-9]{5,19}$/g;
 
	return regExp.test(asValue);
}

function validatePassword(password) {
    // 비밀번호가 영문, 숫자, 특수문자를 포함하고 8자에서 16자까지의 길이를 가지는지 확인하는 정규식
    const regex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=])[a-zA-Z\d!@#$%^&*()-_+=]{8,16}$/;

    if (regex.test(password)) {
        return true; // 비밀번호가 조건을 만족하는 경우
    } else {
        return false; // 비밀번호가 조건을 만족하지 않는 경우
    }
}


document.addEventListener("DOMContentLoaded", () => {
    let idCheck = false;
    let emailToCheck = "";
    let emailChecked = false;
    const memberPassword = document.querySelector("#member_password");
    const member_password_check = document.querySelector("#member_password_check");
    const member_name = document.querySelector("#member_name");
    const input_mobile = document.querySelector("#member_mobile");
    const input_mobile2 = document.querySelector("#member_mobile2");
    const input_mobile3 = document.querySelector("#member_mobile3");
    const input_phone = document.querySelector("#member_phone");
    const input_phone2 = document.querySelector("#member_phone2");
    const input_phone3 = document.querySelector("#member_phone3");

    const btn_member_id_check = document.querySelector("#btn_member_id_check");
    btn_member_id_check.addEventListener("click", () => {
        const member_id = document.querySelector("#member_id");
        console.log("btn_member_id_check clicked");
        
        if (member_id.value == "") {
            alert("아이디를 입력해 주세요");
            member_id.focus();
            return false;
        }

        if (!isId(member_id.value)) {
            alert("잘못된 형식의 아이디 입니다.");
            member_id.value = '';
            member_id.focus();
            return false;
        }

        const f = new FormData();
        f.append("id", member_id.value);
        f.append("mode", "id_chk");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);
                    if (data.result === "success") {
                        alert("사용이 가능한 아이디 입니다.");
                        document.getElementById("id_chk").value = "1";
                        idCheck = true;
                    } else if (data.result === "fail") {
                        alert("이미 사용중인 아이디입니다. 다른 아이디를 입력해 주세요.");
                        document.getElementById("id_chk").value = "0";
                        idCheck = false;
                        member_id.value = "";
                        member_id.focus();
                    } else if (data.result === "empty_id") {
                        alert("아이디가 비어있습니다.");
                        member_id.focus();
                    }
                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("연결 실패 파일이 존재하지 않습니다.")
            }
        }
    });
    
    const btn_member_email_check = document.getElementById("btn_member_email_check");
    const member_email = document.getElementById("member_email");
    const manual_email_input = document.getElementById("manual_email_input");
    const email_domain = document.getElementById("email_domain");

    // 페이지 로딩 시 초기 emailToCheck 변수 설정
    emailToCheck = member_email.value + "@" + email_domain.value;

    // email_domain.addEventListener("change", () => {
    //     // 도메인이 변경될 때마다 emailToCheck 변수 업데이트
    //     const selectedDomain = email_domain.value;

    //     // 직접 입력 옵션 선택 시 사용자가 입력한 이메일을 사용
    //     emailToCheck = (selectedDomain === "manual_input") ? member_email.value + "@" + manual_email_input.value : member_email.value + "@" + selectedDomain;

    //     console.log("이메일 중복 확인을 위한 변수: ", emailToCheck);
    // });

    btn_member_email_check.addEventListener("click", () => {
        if (member_email.value === '') {
            alert("이메일을 입력해 주세요");
            member_email.focus();
            return false;
        }
        if (!isEmailId(member_email.value)) {
            alert("잘못된 형식의 이메일 아이디 입니다.");
            member_email.focus();
            return false;
        }
        emailToCheck = member_email.value + "@" + email_domain.value;
        console.log(emailToCheck);
        // 여기에 이메일 중복 확인 등의 작업을 수행할 수 있습니다.
        // console.log("emailToCheck 전역 변수 사용 예시: ", emailToCheck);
        const f = new FormData();
        f.append("email", emailToCheck);
        f.append("mode", "email_chk");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const data = JSON.parse(xhr.responseText);
                try {
                    if (data.result === "success") {
                        alert("사용가능한 이메일입니다.");
                        document.getElementById("email_chk").value = "1";
                        emailChecked = true;
                    } else if (data.result === "fail") {
                        alert("중복된 이메일 입니다.");
                        document.getElementById("email_chk").value = "0";
                        emailChecked = false;
                        member_email.value = "";
                        member_email.focus();
                    } else if (data.result === "empty_email") {
                        alert("이메일이 비어있습니다.");
                        member_email.focus();
                    } else if (data.result === "email_format_wrong") {
                        alert("이메일이 형식에 맞지않습니다");
                        member_email.value = "";
                        email_domain.value = "gmail.com";
                        member_email.focus();
                    }
                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("실패 파일이 존재하지 않습니다");
            };
        };
    });

    const input_btn = document.querySelector("#input_btn");
    input_btn.addEventListener("click", () => {
        if (member_id.value == "") {
            alert("아이디를 입력해 주세요");
            member_id.focus();
            return false;
        };

        if (!idCheck) {
            alert("아이디 중복확인을 해주세요");
            return false;
        };

        if (memberPassword.value == "") {
            alert("비밀번호를 입력해 주세요")
            memberPassword.focus();
            return false;
        };

        if (!validatePassword(memberPassword.value)) {
            alert("형식에 맞지않는 비밀번호 입니다.");
            memberPassword.value = "";
            memberPassword.focus();
            member_password_check.value = "";
            return false;
        };

        if (member_password_check.value == "") {
            alert("비밀번호 확인을 입력해 주세요");
            member_password_check.focus();
            return false;
        };

        if (memberPassword.value != member_password_check.value) {
            alert("비밀번호가 일치하지 않습니다.");
            memberPassword.value = "";
            member_password_check.value = "";
            memberPassword.focus();
            return false;
        };

        if (document.getElementById("email_chk") == 0) {
            alert("이메일 중복확인을 해주세요");
            return false;
        };

        if (member_name.value == "") {
            alert("이름을 입력해 주세요");
            member_name.focus();
            return false;
        };

        if (input_mobile.value == "" || input_mobile2.value == "" || input_mobile3.value == "") {
            alert("휴대폰번호를 입력해 주세요");
            input_mobile.value = "";
            input_mobile2.value = "";
            input_mobile3.value = "";
            input_mobile.focus();
            return false;
        };

        if (input_phone.value == "" || input_phone2.value == "" || input_phone3.value == "") {
            alert("전화번호를 입력해 주세요");
            input_phone.value = "";
            input_phone2.value = "";
            input_phone3.value = "";
            input_phone.focus();
            return false;
        };

        const member_zipcode = document.querySelector("#member_zipcode");
        const member_addr1 = document.querySelector("#member_addr1");
        const member_addr2 = document.querySelector("#member_addr2");

        if (member_zipcode.value == "") {
            alert("우편번호를 입력해 주세요");
            return false;
        };

        if (member_addr1.value == "") {
            alert("주소를 입력해주세요");
            member_addr1.foucs();
            return false;
        };

        if (member_addr2.value == "") {
            alert("상세 주소를 입력해주세요");
            member_addr2.focus();
            return false;
        };

        const f = new FormData();
        f.append("id", member_id.value);
        f.append("password", memberPassword.value);
        f.append("email", emailToCheck);
        f.append("name", member_name);
        f.append("mobile", input_mobile + "-" + input_mobile2 + "-" + input_mobile3);
        f.append("phone", input_phone + "-" + input_phone2 + "-" + input_phone3);
        f.append("zipcode", member_zipcode);
        f.append("addr", member_addr1);
        f.append("detail_addr", member_addr2);
        f.append("mode", "member_input");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {

            } else if (xhr.status == 404) {
                alert("실패 파일이 존재하지 않습니다.");

            };
        }
    });

    const btn_zipcode = document.querySelector("#btn_zipicode");

    btn_zipcode.addEventListener("click", () => {
        new daum.Postcode({
            oncomplete: function(data) {
                console.log(data);

                let addr = "";
                let extra_addr = "";

                if (data.userSelectType == "J") {
                    addr = data.jibunAddress;
                } else if (data.userSelectType == "R") {
                    addr = data.roadAddress;
                }

                if (data.bname != "") {
                    extra_addr = data.bname;
                }

                if (data.buildingName != "") {
                    if (extra_addr == "") {
                        extra_addr = data.buildingName;
                    } else {
                        extra_addr += ", " + data.buildingName;
                    }
                }

                if (extra_addr != "") {
                    extra_addr = " (" + extra_addr + ")";
                }

                const member_addr1 = document.querySelector("#member_addr1");
                member_addr1.value = addr + extra_addr;

                const member_zipcode = document.querySelector("#member_zipcode");
                member_zipcode.value = data.zonecode;

                const member_addr2 = document.querySelector("#member_addr2");
                member_addr2.focus();
            },
        }).open();
    });
})