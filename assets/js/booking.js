$(document).ready(function () {
    let currentStep = 1;

    function showStep(step) {
        $('.form-step').hide().fadeOut();
        $(`.form-step[data-step="${step}"]`).fadeIn();
        $('.step').removeClass('completed');
        $(`.step[data-step="${step}"]`).addClass('completed');
    }

    $('.next-step').click(function () {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    });

    $('.prev-step').click(function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    function validateStep(step) {
        let isValid = true;
        $(`.form-step[data-step="${step}"] :input[required]`).each(function () {
            if (!this.value) {
                isValid = false;
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
        });
        if (!isValid) {
            alert('Vui lòng điền đầy đủ thông tin.');
        }
        return isValid;
    }

    function calculateTotal() {
        let adults = parseInt($('#adults').val());
        let children = parseInt($('#children').val());
        let infants = parseInt($('#infants').val());

        let totalAmount = (adults * adultPrice) + (children * childPrice);
        $('#total-amount').text(totalAmount.toLocaleString('vi-VN') + ' VNĐ');
        $('#total-amount-input').val(totalAmount);
        $('#total-amount-summary').text(totalAmount.toLocaleString('vi-VN') + ' VNĐ');
    }

    $('.increment').click(function () {
        let input = $(this).siblings('input');
        let currentValue = parseInt(input.val());
        input.val(currentValue + 1);
        calculateTotal();
    });

    $('.decrement').click(function () {
        let input = $(this).siblings('input');
        let currentValue = parseInt(input.val());
        if (currentValue > 0) {
            input.val(currentValue - 1);
            calculateTotal();
        }
    });

    $('#adults, #children, #infants').change(function () {
        calculateTotal();
    });

    calculateTotal();

    // Update summary and confirmation details
    $('.next-step').click(function () {
        $('#summary-date').text($('#departure-date').val());
        $('#summary-adults').text($('#adults').val());
        $('#summary-children').text($('#children').val());
        $('#summary-infants').text($('#infants').val());
        $('#summary-total').text($('#total-amount').text());

        $('#confirm-date').text($('#departure-date').val());
        $('#confirm-adults').text($('#adults').val());
        $('#confirm-children').text($('#children').val());
        $('#confirm-infants').text($('#infants').val());
        $('#confirm-total').text($('#total-amount').text());
    });
});
