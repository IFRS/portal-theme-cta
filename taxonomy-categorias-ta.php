<?php get_header(); ?>

<?php 
    $_POST['filter_recursos'] = true;
    $_POST['filter_categorias_ta'] =  get_queried_object_id();
?>
<?php get_template_part('partials/recursos-ta/list'); ?>

<?php get_footer(); ?>




