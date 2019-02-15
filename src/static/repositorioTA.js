jQuery(document).ready(function(jQuery){
    var jQueryall_oembed_videos = jQuery("iframe[src*='youtube']");

    jQueryall_oembed_videos.each(function() {

        jQuery(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );

    });
    // jQuery('#tag-search').selectWoo({
    //     tags: true,
    //     tokenSeparators: [',']
    // });
    // jQuery('#categories').selectWoo();

    jQuery('.tag-recomendacao').click(function(e){
        e.preventDefault();
        let tags = jQuery('#tag-search').val();
        let name = jQuery(this).data('name');
        tags.push(name);
        jQuery('#tag-search').val(tags);
        jQuery('#tag-search').trigger('change');
        jQuery(this).remove();
        jQuery('#buscar').click();
    });
});