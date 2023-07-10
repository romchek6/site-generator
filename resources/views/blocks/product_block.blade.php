<div class="block sortable" id="product-block">
    <input type="hidden" name="product_block">
    <div class="block-title">Товары</div>
    <div class="text-about">
        Если нужно добавить в название ссылку используй запись (НАЗВАНИЕ)|(ССЫЛКА)
    </div>
    <div class="product-table">
        @if(!empty($post['product_name'][0]))
            <?php
                $post['product_attribute'] = (array)$post['product_attribute'];
                $post['product_attribute-value'] = (array)$post['product_attribute-value'];
            ?>
            @foreach($post['product_name'] as $key => $value)
                <div class="product-item" data-number="<?= $post['key'][$key] ?>">
                    <input type="file" name="product_img_<?= $post['key'][$key] ?>" class="product-img-input">
                    <div class="product-img" style="z-index: -1">
                        <img src="/storage<?= $file['product_img']['product_img_' . $post['key'][$key]] ?>" alt="">
                        <div class="delete-img"></div>
                    </div>
                    <div class="product-title">
                        <div class="input-name">Название</div>
                        <input type="text" value="<?= $value ?>" name="product_name[]">
                    </div>
                    <div class="product-attribute">
                        <input type="hidden" name="key[]" value="<?= $post['key'][$key] ?>">
                        <div class="input-name">Характеристики</div>
                        <div class="attribute-wrap">
                            @if($post['product_attribute']['product_' . $post['key'][$key]])
                                @foreach($post['product_attribute']['product_' . $post['key'][$key]] as $i => $item)
                                <input type="text" value="<?= $item ?>" name="product_attribute[product_<?= $post['key'][$key] ?>][]">
                                <input type="text" value="<?= $post['product_attribute-value']['product_' . $post['key'][$key]][$i] ?>" name="product_attribute-value[product_<?= $post['key'][$key] ?>][]">
                                @endforeach
                            @endif
                        </div>
                        <div class="add-row">
                            <div class="add add-attribute">+</div>
                            <div class="remove remove-attribute disabled">-</div>
                        </div>
                    </div>
                    <div class="product-price">
                        <div class="input-name">Цена</div>
                        <input type="text" value="<?= $post['product_price'][$key] ?>" name="product_price[]">
                    </div>
                    <div class="delete-item2">+</div>
                </div>
            @endforeach
        @endif
        <div class="add-row add-row-product">
            <div class="add add-product">+</div>
        </div>
    </div>
</div>
