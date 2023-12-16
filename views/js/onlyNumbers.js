jQuery("#identification").on('input', function (evt) {
    jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
});

jQuery("#phone_number").on('input', function (evt) {
    jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
});