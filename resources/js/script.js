$( function() {
    $( "#sortable" ).sortable({
        items: 'div.sortable',
        handle: ".block-title"
    });
});

$('.rounded-md > a').attr('href' , '/domain');
$('.rounded-md > a').text('Домены');
$(document).ready(function() {
    $('.text-editor').summernote();
});
// $('form').on('submit', function (e){
//     e.preventDefault();
//
//     var form = new FormData($(this)[0]);
//     for(var i = 0; i < $('#img').get(0).files.length;i++){
//         form.append('gallery[]', $('#img').get(0).files[i])
//     }
//     $('.product-img-input').each(function (){
//         form.append('product[]', $(this)[0].files[0]);
//     });
//     $('.reviews-logo-input').each(function (){
//         form.append('reviews[]', $(this)[0].files[0]);
//     });
//
//     $.ajax({
//         type: 'POST',
//         url: '/generate',
//         cache: false,
//         processData: false,
//         contentType: false,
//         data: form,
//     }).done(function(data) {
//         console.log(data);
//     }).fail(function(data) {
//         console.log(data);
//     });
// });

$(document).ready(function() {
    $('form').keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});

function handleFileSelect(evt) {
    var file = evt.target.files; // FileList object
    for (var i = 0, f; f = file[i]; i++) {
        if (!f.type.match('image.*')) {
            alert("Image only please....");
        }
        var reader = new FileReader();
        $('.gallery img[data-new="1"]').remove();
        reader.onload = (function (theFile) {
            return function (e) {
                $('.gallery').append('<img data-new="1" src="' + e.target.result + '">')
            };
        })(f);
        reader.readAsDataURL(f);
    }
}
$('body').on('change', '#img', handleFileSelect)
$('body').on('click', '.delete-item', function (){
    $(this).closest('.input').remove();
});

$('body').on('click', '.gallery img[data-delete]', function (){
    let del = $(this).attr('data-delete');
    let token = $('input[name="_token"]').val();
    let id = $('input[name="_id"]').val();
    let img = $(this);
    $.ajax({
        type: 'POST',
        url: '/deleteImg',
        data: {
            "_token": token,
            'path': del,
            'id': id,
        },
    }).done(function(data) {
        img.remove();
    }).fail(function(data) {
        console.log('Ошибка удаления')
    });
});

(function company_table()
{
    let table = $('#company-table-block .table');
    let add = $('#company-table-block .add-row .add');

    add.click(function (){
        table.append('<div class="input">\n' +
            '                            <input type="text" class="cell" name="title_company[]">\n' +
            '                            <input type="text" class="cell" name="rating_company[]">\n' +
            '                            <input type="text" class="cell" name="link_company[]">\n' +
            '                            <div class="delete-item">+</div>\n' +
            '                        </div>');
    });

})();

(function data_table()
{
    let table = $('#data-table-block .table');
    let add = $('#data-table-block .add-row .add');

    add.click(function (){
        table.append('<div class="input">\n' +
            '                            <input type="text" class="cell" name="name_data_company[]">\n' +
            '                            <textarea class="cell" style="height: 32px" name="value_data_company[]"></textarea>\n' +
            '                            <div class="delete-item no_rotate">-</div>\n' +
            '                        </div>');

    });


})();

(function faq_table()
{
    let table = $('#faq-block .table');
    let add = $('#faq-block .add-row .add');

    add.click(function (){
        table.append('<div class="input">\n' +
            '                            <input type="text" class="cell" name="question[]">\n' +
            '                            <textarea class="cell" style="height: 32px" name="response[]"></textarea>\n' +
            '                            <div class="delete-item no_rotate">-</div>\n' +
            '                        </div>');

    });

})();

function attribute_remove(x)
{
    let number = x.closest('.product-attribute').children('input[type=hidden]').val();
    let add = $('.product-item[data-number='+ number +'] .add-attribute');
    $('.product-item[data-number='+ number +'] .attribute-wrap input:last').remove();
    $('.product-item[data-number='+ number +'] .attribute-wrap input:last').remove();

    let count_attribute = $('.product-item[data-number='+ number +'] .attribute-wrap input').length;
    if(count_attribute === 2) $(x).addClass('disabled')
    if(count_attribute === 6) add.removeClass('disabled')
}

