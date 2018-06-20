<?php get_header(); ?>

<?php if (is_active_sidebar('widget-home')) : ?>
<div class="row">
    <div class="col-xs-12">
        <?php if (!dynamic_sidebar('widget-home')) : endif; ?>
    </div>
</div>
<?php endif; ?>

<?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 2
    );

    $query = new WP_Query($args);
?>

<div class="row">
    <?php while ($query->have_posts() && $query->current_post < 1) : $query->the_post(); ?>
        <div class="col-xs-12 col-md-6">
            <article class="noticia">
                    <?php get_template_part('partials/noticias/item'); ?>
            </article>
        </div>
    <?php endwhile; ?>
    <div class="col-xs-12">
        <?php wp_reset_query(); ?>
        <hr class="separador-noticia">
        <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="pull-right link-todas-noticias"><?php _e('Acesse mais notícias'); ?></a>
    </div>
</div>

<?php if (is_active_sidebar('widget-docs') || is_active_sidebar('widget-home-side')) : ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <?php if (!dynamic_sidebar('widget-docs')) : endif; ?>
    </div>
    <div class="col-xs-12 col-md-6">
        <?php if (!dynamic_sidebar('widget-home-side')) : endif; ?>
    </div>
</div>
<?php endif; ?>

<?php if (is_active_sidebar('widget-gallery')) : ?>
<div class="row">
    <div class="col-xs-12">
        <?php if (!dynamic_sidebar('widget-gallery')) : endif; ?>
    </div>
</div>
<?php endif; ?>

<?php if (is_active_sidebar('widget-atalhos')) : ?>
<div class="row">
    <div class="col-xs-12">
        <h2 class="title-box"><?php _e('Acesso R&aacute;pido'); ?></h2>
        <nav>
            <ul class="area-atalhos">
                <?php if (!dynamic_sidebar('widget-atalhos')) : endif; ?>
            </ul>
        </nav>
    </div>
</div>
<?php endif; ?>

<?php if (is_active_sidebar('widget-banners')) : ?>
<hr class="banner-separator">

<div class="row">
    <div class="col-xs-12">
        <?php if (!dynamic_sidebar('widget-banners')) : endif; ?>
    </div>
</div>
<?php endif; ?>

<?php get_footer(); ?>
