import './bootstrap';
import '../css/style.css';
import '../css/app.css';

$( function() {
    $( "#sortable" ).sortable({
        items: 'div.sortable',
        handle: ".block-title"
    });
});

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
        $('.gallery').empty();
        reader.onload = (function (theFile) {
            return function (e) {
                $('.gallery').append('<img src="' + e.target.result + '">')
            };
        })(f);
        reader.readAsDataURL(f);
    }
}
document.getElementById('img').addEventListener('change', handleFileSelect, false);

$('body').on('click', '.delete-item', function (){
    $(this).closest('.input').remove();
});

(function company_table()
{
    let table = $('#company-table-block .table');
    let add = $('#company-table-block .add-row .add');

    add.click(function (){
        table.append('<div class="input">\n' +
            '                            <input type="text" class="cell" name="title-company[]">\n' +
            '                            <input type="text" class="cell" name="rating-company[]">\n' +
            '                            <input type="text" class="cell" name="link-company[]">\n' +
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
            '                            <input type="text" class="cell" name="name-data-company[]">\n' +
            '                            <textarea class="cell" style="height: 32px" name="value-data-company[]"></textarea>\n' +
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
    let number = $(x).closest('.product-item').attr('data-number');
    let add = $('.product-item[data-number='+ number +'] .add-attribute');
    $('.product-item[data-number='+ number +'] .attribute-wrap input:last').remove();
    $('.product-item[data-number='+ number +'] .attribute-wrap input:last').remove();

    let count_attribute = $('.product-item[data-number='+ number +'] .attribute-wrap input').length;
    if(count_attribute === 2) $(x).addClass('disabled')
    if(count_attribute === 6) add.removeClass('disabled')
}

function attribute_add(x)
{

    let number = $(x).closest('.product-item').attr('data-number');
    let count_attribute = $('.product-item[data-number='+ number +'] .attribute-wrap input').length;
    if(count_attribute === 6) $(x).addClass('disabled')
    let table = $('.product-item[data-number='+ number +'] .attribute-wrap');
    let remove = $('.product-item[data-number='+ number +'] .remove-attribute');
    table.append('<input type="text" name="product-attribute[product-'+ number +'][]">' +
        '<input type="text" name="product-attribute-value[product-'+ number +'][]">');
    if(remove.hasClass('disabled')){
        remove.removeClass('disabled');
    }
}

(function item_product()
{
    $('.add-attribute').click(function (){
        attribute_add($(this));
    });
    $('.remove-attribute').click(function (){
        attribute_remove($(this));
    });
    $('.product-item[data-number="1"] .product-img-input').change(function () {
        var input = $(this)[0];
        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let block = $('.product-item[data-number="1"] .product-img');
                    block.css('z-index', '3');
                    $('.product-item[data-number="1"] .product-img-input').css('display', 'none');
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
    $('.product-item[data-number="1"] .delete-img').click(function (){
        $('.product-item[data-number="1"] .product-img img').remove();
        $('.product-item[data-number="1"] .product-img-input').val('');
        $('.product-item[data-number="1"] .product-img').css('z-index', -1);
        $('.product-item[data-number="1"] .product-img-input').css('display', 'block');
    });

    let remove = $('#product-block .add-row .remove-product');
    let add = $('#product-block .add-row .add-product');
    add.click(function (){
        let last_elem = $('#product-block .product-table .product-item:last');
        let count = $('#product-block .product-table .product-item').length;
        last_elem.after('<div class="product-item" data-number="'+ (count + 1) +'">\n' +
            '                            <input type="file" name="product-img[]" class="product-img-input img-'+ (count + 1) +'">\n' +
            '                            <div class="product-img product-img-' + (count + 1) + '" style="z-index: -1">' +
            '                               <div class="delete-img"></div>\n' +
            '                            </div>\n' +
            '                            <div class="product-title">\n' +
            '                                <div class="input-name">Название</div>\n' +
            '                                <input type="text" name="product-name[]">\n' +
            '                            </div>\n' +
            '                            <div class="product-attribute">\n' +
            '                                <div class="input-name">Характеристики</div>\n' +
            '                                <div class="attribute-wrap" >\n' +
            '                                    <input type="text" name="product-attribute[product-' +(count + 1) + '][]">\n' +
            '                                    <input type="text" name="product-attribute-value[product-'+ (count + 1) +'][]">'   +
            '                                </div>\n' +
            '                                <div class="add-row">\n' +
            '                                    <div class="add add-attribute">+</div>\n' +
            '                                    <div class="remove remove-attribute disabled">-</div>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="product-price">\n' +
            '                                <div class="input-name">Цена</div>\n' +
            '                                <input type="text" name="product-price[]">\n' +
            '                            </div>\n' +
            '                        </div>');
        if(remove.hasClass('disabled')){
            remove.removeClass('disabled');
        }

        $('.product-item[data-number="'+ (count + 1) +'"] .add-attribute').click(function (){
            attribute_add($(this));
        });
        $('.product-item[data-number="'+ (count + 1) +'"] .remove-attribute').click(function (){
            attribute_remove($(this));
        });
        $('.product-item[data-number="' + (count + 1) + '"] .product-img-input').change(function () {
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                if (input.files[0].type.match('image.*')) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        let block = $('.product-item[data-number="' + (count + 1) + '"] .product-img');
                        block.css('z-index', '3');
                        $('.product-item[data-number="' + (count + 1) + '"] .product-img-input').css('display', 'none');
                        block.append('<img src="' + e.target.result + '">');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    console.log('ошибка, не изображение');
                }
            } else {
                console.log('хьюстон у нас проблема');
            }
        });
        $('.product-item[data-number="' + (count + 1) + '"] .delete-img').click(function (){
            $('.product-item[data-number="' + (count + 1) + '"] .product-img img').remove();
            $('.product-item[data-number="' + (count + 1) + '"] .product-img-input').val('');
            $('.product-item[data-number="' + (count + 1) + '"] .product-img').css('z-index', -1);
            $('.product-item[data-number="' + (count + 1) + '"] .product-img-input').css('display', 'block');
        });

    });

    remove.click(function (){
        $('#product-block .product-table .product-item:last').remove();
        if($('#product-block .product-table .product-item').length === 1){
            remove.addClass('disabled');
        }
    });
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

(function video_block(){
    $('#video-block .video-item[data-video="1"] input').on('blur', function (){
       let block = $('#video-block .video-item[data-video="1"] .video-img');
       block.empty();
       block.append('<img src="https://i.ytimg.com/vi/' + $(this).val().split('?v=')[1] + '/hqdefault.jpg">')
    })

    let add = $('#video-block .add-video'),
        remove = $('#video-block .remove-video')

    add.click(function (){
        let count = $('#video-block .video-table .video-item').length;
        $('#video-block .video-table .video-item:last').after('<div class="video-item" data-video="' + (count + 1) + '">\n' +
            '                            <div class="video-img">\n' +
            '\n' +
            '                            </div>\n' +
            '                            <div class="video-link">\n' +
            '                                <div class="input-name">Ссылка</div>\n' +
            '                                <input type="text" name="video-link[]">\n' +
            '                            </div>\n' +
            '                        </div>');

        $('#video-block .video-item[data-video="' + (count + 1) + '"] input').on('blur', function (){
            let block = $('.video-item[data-video="' + (count + 1) + '"] .video-img');
            block.empty();
            block.append('<img src="https://i.ytimg.com/vi/' + $(this).val().split('?v=')[1] + '/hqdefault.jpg">')
        });
        if(remove.hasClass('disabled')){
            remove.removeClass('disabled');
        }
    });

    remove.click(function (){
        $('#video-block .video-table .video-item:last').remove();
        if($('#video-block .video-table .video-item').length === 1){
            remove.addClass('disabled');
        }
    });
}());

(function reviews(){

    $('.reviews-item[data-number="1"] .reviews-logo-input').change(function () {
        var input = $(this)[0];
        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let block = $('.reviews-item[data-number="1"]  .reviews-img');
                    block.css('z-index', '3');
                    $('.reviews-item[data-number="1"] .reviews-logo-input').css('display', 'none');
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
    $('.reviews-item[data-number="1"] .delete-img').click(function (){
        $('.reviews-item[data-number="1"] .reviews-img img').remove();
        $('.reviews-item[data-number="1"] .reviews-logo-input').val('');
        $('.reviews-item[data-number="1"] .reviews-img').css('z-index', -1);
        $('.reviews-item[data-number="1"] .reviews-logo-input').css('display', 'block');

    });

    let add = $('.add-reviews'),
        remove = $('.remove-reviews')

    add.click(function (){
        let count = $('#reviews-block .reviews-table .reviews-item').length;

        $('#reviews-block .reviews-table .reviews-item:last').after('<div class="reviews-item" data-number="' + (count + 1) + '">\n' +
            '                            <input type="file" name="reviews-img[]" class="reviews-logo-input">\n' +
            '                            <div class="reviews-img" style="z-index: -1">\n' +
            '                                <div class="delete-img"></div>\n' +
            '                            </div>\n' +
            '                            <div class="reviews-title input-block">\n' +
            '                                <div class="input-name">Название</div>\n' +
            '                                <input type="text" name="reviews-name[]">\n' +
            '                            </div>\n' +
            '                            <div class="reviews-rating input-block">\n' +
            '                                <div class="input-name">Рейтинг</div>\n' +
            '                                <input type="text" name="reviews-rating[]">\n' +
            '                            </div>\n' +
            '                            <div class="count-reviews input-block">\n' +
            '                                <div class="input-name">Количество отзывов</div>\n' +
            '                                <input type="text" name="count-reviews[]">\n' +
            '                            </div>\n' +
            '                            <div class="reviews-text input-block">\n' +
            '                                <div class="input-name">Отзыв</div>\n' +
            '                                <textarea  name="reviews-text[]"></textarea>\n' +
            '                            </div>\n' +
            '                        </div>')

        if(remove.hasClass('disabled')){
            remove.removeClass('disabled');
        }
        $('.reviews-item[data-number="' + (count + 1) + '"] .reviews-logo-input').change(function () {
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                if (input.files[0].type.match('image.*')) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        let block = $('.reviews-item[data-number="' + (count + 1) + '"] .reviews-img');
                        block.css('z-index', '3');
                        $('.reviews-item[data-number="' + (count + 1) + '"] .reviews-logo-input').css('display', 'none');
                        block.append('<img src="' + e.target.result + '">');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    console.log('ошибка, не изображение');
                }
            } else {
                console.log('хьюстон у нас проблема');
            }
        });
        $('.reviews-item[data-number="' + (count + 1) + '"] .delete-img').click(function (){
            $('.reviews-item[data-number="' + (count + 1) + '"] .reviews-img img').remove();
            $('.reviews-item[data-number="' + (count + 1) + '"] .reviews-logo-input').val('');
            $('.reviews-item[data-number="' + (count + 1) + '"] .reviews-img').css('z-index', -1);
            $('.reviews-item[data-number="' + (count + 1) + '"] .reviews-logo-input').css('display', 'block');
        });
    })

    remove.click(function (){
        $('#reviews-block .reviews-table .reviews-item:last').remove();
        if($('#reviews-block .reviews-table .reviews-item').length === 1){
            remove.addClass('disabled');
        }
    });

}());






