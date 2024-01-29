function isId(asValue) {
	var regExp = /^[a-z]+[a-z0-9]{5,19}$/g;
 
	return regExp.test(asValue);
}

document.addEventListener("DOMContentLoaded", () => {
    let idCheck = false;
    let emailToCheck = "";

    const btn_member_id_check = document.querySelector("#btn_member_id_check");
    btn_member_id_check.addEventListener("click", () => {
        const member_id = document.querySelector("#member_id");
        console.log("btn_member_id_check clicked");
        
        if (member_id.value == "") {
            alert("아이디를 입력해 주세요");
            member_id.focus();
            return false;
        }

        if (!isId(member_id)) {
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
    })
    
    const btn_member_email_check = document.getElementById("btn_member_email_check");
    const member_email = document.getElementById("member_email");
    const manual_email_input = document.getElementById("manual_email_input");
    const email_domain = document.getElementById("email_domain");

    // 페이지 로딩 시 초기 emailToCheck 변수 설정
    emailToCheck = member_email.value + "@" + email_domain.value;

    email_domain.addEventListener("change", () => {
        // 도메인이 변경될 때마다 emailToCheck 변수 업데이트
        const selectedDomain = email_domain.value;

        // 직접 입력 옵션 선택 시 사용자가 입력한 이메일을 사용
        emailToCheck = (selectedDomain === "manual_input") ? member_email.value + "@" + manual_email_input.value : member_email.value + "@" + selectedDomain;

        console.log("이메일 중복 확인을 위한 변수: ", emailToCheck);
    });

    btn_member_email_check.addEventListener("click", () => {
        if (member_email.value === '') {
            alert("이메일을 입력해 주세요");
            member_email.focus();
            return false;
        }
        emailToCheck = member_email.value + "@" + email_domain.value;
        // 여기에 이메일 중복 확인 등의 작업을 수행할 수 있습니다.
        console.log("emailToCheck 전역 변수 사용 예시: ", emailToCheck);
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