function attribute_add(x)
{
    let number = x.closest('.product-attribute').children('input[type=hidden]').val();
    let count_attribute = $('.product-item[data-number='+ number +'] .attribute-wrap input').length;
    if(count_attribute >= 6) $(x).addClass('disabled')
    let table = $('.product-item[data-number='+ number +'] .attribute-wrap');
    let remove = $('.product-item[data-number='+ number +'] .remove-attribute');
    table.append('<input type="text" name="product_attribute[product_'+ number +'][]">' +
        '<input type="text" name="product_attribute-value[product_'+ number +'][]">');
    if(remove.hasClass('disabled')){
        remove.removeClass('disabled');
    }
}

(function item_product()
{
    $('.product-img').css('z-index', '3');
    $('.product-img-input').css('display', 'none');

    $('body').on('click', '.add-attribute', function (){
        attribute_add($(this));
    });
    $('body').on('click', '.remove-attribute', function (){
        attribute_remove($(this));
    });
    $('body').on('change', '.product-item[data-number] .product-img-input', function () {
        var input = $(this)[0];
        let This = $(this);
        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let block = This.closest('.product-item').children('.product-img');
                    block.css('z-index', '3');
                    This.css('display', 'none');
                    block.append('<img src="' + e.target.result + '">')
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                console.log('ошибка, не изображение');
            }
        } else {
            console.log('хьюстон у нас проблема');
        }
    });
    $('body').on('click', '.product-item[data-number] .delete-img' ,function (){
        $(this).closest('.product-img').children('img').remove();
        $(this).closest('.product-item').children('.product-img-input').val('');
        $(this).closest('.product-img').css('z-index', -1);
        $(this).closest('.product-item').children('.product-img-input').css('display', 'block');
    });
    let remove = $('#product-block .add-row .remove-product');
    let add = $('#product-block .add-row .add-product');
    add.click(function (){
        let i = +$('.product-table .product-item:last').attr('data-number');
        if (!$('.product-table .product-item:last')[0]) i = 0;
        let count = $('#product-block .product-table .product-item').length;
        $('.product-table .add-row-product').before('<div class="product-item" data-number="'+ (i + 1) +'">\n' +
            '                            <input type="file" name="product_img_' + (count + 1) + '" class="product-img-input img-'+ (i + 1) +'">\n' +
            '                            <div class="product-img product-img-' + (count + 1) + '" style="z-index: -1">' +
            '                               <div class="delete-img"></div>\n' +
            '                            </div>\n' +
            '                            <div class="product-title">\n' +
            '                                <div class="input-name">Название</div>\n' +
            '                                <input type="text" name="product_name[]">\n' +
            '                            </div>\n' +
            '                            <div class="product-attribute">\n' +
            '                            <input type="hidden" name="key[]" value="' + (i + 1) + '">\n' +
            '                                <div class="input-name">Характеристики</div>\n' +
            '                                <div class="attribute-wrap" >\n' +
            '                                    <input type="text" name="product_attribute[product_' + (i + 1) + '][]">\n' +
            '                                    <input type="text" name="product_attribute-value[product_'+ (i + 1) +'][]">'   +
            '                                </div>\n' +
            '                                <div class="add-row">\n' +
            '                                    <div class="add add-attribute">+</div>\n' +
            '                                    <div class="remove remove-attribute disabled">-</div>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="product-price">\n' +
            '                                <div class="input-name">Цена</div>\n' +
            '                                <input type="text" name="product_price[]">\n' +
            '                            </div>\n' +
            '                            <div class="delete-item2">+</div>\n' +
            '                        </div>');
    });

    $('body').on('click', '.product-item .delete-item2', function (){
        $(this).closest('.product-item').remove();
    })
})();

(function breadcrumbs(){
    let i = 1;
    $('#head-block .add').click(function (){
        $('.breadcrumbs-wrap').append('<div class="input breadcrumbs-item">\n' +
            '                                <input name="breadcrumbs[] jopa'+ i++ +'" id="breadcrumbs">\n' +
            '                                <div class="delete-item">+</div>\n' +
            '                            </div>');
        if($('.breadcrumbs-item').length > 4){
            $('#head-block .add').addClass('disabled');
        }
    });
    $('body').on('click', '#head-block .delete-item' , function (){
        $(this).closest('.input').remove();
        if($('#head-block .add').hasClass('disabled')){
            $('#head-block .add').removeClass('disabled');
        }
    });

})();

