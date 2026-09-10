// Tính tổng tiền khi thay đổi số lượng
function calculateTotal() {
    const adults = parseInt($('input[name="adults"]').val()) || 0;
    const children = parseInt($('input[name="children"]').val()) || 0;
    const price = parseFloat($('#tour-price').data('price'));

    const total = (adults * price) + (children * price * 0.5);
    $('#total-price').text(formatMoney(total) + ' VNĐ');
}

// Format tiền VNĐ
function formatMoney(amount) {
    return new Intl.NumberFormat('vi-VN').format(amount);
}

// Event listeners
$('input[name="adults"], input[name="children"]').on('change', calculateTotal); 