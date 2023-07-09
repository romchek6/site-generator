<div class="block sortable" id="gallery-block">
    <input type="hidden" name="gallery_block">
    <div class="block-title">Галлерея фото</div>
    <input type="file" name="img[]" id="img" multiple accept="image/*" >
    <div class="gallery">
        @if(!empty($file['img']))
            @foreach($file['img'] as $value)
                <img data-delete="<?= $value ?>" src="{{asset('storage' . $value)}}" alt="">
            @endforeach
        @endif
    </div>
</div>
