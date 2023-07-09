<div class="block sortable" id="faq-block">
    <input type="hidden" name="faq_block">
    <div class="block-title">Вопрос - Ответ</div>
    <div class="table">
        <div class="header-table">Вопрос</div>
        <div class="header-table">Ответ</div>
        @if(!empty($post['question']))
            @foreach($post['question'] as $key => $value)
                <div class="input">
                    <input type="text" class="cell" value="<?= $value ?>" name="question[]">
                    <textarea class="cell" style="height: 32px" name="response[]"><?= $post['response'][$key] ?></textarea>
                    <div class="delete-item no_rotate">-</div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="add-row">
        <div class="add">+</div>
    </div>
</div>
