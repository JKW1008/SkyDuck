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

    const business_member_id = document.querySelector("#business_member_id");
    const btn_member_id_check = document.querySelector("#btn_member_id_check");
    const business_member_password = document.querySelector("#business_member_password");
    const business_member_password_chk = document.querySelector("#business_member_password_chk");
    const company_name = document.querySelector("#company_name");
    const ceo_name = document.querySelector("#ceo_name");
    const business_member_email = document.getElementById("business_member_email");
    const manual_email_input = document.getElementById("manual_email_input");
    const email_domain = document.getElementById("email_domain");
    const btn_member_email_check = document.getElementById("btn_member_email_check");
    const btn_zipcode = document.querySelector("#btn_zipicode");
    const business_member_mobile = document.querySelector("#business_member_mobile");
    const business_member_mobile2 = document.querySelector("#business_member_mobile2");
    const business_member_mobile3 = document.querySelector("#business_member_mobile3");
    const business_member_phone = document.querySelector("#business_member_phone");
    const business_member_phone2 = document.querySelector("#business_member_phone2");
    const business_member_phone3 = document.querySelector("#business_member_phone3");
    const business_member_fax = document.querySelector("#business_member_fax");
    const business_member_fax2 = document.querySelector("#business_member_fax2");
    const business_member_fax3 = document.querySelector("#business_member_fax3");

    btn_member_id_check.addEventListener("click", () => {
        if (business_member_id.value == "") {
            alert("아이디를 입력해 주세요");
            business_member_id.focus();
            return false;
        }

        if (!isId(business_member_id.value)) {
            alert("잘못된 형식의 아이디 입니다.");
            business_member_id.value = '';
            business_member_id.focus();
            return false;
        }

        const f = new FormData();
        f.append("id", business_member_id.value);
        f.append("mode", "id_chk");
    })

    emailToCheck = member_email.value + "@" + email_domain.value;

    email_domain.addEventListener("change", () => {
        // 도메인이 변경될 때마다 emailToCheck 변수 업데이트
        const selectedDomain = email_domain.value;

        // 직접 입력 옵션 선택 시 사용자가 입력한 이메일을 사용
        emailToCheck = (selectedDomain === "manual_input") ? member_email.value + "@" + manual_email_input.value : member_email.value + "@" + selectedDomain;

        console.log("이메일 중복 확인을 위한 변수: ", emailToCheck);
    });

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