

function viewOrderDetails(orderId) {
    window.location.href = "/pages/order_details.php?order_id=" + orderId;
}

function showRateModal(tourId) {
    $('#tour_id').val(tourId);
    $('#rateModal').modal('show');
}

$(document).ready(function() {
    $('#rateModal').on('hidden.bs.modal', function() {
        $('#rateForm')[0].reset();
        $('.rating-stars i').removeClass('selected');
        $('#rating').val(5); // Reset rating to 5 stars
        $('.rating-stars i').each(function(index) {
            if (index < 5) {
                $(this).addClass('selected');
            }
        });
    });

    $('.rating-stars i').on('click', function() {
        var rating = $(this).data('value');
        $('#rating').val(rating);
        $('.rating-stars i').removeClass('selected');
        $('.rating-stars i').each(function(index) {
            if (index < rating) {
                $(this).addClass('selected');
            }
        });
    });

    $('#rateForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '/pages/rate_tour.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#rateModal').modal('hide');
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Lỗi khi gửi đánh giá.');
            }
        });
    });
});
