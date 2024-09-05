const form = document.querySelector("form");
const statusTxt = form.querySelector(".form-group4 span");

form.onsubmit = (e) => {
    e.preventDefault(); // Ngăn không cho form gửi đi tự động

    // Hiển thị tin nhắn trạng thái
    statusTxt.style.display = "block";
    
    // Tạo đối tượng XMLHttpRequest
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "message.php", true);
    xhr.onload = () => {
        if (xhr.status == 200) {
            // Nếu gửi thành công, có thể thêm logic để xử lý kết quả tại đây
            console.log(xhr.responseText);
        } else {
            // Nếu có lỗi, hiển thị tin nhắn lỗi
            console.error("Something went wrong: ", xhr.statusText);
        }
        // Ẩn tin nhắn trạng thái sau khi xử lý xong
        statusTxt.style.display = "none";
    };

    // Tạo dữ liệu từ form để gửi đi
    let formData = new FormData(form);
    xhr.send(formData); // Gửi dữ liệu
};
