$(document).ready(function () {
    // Handle heart icon click event
    $('.heart-icon').click(function (event) {
        var heartIcon = $(this);
        var tourId = heartIcon.data('tour-id');
        var isInWishlist = heartIcon.hasClass('heart-red');

        // Toggle 'heart-red' class to change color immediately
        heartIcon.toggleClass('heart-red');

        // AJAX request to update the wishlist
        $.ajax({
            url: isInWishlist ? '/pages/remove_from_wishlist.php' : '/pages/add_to_wishlist.php',
            type: 'POST',
            data: {
                tour_id: tourId,
                user_id: user_id // Ensure this variable is available and correctly set
            },
            success: function (response) {
                try {
                    console.log("Server response: ", response);
                    response = JSON.parse(response);
                    if (!response.success) {
                        // If there's an error, toggle the class back to the original state
                        heartIcon.toggleClass('heart-red');
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                } catch (e) {
                    console.error("Error parsing response: ", e);
                    heartIcon.toggleClass('heart-red');
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error: ", status, error);
                heartIcon.toggleClass('heart-red');
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            }
        });

        // Prevent click event on tour-card when heart icon is clicked
        event.stopPropagation();
    });

    // Handle tour-card click event
    $('.tour-card').click(function () {
        // Get URL from data-url attribute
        const url = $(this).data('url');
        // Redirect to the URL
        window.location.href = url;
    });
});

function updatePriceRange() {
    var range = document.getElementById('price-range');
    var min = document.getElementById('price-min');
    var max = document.getElementById('price-max');
    min.textContent = range.min.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    max.textContent = range.max.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Call updatePriceRange() initially to set initial values
updatePriceRange();

function toggleFacilities() {
    var additionalFacilities = document.getElementById('additional-facilities');
    var showMoreBtn = document.getElementById('show-more-btn');

    if (additionalFacilities.classList.contains('hidden')) {
        additionalFacilities.classList.remove('hidden');
        showMoreBtn.textContent = 'Show less';
    } else {
        additionalFacilities.classList.add('hidden');
        showMoreBtn.textContent = 'Show more';
    }
}
