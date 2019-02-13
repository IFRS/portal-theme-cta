$(document).ready(function($){
    var $all_oembed_videos = $("iframe[src*='youtube']");

    $all_oembed_videos.each(function() {

        $(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );

    });
    // $('#tag-search').selectWoo({
    //     tags: true,
    //     tokenSeparators: [',']
    // });
    // $('#categories').selectWoo();

    $('.tag-recomendacao').click(function(e){
        e.preventDefault();
        let tags = $('#tag-search').val();
        let name = $(this).data('name');
        tags.push(name);
        $('#tag-search').val(tags);
        $('#tag-search').trigger('change');
        $(this).remove();
        $('#buscar').click();
    });
});