(function video_block()
{
    $('body').on('blur', '#video-block .video-item[data-video] input', function (){
        let block = $(this).closest('.video-item').children('.video-img');
        block.empty();
        block.append('<img src="https://i.ytimg.com/vi/' + $(this).val().split('?v=')[1] + '/hqdefault.jpg">')
    })
    $('body').on('click', '.video-item .delete-item2', function (){
        $(this).closest('.video-item').remove();
    })
    let add = $('#video-block .add-video')
    add.click(function (){
        let count = $('#video-block .video-table .video-item').length;
        $('#video-block .video-table .add-row-video').before('<div class="video-item" data-video="' + (count + 1) + '">\n' +
            '                            <div class="video-img">\n' +
            '\n' +
            '                            </div>\n' +
            '                            <div class="video-link">\n' +
            '                                <div class="input-name">Ссылка</div>\n' +
            '                                <input type="text" name="video-link[]">\n' +
            '                                <div class="delete-item2">+</div>\n' +
            '                            </div>\n' +
            '                        </div>');
    });
}());

(function reviews(){

    $('.reviews-img').css('z-index', '3');
    $('.reviews-logo-input').css('display', 'none');

    $('body').on('change', '.reviews-item[data-number] .reviews-logo-input', function () {
        var input = $(this)[0];
        let This = $(this);
        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let block = This.closest('.reviews-item').children('.reviews-img');
                    block.css('z-index', '3');
                    This.css('display', 'none');
                    block.append('<img src="' + e.target.result + '">')
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                console.log('ошибка, не изображение');
            }
        } else {
            console.log('хьюстон у нас проблема');
        }
    });
    $('body').on('click', '.reviews-item[data-number] .delete-img', function (){
        $(this).closest('.reviews-img').children('img').remove();
        $(this).closest('.reviews-item').children('.reviews-logo-input').val('');
        $(this).closest('.reviews-img').css('z-index', -1);
        $(this).closest('.reviews-item').children('.reviews-logo-input').css('display', 'block');
    })
    let add = $('.add-reviews')
    add.click(function (){
        let last_number = +$('#reviews-block .reviews-table .reviews-item:last').attr('data-number');
        if (!$('#reviews-block .reviews-table .reviews-item:last')[0]) last_number = 0;
        $('#reviews-block .reviews-table .add-row-reviews').before('<div class="reviews-item" data-number="' + (last_number + 1) + '">\n' +
            '                            <input type="hidden" value="' + (last_number + 1) + '" name="review_number[]">\n' +
            '                            <input type="file" name="reviews_img_' + (last_number + 1) + '" class="reviews-logo-input">\n' +
            '                            <div class="reviews-img" style="z-index: -1">\n' +
            '                                <div class="delete-img"></div>\n' +
            '                            </div>\n' +
            '                            <div class="reviews-title input-block">\n' +
            '                                <div class="input-name">Название</div>\n' +
            '                                <input type="text" name="reviews_name[]">\n' +
            '                            </div>\n' +
            '                            <div class="reviews-rating input-block">\n' +
            '                                <div class="input-name">Рейтинг</div>\n' +
            '                                <input type="text" name="reviews_rating[]">\n' +
            '                            </div>\n' +
            '                            <div class="count-reviews input-block">\n' +
            '                                <div class="input-name">Количество отзывов</div>\n' +
            '                                <input type="text" name="count_reviews[]">\n' +
            '                            </div>\n' +
            '                            <div class="reviews-text input-block">\n' +
            '                                <div class="input-name">Отзыв</div>\n' +
            '                                <textarea  name="reviews_text[]"></textarea>\n' +
            '                            </div>\n' +
            '                            <div class="delete-item2">+</div>\n' +
            '                        </div>')
    })

    $('body').on('click', '.reviews-item .delete-item2', function (){
        $(this).closest('.reviews-item').remove();
    })
}());
