<div class="block sortable" id="data-table-block">
    <input type="hidden" name="data_table_block">
    <div class="block-title">Таблица с данными</div>
    <div class="table">
        <div class="header-table">Название</div>
        <div class="header-table">Описание</div>
        @if(!empty($post['name_data_company']))
            @foreach($post['name_data_company'] as $key => $value)
                <div class="input">
                    <input type="text" class="cell" value="<?= $value ?>" name="name_data_company[]">
                    <textarea class="cell" style="height: 32px" name="value_data_company[]"><?= $post['value_data_company'][$key] ?></textarea>
                    <div class="delete-item no_rotate">-</div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="add-row">
        <div class="add">+</div>
    </div>
</div>
