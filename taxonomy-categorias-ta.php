<?php get_header(); ?>

<?php 
    global $wp_query;
    $query = $wp_query->query;
    
    $_POST['filter_recursos'] = true;
    $_POST['filter_categorias_ta'] =  get_queried_object_id();
    
    
?>
<?php get_template_part('partials/recursos-ta/list'); ?>

<?php get_footer(); ?>
