$(function(){
    $("input[name='product_ean']").blur(function(){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'index.php?route=seller/account-product/jxbookinfo',
            data: {"ean": $(this).val()},
            success: function(data){
                console.log(data);
                $("#product_author").text(data['authors']);
                $("#product_pages").text(data['page']);
                $("#product_preferred_price").text(data['price']);
                $("#product_language").text(data['book_language']);
                $("#product_name").text(data['title']);
                $("#date_published").text(data['date_published']);
                $("#product_description").text(data['description']);
                $("#productimage1").attr("src", data['productimage1']);
                $("#productimage2").attr("src", data['productimage2']);
                if (data['title'] != '') {
                    //$("#ms-product-right").css("display","inline-block");
                } else {
                    //$("#ms-product-right").css("display","none");
                }
            }
        });
    });
});
