fetch('output_test2.php')
    .then(response => response.json())
    .then(data => {
        // 쉼표를 기준으로 파일 이름 분리
        var filenames = data.attachments.split(', ');

        // 각 파일에 대해 <img> 태그 생성
        for (var i = 0; i < filenames.length; i++) {
            var img = document.createElement('img');
            img.src = './pg/' + filenames[i];  // 이미지 파일의 경로를 설정해야 합니다.
            document.body.appendChild(img);
        }
    })
    .catch(error => console.error('Error:', error));