function isId(asValue) {
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

function isValidEmailDomain(emailDomain) {
    // 이메일 도메인을 검사하는 정규식
    const domainRegex = /^[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$/;
    
    // 정규식 검사
    return domainRegex.test(emailDomain);
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

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/business_member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status === 200) {
                const responseText = xhr.responseText;
                console.log(responseText);
                try {
                    const data = JSON.parse(responseText);
                    console.log(data);
                    if (data.result === 'success') {
                        alert("사용이 가능한 아이디 입니다.");
                        document.getElementById("id_chk").value = "1";
                        idCheck = true;
                    } else if (data.result === "fail") {
                        alert("이미 사용중인 아이디 입니다. 다른 아이디를 입력해 주세요.");
                        document.getElementById("id_chk").value = "0";
                        idCheck = false;
                        business_member_id.value = "";
                        business_member_id.foucus();
                    } else if (data.result === "empty_id") {
                        alert("아이디가 비어있습니다.");
                        business_member_id.foucus();
                    }
                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("연결 실패 파일이 존재하지 않습니다.");
            }
        }
    })

    btn_member_email_check.addEventListener("click", () => {
        if (business_member_email.value === '') {
            alert("이메일을 입력해 주세요");
            business_member_email.focus();
            return false;
        }

        if (email_domain.value == "manual_input") {

            if (manual_email_input.value == "") {
                alert("이메일 주소를 입력해 주세요");
                manual_email_input.focus();
                return false;
            };

            if (!isValidEmailDomain(manual_email_input.value)) {
                alert("잘못된 형식의 이메일 도메인입니다. 다시 입력해 주세요.");
                manual_email_input.value = "";
                manual_email_input.focus();
                return false;
            };
            
            emailToCheck = business_member_email.value + "@" + manual_email_input.value;
        } else {
            emailToCheck = business_member_email.value + "@" + email_domain.value;
        }
        console.log(emailToCheck);
        
        const f = new FormData();
        f.append("email", emailToCheck);
        f.append("mode", "email_chk");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/business_member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);
                    if (data.result == "success") {
                        alert("사용가능한 이메일 입니다.");
                        document.getElementById("email_chk").value = "1";
                        emailChecked = true;
                    } else if (data.result === "fail") {
                        alert("중복된 이메일 입니다.");
                        document.getElementById("email_chk").value = "0";
                        emailChecked = false;
                        business_member_email.value = "";
                        business_member_email.focus();
                        if (email_domain.value == "manual_input") {
                            manual_email_input.value = "";
                        }
                        email_domain.value = "gmail.com";
                    } else if (data.result === "empty_email") {
                        alert("이메일이 비어있습니다.");
                        business_member_email.focus();
                        if (email_domain.value == "manual_input") {
                            manual_email_input.value = "";
                        }
                        email_domain.value = "gmail.com";
                    } else if (data.result === "email_format_wrong") {
                        alert("이메일이 형식에 맞지 않습니다.");
                        business_member_email.value = "";
                        if (email_domain.value == "manual_input") {
                            manual_email_input.value = "";
                        }
                        email_domain.value = "gmail.com";
                        business_member_email.focus();
                    }
                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("실패 존재하지 않는 파일입니다.");
            };
        };
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