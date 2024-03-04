document.addEventListener("DOMContentLoaded", () => {
    btn_search.addEventListener("click", () => {
        const sf = document.querySelector("#sf");
        if (sf.value == "") {
            alert("검색어를 입력해 주세요.");
            sf.focus();
            return false;
        }

        const sn = document.querySelector("#sn");

        self.location.href = "./admin_business_member.php?sn=" + sn.value + "&sf=" + sf.value;
    });
})