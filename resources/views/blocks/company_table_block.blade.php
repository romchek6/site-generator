<div class="block sortable" id="company-table-block">
    <input type="hidden" name="company_table_block">
    <div class="block-title">Таблица с компаниями</div>
    <div class="text-about">
        Если нужно сделать сайт ссылкой используй запись сайт|+
    </div>
    <div class="table">
        <div class="header-table">Название компании</div>
        <div class="header-table">Рейтинг</div>
        <div class="header-table">Сайт</div>
        @if(!empty($post['title_company']))
            @foreach($post['title_company'] as $key => $item)
                <div class="input">
                    <input type="text" class="cell" value="<?= $item ?>" name="title_company[]">
                    <input type="text" class="cell" value="<?= $post['rating_company'][$key] ?>" name="rating_company[]">
                    <input type="text" class="cell" value="<?= $post['link_company'][$key] ?>" name="link_company[]">
                    <div class="delete-item">+</div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="add-row">
        <div class="add">+</div>
    </div>
</div>
