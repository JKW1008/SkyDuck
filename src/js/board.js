document.addEventListener("DOMContentLoaded", () => {
    const detail_page = document.querySelectorAll(".detail_page");

    detail_page.forEach((box) => {
        const idx = box.dataset.idx;
        box.addEventListener("click", () => {
            self.location.href = "./board_check_password.php?idx=" + idx;
        });
    });
})