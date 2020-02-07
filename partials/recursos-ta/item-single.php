<?php
    $cat = get_the_terms($post->ID, 'categorias-ta');
    $cat_name = $cat[0]->name;
    $cat_ID = $cat[0]->term_id;
?>
<div class="row">
    <div class="col-12 col-lg-9">
        <article class="post">
            <div class="row">
                <div class="col-12">
                    <p class="post__category"><?php echo $cat_name; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="post__title"><?php the_title(); ?></h2>
                </div>
            </div>
            <hr class="post__separator">
            <div class="row">
                <div class="col-12 col-md-6">
                    <small class="post__date">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>&nbsp;publicado em <?php the_time('d'); ?> de <?php the_time('F'); ?> de <?php the_time('Y'); ?>
                        <br>
                        <?php if (get_the_modified_time() != get_the_time()) : ?><i class="fas fa-calendar-alt" aria-hidden="true"></i>&nbsp;&uacute;ltima modifica&ccedil;&atilde;o em <?php the_modified_time('d'); ?> de <?php the_modified_time('F'); ?> de <?php the_modified_time('Y'); ?> <?php endif; ?>
                    </small>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="post__content">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="wp-caption post__thumb">
                                <a href="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0]; ?>"><?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?></a>
                                <?php if ( $caption = get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
                                    <p class="wp-caption-text"><?php echo $caption; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php the_content(); ?>
                        <div class="row">
                            <?php cmb2_output_video_list('_infos_recurso_ta_videos'); ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php $keywords = get_the_tag_list('', ', &nbsp;'); ?>
                                <?php if ($keywords): ?> 
                                    <h3>Palavras-chave</h3>
                                    <?= $keywords ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
    <div class="col-12 col-lg-3">
        <?php cmb2_output_file_list('_infos_recurso_ta_arquivos'); ?>
        <?php cmb2_output_image_list('_infos_recurso_ta_imagens') ?>
    </div>
</div>
