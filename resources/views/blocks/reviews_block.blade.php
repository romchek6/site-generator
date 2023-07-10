<div class="block sortable" id="reviews-block">
    <input type="hidden" name="reviews_block">
    <div class="block-title">Отзывы</div>
    <div class="text-about">
        Если нужно добавить в название ссылку используй запись (НАЗВАНИЕ)|(ССЫЛКА)
    </div>
    <div class="reviews-table">
        @if(!empty($post['reviews_name'][0]))
            @foreach($post['reviews_name'] as $key => $value)
                <div class="reviews-item" data-number="<?= $post['review_number'][$key] ?>">
                    <input type="hidden" value="<?= $post['review_number'][$key] ?>" name="review_number[]">
                    <input type="file" name="reviews_img_<?= $post['review_number'][$key] ?>" class="reviews-logo-input">
                    <div class="reviews-img" style="z-index: -1">
                        <img src="/storage<?= $file['reviews_img']['reviews_img_' . $post['review_number'][$key]] ?>" alt="">
                        <div class="delete-img"></div>
                    </div>
                    <div class="reviews-title input-block">
                        <div class="input-name">Название компании</div>
                        <input type="text" value="<?= $value ?>" name="reviews_name[]">
                    </div>
                    <div class="reviews-rating input-block">
                        <div class="input-name">Рейтинг</div>
                        <input type="text" value="<?= $post['reviews_rating'][$key] ?>"  name="reviews_rating[]">
                    </div>
                    <div class="count-reviews input-block">
                        <div class="input-name">Количество отзывов</div>
                        <input type="text" value="<?= $post['count_reviews'][$key] ?>" name="count_reviews[]">
                    </div>
                    <div class="reviews-text input-block">
                        <div class="input-name">Отзыв</div>
                        <textarea  name="reviews_text[]"><?= $post['reviews_text'][$key] ?></textarea>
                    </div>
                    <div class="delete-item2">+</div>
                </div>
            @endforeach
        @endif
        <div class="add-row add-row-reviews">
            <div class="add add-reviews">+</div>
        </div>
    </div>
</div>
