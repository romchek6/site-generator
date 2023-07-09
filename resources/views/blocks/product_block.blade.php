<div class="block sortable" id="product-block">
    <input type="hidden" name="product_block">
    <div class="block-title">Товары</div>
    <div class="text-about">
        Если нужно добавить в название ссылку используй запись (НАЗВАНИЕ)|(ССЫЛКА)
    </div>
    <div class="product-table">
        <div class="product-item" data-number="1">
            <input type="file" name="product-img[]" class="product-img-input">
            <div class="product-img" style="z-index: -1">
                <div class="delete-img"></div>
            </div>
            <div class="product-title">
                <div class="input-name">Название</div>
                <input type="text" name="product-name[]">
            </div>
            <div class="product-attribute">
                <input type="hidden" name="key[]" value="1">
                <div class="input-name">Характеристики</div>
                <div class="attribute-wrap">
                    <input type="text" name="product-attribute[product-1][]">
                    <input type="text" name="product-attribute-value[product-1][]">
                </div>
                <div class="add-row">
                    <div class="add add-attribute">+</div>
                    <div class="remove remove-attribute disabled">-</div>
                </div>
            </div>
            <div class="product-price">
                <div class="input-name">Цена</div>
                <input type="text" name="product-price[]">
            </div>
            <div class="delete-item2">+</div>
        </div>
        <div class="add-row add-row-product">
            <div class="add add-product">+</div>
        </div>
    </div>
</div>
