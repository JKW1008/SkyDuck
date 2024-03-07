function getExtensionOfFilename(filename) {
    // 파일 이름에서 마지막 점을 찾아 확장자를 추출
    const dotIndex = filename.lastIndexOf(".");
    
    // 점을 찾았고, 파일 이름에 점이 있으며 마지막 문자가 아닌 경우 확장자 반환
    if (dotIndex !== -1 && dotIndex < filename.length - 1) {
        return filename.substring(dotIndex + 1).toLowerCase();
    }
    
    // 그 외의 경우 확장자가 없음을 나타내는 빈 문자열 반환
    return "";
}


document.addEventListener("DOMContentLoaded", () => {
    const btn_cancel = document.querySelector("#btn_cancel");

    btn_cancel.addEventListener("click", () => {
        self.location.href = "./admin_portfolio.php";
    });

    const btn_submit = document.querySelector("#btn_submit");
    const choice_category = document.querySelector("#choice_category");
    const name = document.querySelector("#name");
    const old_name = document.querySelector("#old_name");
    const old_images = document.querySelector("#old_images");
    const description = document.querySelector("#description");
    const detail_photo = document.querySelector("#detail_photo");

    btn_submit.addEventListener("click", () => {
        if (choice_category.value == "all") {
            alert("카테고리를 선택해 주세요");
            choice_category.focus();
            return false;
        };

        if (name.value == "") {
            alert("프로젝트명을 입력해주세요");
            name.focus();
            return false;
        };

        if (description.value == "") {
            description.value = "특별한 설명이 없습니다.";
        };

        if (detail_photo.value == "") {
            alert("사진을 첨부해 주세요.");
            return false;
        };

        if (detail_photo.files.length > 5) {
            alert("첨부할 수 있는 파일의 갯수는 5개 입니다.");
            detail_photo.value = "";
            return false;
        };

        const f = new FormData();
        f.append("category", choice_category.value);
        f.append("name", name.value);
        f.append("old_name", old_name.value);
        f.append("old_images", old_images.value);
        f.append("description", description.value);
        f.append("mode", "portfolio_edit");

        let ext = "";

        for (const files of detail_photo.files) {
            if (files.size > 40 * 1024 * 1024) {
                alert("파일 용량이 40메가를 초과했습니다.");
                detail_photo.value = "";
                return false;
            };

            ext = getExtensionOfFilename(files.name);


            if (
                ext == "txt" ||
                ext == "exe" ||
                ext == "xls" ||
                ext == "dmg" ||
                ext == "php" ||
                ext == "js"
            ) {
                alert("첨부할 수 없는 포맷의 파일이 첨부되었습니다.(exe, txt 등)");
                attach.value = "";
                return false;
            }

            f.append("files[]", files);
        };

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/admin_portfolio.php", true);
        xhr.send(f);

        xhr.onload = () => {
            
        }
    });
});