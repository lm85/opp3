jQuery( document ).ready(function($) {
    setInterval(function() {
        var postFormat = $('input[name="post_format"]:checked').val();
        if (postFormat == 'gallery') {
            $('select[name="size"]').val('wcslider');
            $('select[name="targetsize"]').val('full');
            $('select[name="display"]').val('slider2');
            $('select[name="captions"]').val('show');
        }
        }, 3000);
});
