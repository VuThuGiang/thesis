document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.change-password-link').forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            var myModal = new bootstrap.Modal(document.getElementById('changePasswordModal'), {
                keyboard: false
            });
            myModal.show();
        });
    });
});

document.getElementById('image').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('profile_image_preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});