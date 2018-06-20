<div class="row">
<?php if (get_header_image() != '') : ?>
    <div class="col-xs-12">
        <h1 class="sr-only"><?php bloginfo('name'); ?></h1>
        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" class="img-responsive"/></a>
    </div>
<?php else: ?>
    <div class="col-xs-12 col-sm-2 visible-sm visible-md visible-lg">
        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/if.png" alt="Logo do IF" class="center-block"></a>
    </div>
    <div class="col-xs-12 col-sm-10">
        <div class="row">
            <div class="col-xs-12">
                <p class="title-ifrs"><?php _e('Instituto Federal de Educação, Ciência e Tecnologia do Rio Grande do Sul'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h1 class="title-site"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>
