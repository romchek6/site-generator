<div class="block sortable" id="video-block">
    <input type="hidden" name="video_block">
    <div class="block-title">Видео</div>
    <div class="text-about">
        Ссылка на видео в форматe https://www.youtube.com/watch?v=xRModWEEuE8
    </div>
    <div class="video-table">
        @if(!empty($post['video-link']))
            @foreach($post['video-link'] as $value)
                <div class="video-item" data-video="1">
                    <div class="video-img">
                            <?php $link = explode('?v=', $value) ?>
                        <img src="https://i.ytimg.com/vi/<?= isset($link[1])?$link[1]:'' ?>/hqdefault.jpg" alt="">
                    </div>
                    <div class="video-link">
                        <div class="input-name">Ссылка</div>
                        <input type="text" name="video-link[]" value="<?= $value ?>">
                        <div class="delete-item2">+</div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="add-row add-row-video">
            <div class="add add-video">+</div>
        </div>
    </div>
</div>
