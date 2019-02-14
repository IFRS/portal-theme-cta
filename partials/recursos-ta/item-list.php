<div class="row">
    <div class="col-12">
        <a href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('post-thumbnail', array('class' => 'img-fluid noticia__img', 'alt' => '')); ?>
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/noticia-placeholder-<?php echo mt_rand(0, 9); ?>.png" alt="" class="img-fluid noticia__img"/>
        <?php endif; ?>
        <h3 class="noticia__titulo"><?php the_title(); ?></h3>
        </a>
    </div>
</div>
