document.addEventListener("DOMContentLoaded", () => {
    const btn_mem_edit = document.querySelectorAll(".btn_mem_edit");

    const btn_search = document.querySelector("#btn_search");

    btn_search.addEventListener("click", () => {
        const sf = document.querySelector("#sf");
        if (sf.value == "") {
            alert("검색어를 입력해 주세요.");
            sf.focus();
            return false;
        }

        const sn = document.querySelector("#sn");

        self.location.href = "./admin_member.php?sn=" + sn.value + "&sf=" + sf.value;
    });

    const btn_all = document.querySelector("#btn_all");

    btn_all.addEventListener("click", () => {
        self.location.href = "./admin_member.php";
    });

    const btn_excel = document.querySelector("#btn_excel");

    btn_excel.addEventListener("click", () => {
      self.location.href = "./admin_member_to_excel.php";
    });


    btn_mem_edit.forEach((button) => {
        button.addEventListener("click", () => {
            // alert(button.dataset.idx); // Note the change here from dataset.IDX to dataset.idx
            const idx = button.dataset.idx;
            self.location.href = "admin_member_edit.php?idx=" + idx;
        });
    });
});