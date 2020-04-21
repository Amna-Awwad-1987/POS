$(document).ready(function () {

    $('.add_product_btn').on('click',function (e) {
    e.preventDefault();
    var name = $(this).data('name');
    var id = $(this).data('id');
    var price = $.number($(this).data('price'),2);
    $(this).removeClass('btn-success').addClass('btn-default disabled');
    var html =
        `<tr>
            <td>${name}</td>
            <td>${price}</td>
            <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>            <td class="product-price">${price}</td>
            <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
        </tr>`;


    $('.order-list').append(html);
    calculateTotal();
});

    $('body').on('click', '.disabled',function (e) {
        e.preventDefault();
    });

    $('body').on('click', '.remove-product-btn',function (e) {
        e.preventDefault();
        var id= $(this).data('id');
        $(this).closest('tr').remove();
        $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');

        calculateTotal();
    });

    $('body').on('keyup change', '.product-quantity',function () {
        var quantity = parseInt($(this).val());
        var unitPrice = $(this).data('price');

        $(this).closest('tr').find('.product-price').html($.number((quantity * unitPrice),2));

        calculateTotal();

    });//end of product quantity change



    $('.order-products').on('click', function(e) {

        e.preventDefault();

        $('#loading').css('display', 'flex');

        var url = $(this).data('url');
        var method = $(this).data('method');
        $.ajax({
            url: url,
            method: method,
            success: function(data) {

                $('#loading').css('display', 'none');
                $('#order-product-list').empty();
                $('#order-product-list').append(data);
            }
        });

    });//end of order products click

    $(document).on('click','.print-btn',function () {
        $('#print-area').printThis({
            printContainer: true,       // print outer container/$.selector
            header: "<h1>إجمالي الفاتورة</h1>"

        });


    });



}); // end of document ready


function calculateTotal() {
    var totalPrice = 0;
    $('.order-list .product-price').each(function (index) {
      totalPrice += parseFloat(($(this).html()).replace(/,/g, ''));

    });
    $('.total-price').html($.number(totalPrice , 2));

    if (totalPrice > 0){
       $('#add-order-btn').removeClass('disabled')
    } else
    {
        $('#add-order-btn').addClass('disabled')
    }
    
}