function updateQRCode() {
            console.log("Text value from confirm-total:", totalAmountText);

            var totalPrice = parseFloat(totalAmountText.replace(/\D/g, ''));
            console.log("Giá trị totalPrice sau khi chuyển đổi:", totalPrice);

            if (!totalPrice || totalPrice <= 0) {
                console.error("Tổng giá không hợp lệ:", totalPrice);
                return;
            }

            var tourName = document.getElementById('tour-detail').innerText.replace(/[^a-zA-Z0-9\s]/g, '').replace(/\s+/g, '-');

            var qrUrl = "https://img.vietqr.io/image/MB-5696911052002-qr_only.png?amount=" + totalPrice +
                "&addInfo=" + encodeURIComponent(tourName) +
                "&accountName=" + encodeURIComponent("VU THU GIANG");

            console.log("Generated QR URL: " + qrUrl);

            document.getElementById('qr_code').src = qrUrl;
        }