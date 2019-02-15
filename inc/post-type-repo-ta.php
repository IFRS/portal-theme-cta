<?php

/**
 * POST TYPE
 * 
 * {"recurso-ta":{"name":"recurso-ta","label":"Recursos de TA","singular_label":"Recurso de TA","description":"Reposit\u00f3rio de Tecnologias Assistivas do CTA","public":"true","publicly_queryable":"true","show_ui":"true","show_in_nav_menus":"true","show_in_rest":"false","rest_base":"","has_archive":"true","has_archive_string":"","exclude_from_search":"false","capability_type":"post","hierarchical":"true","rewrite":"true","rewrite_slug":"","rewrite_withfront":"true","query_var":"true","query_var_slug":"","menu_position":"5","show_in_menu":"true","show_in_menu_string":"","menu_icon":"","supports":["title","editor","thumbnail"],"taxonomies":["post_tag","categorias-ta"],"labels":{"menu_name":"Recursos de TA","all_items":"Todos Recursos","add_new":"Cadastrar novo","add_new_item":"Cadastrar novo Recurso","edit_item":"Editar Recurso","new_item":"Novo Recurso","view_item":"Ver Recurso","view_items":"Ver Recursos","search_items":"Buscar Recursos","not_found":"Nenhum Recurso encontrado","not_found_in_trash":"Nenhum Recurso encontrado na lixeira","parent":"Recurso Pai:","featured_image":"Imagem de destaque","set_featured_image":"Adicionar imagem de destaque","remove_featured_image":"Remover imagem de destaque","use_featured_image":"Utilizar como imagem de destaque","archives":"Reposit\u00f3rio de TAs","insert_into_item":"Inserir no Recurso","uploaded_to_this_item":"Carregar neste Recurso","filter_items_list":"Filtrar lista de Recursos","items_list_navigation":"Navega\u00e7\u00e3o da lista de Recursos","items_list":"Lista de Recursos","attributes":"Atributos do Recurso","parent_item_colon":"Recurso Pai:"},"custom_supports":""}}
 */

 /**
  * TAXONOMIES
  *
  * {"categorias-ta":{"name":"categorias-ta","label":"Categorias de TA","singular_label":"Categoria de TA","description":"Divis\u00e3o das Categorias de Recursos de Tecnologia Assistiva.","public":"true","hierarchical":"true","show_ui":"true","show_in_menu":"true","show_in_nav_menus":"true","query_var":"true","query_var_slug":"","rewrite":"true","rewrite_slug":"","rewrite_withfront":"1","rewrite_hierarchical":"0","show_admin_column":"false","show_in_rest":"false","show_in_quick_edit":"","rest_base":"","labels":{"menu_name":"Categorias de TA","all_items":"Todas categorias","edit_item":"Editar categoria","view_item":"Visualizar categoria","update_item":"Modificar nome da Categoria","add_new_item":"Adicionar nova Categoria","new_item_name":"Novo nome de Categoria","parent_item":"Categoria Superior","parent_item_colon":"Categoria Superior:","search_items":"Pesquisar Categorias","popular_items":"Categorias Populares","add_or_remove_items":"Adicionar ou remover Categorias","not_found":"Nenhuma categoria encontrada","no_terms":"Nenhuma categoria","items_list":"Lista de Categorias","separate_items_with_commas":"","choose_from_most_used":"","items_list_navigation":""},"object_types":["recurso-ta"]}}
  */


function cptui_register_my_cpts() {

    /**
     * Post Type: Recursos de TA.
     */

    $labels = array(
        "name" => __( "Recursos de TA", "ifrs-portal-theme-cta" ),
        "singular_name" => __( "Recurso de TA", "ifrs-portal-theme-cta" ),
        "menu_name" => __( "Recursos de TA", "ifrs-portal-theme-cta" ),
        "all_items" => __( "Todos Recursos", "ifrs-portal-theme-cta" ),
        "add_new" => __( "Cadastrar novo", "ifrs-portal-theme-cta" ),
        "add_new_item" => __( "Cadastrar novo Recurso", "ifrs-portal-theme-cta" ),
        "edit_item" => __( "Editar Recurso", "ifrs-portal-theme-cta" ),
        "new_item" => __( "Novo Recurso", "ifrs-portal-theme-cta" ),
        "view_item" => __( "Ver Recurso", "ifrs-portal-theme-cta" ),
        "view_items" => __( "Ver Recursos", "ifrs-portal-theme-cta" ),
        "search_items" => __( "Buscar Recursos", "ifrs-portal-theme-cta" ),
        "not_found" => __( "Nenhum Recurso encontrado", "ifrs-portal-theme-cta" ),
        "not_found_in_trash" => __( "Nenhum Recurso encontrado na lixeira", "ifrs-portal-theme-cta" ),
        "parent_item_colon" => __( "Recurso Pai:", "ifrs-portal-theme-cta" ),
        "featured_image" => __( "Imagem de destaque", "ifrs-portal-theme-cta" ),
        "set_featured_image" => __( "Adicionar imagem de destaque", "ifrs-portal-theme-cta" ),
        "remove_featured_image" => __( "Remover imagem de destaque", "ifrs-portal-theme-cta" ),
        "use_featured_image" => __( "Utilizar como imagem de destaque", "ifrs-portal-theme-cta" ),
        "archives" => __( "Repositório de TAs", "ifrs-portal-theme-cta" ),
        "insert_into_item" => __( "Inserir no Recurso", "ifrs-portal-theme-cta" ),
        "uploaded_to_this_item" => __( "Carregar neste Recurso", "ifrs-portal-theme-cta" ),
        "filter_items_list" => __( "Filtrar lista de Recursos", "ifrs-portal-theme-cta" ),
        "items_list_navigation" => __( "Navegação da lista de Recursos", "ifrs-portal-theme-cta" ),
        "items_list" => __( "Lista de Recursos", "ifrs-portal-theme-cta" ),
        "attributes" => __( "Atributos do Recurso", "ifrs-portal-theme-cta" ),
        "parent_item_colon" => __( "Recurso Pai:", "ifrs-portal-theme-cta" ),
    );

    $args = array(
        "label" => __( "Recursos de TA", "ifrs-portal-theme-cta" ),
        "labels" => $labels,
        "description" => "Repositório de Tecnologias Assistivas do CTA",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "rewrite" => array( "slug" => "recurso-ta", "with_front" => true ),
        "query_var" => true,
        "menu_position" => 5,
        "supports" => array( "title", "editor", "thumbnail" ),
        "taxonomies" => array( "post_tag", "categorias-ta" ),
    );

    register_post_type( "recurso-ta", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );




function cptui_register_my_cpts_recurso_ta() {

	/**
	 * Post Type: Recursos de TA.
	 */

	$labels = array(
		"name" => __( "Recursos de TA", "ifrs-portal-theme-cta" ),
		"singular_name" => __( "Recurso de TA", "ifrs-portal-theme-cta" ),
		"menu_name" => __( "Recursos de TA", "ifrs-portal-theme-cta" ),
		"all_items" => __( "Todos Recursos", "ifrs-portal-theme-cta" ),
		"add_new" => __( "Cadastrar novo", "ifrs-portal-theme-cta" ),
		"add_new_item" => __( "Cadastrar novo Recurso", "ifrs-portal-theme-cta" ),
		"edit_item" => __( "Editar Recurso", "ifrs-portal-theme-cta" ),
		"new_item" => __( "Novo Recurso", "ifrs-portal-theme-cta" ),
		"view_item" => __( "Ver Recurso", "ifrs-portal-theme-cta" ),
		"view_items" => __( "Ver Recursos", "ifrs-portal-theme-cta" ),
		"search_items" => __( "Buscar Recursos", "ifrs-portal-theme-cta" ),
		"not_found" => __( "Nenhum Recurso encontrado", "ifrs-portal-theme-cta" ),
		"not_found_in_trash" => __( "Nenhum Recurso encontrado na lixeira", "ifrs-portal-theme-cta" ),
		"parent_item_colon" => __( "Recurso Pai:", "ifrs-portal-theme-cta" ),
		"featured_image" => __( "Imagem de destaque", "ifrs-portal-theme-cta" ),
		"set_featured_image" => __( "Adicionar imagem de destaque", "ifrs-portal-theme-cta" ),
		"remove_featured_image" => __( "Remover imagem de destaque", "ifrs-portal-theme-cta" ),
		"use_featured_image" => __( "Utilizar como imagem de destaque", "ifrs-portal-theme-cta" ),
		"archives" => __( "Repositório de TAs", "ifrs-portal-theme-cta" ),
		"insert_into_item" => __( "Inserir no Recurso", "ifrs-portal-theme-cta" ),
		"uploaded_to_this_item" => __( "Carregar neste Recurso", "ifrs-portal-theme-cta" ),
		"filter_items_list" => __( "Filtrar lista de Recursos", "ifrs-portal-theme-cta" ),
		"items_list_navigation" => __( "Navegação da lista de Recursos", "ifrs-portal-theme-cta" ),
		"items_list" => __( "Lista de Recursos", "ifrs-portal-theme-cta" ),
		"attributes" => __( "Atributos do Recurso", "ifrs-portal-theme-cta" ),
		"parent_item_colon" => __( "Recurso Pai:", "ifrs-portal-theme-cta" ),
	);

	$args = array(
		"label" => __( "Recursos de TA", "ifrs-portal-theme-cta" ),
		"labels" => $labels,
		"description" => "Repositório de Tecnologias Assistivas do CTA",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "recurso-ta", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,
		"supports" => array( "title", "editor", "thumbnail" ),
		"taxonomies" => array( "post_tag", "categorias-ta" ),
	);

	register_post_type( "recurso-ta", $args );
}

add_action( 'init', 'cptui_register_my_cpts_recurso_ta' );





function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Categorias de TA.
	 */

	$labels = array(
		"name" => __( "Categorias de TA", "ifrs-portal-theme-cta" ),
		"singular_name" => __( "Categoria de TA", "ifrs-portal-theme-cta" ),
		"menu_name" => __( "Categorias de TA", "ifrs-portal-theme-cta" ),
		"all_items" => __( "Todas categorias", "ifrs-portal-theme-cta" ),
		"edit_item" => __( "Editar categoria", "ifrs-portal-theme-cta" ),
		"view_item" => __( "Visualizar categoria", "ifrs-portal-theme-cta" ),
		"update_item" => __( "Modificar nome da Categoria", "ifrs-portal-theme-cta" ),
		"add_new_item" => __( "Adicionar nova Categoria", "ifrs-portal-theme-cta" ),
		"new_item_name" => __( "Novo nome de Categoria", "ifrs-portal-theme-cta" ),
		"parent_item" => __( "Categoria Superior", "ifrs-portal-theme-cta" ),
		"parent_item_colon" => __( "Categoria Superior:", "ifrs-portal-theme-cta" ),
		"search_items" => __( "Pesquisar Categorias", "ifrs-portal-theme-cta" ),
		"popular_items" => __( "Categorias Populares", "ifrs-portal-theme-cta" ),
		"add_or_remove_items" => __( "Adicionar ou remover Categorias", "ifrs-portal-theme-cta" ),
		"not_found" => __( "Nenhuma categoria encontrada", "ifrs-portal-theme-cta" ),
		"no_terms" => __( "Nenhuma categoria", "ifrs-portal-theme-cta" ),
		"items_list" => __( "Lista de Categorias", "ifrs-portal-theme-cta" ),
	);

	$args = array(
		"label" => __( "Categorias de TA", "ifrs-portal-theme-cta" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Categorias de TA",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'categorias-ta', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "categorias-ta",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "categorias-ta", array( "recurso-ta" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes' );



function cptui_register_my_taxes_categorias_ta() {

	/**
	 * Taxonomy: Categorias de TA.
	 */

	$labels = array(
		"name" => __( "Categorias de TA", "ifrs-portal-theme-cta" ),
		"singular_name" => __( "Categoria de TA", "ifrs-portal-theme-cta" ),
		"menu_name" => __( "Categorias de TA", "ifrs-portal-theme-cta" ),
		"all_items" => __( "Todas categorias", "ifrs-portal-theme-cta" ),
		"edit_item" => __( "Editar categoria", "ifrs-portal-theme-cta" ),
		"view_item" => __( "Visualizar categoria", "ifrs-portal-theme-cta" ),
		"update_item" => __( "Modificar nome da Categoria", "ifrs-portal-theme-cta" ),
		"add_new_item" => __( "Adicionar nova Categoria", "ifrs-portal-theme-cta" ),
		"new_item_name" => __( "Novo nome de Categoria", "ifrs-portal-theme-cta" ),
		"parent_item" => __( "Categoria Superior", "ifrs-portal-theme-cta" ),
		"parent_item_colon" => __( "Categoria Superior:", "ifrs-portal-theme-cta" ),
		"search_items" => __( "Pesquisar Categorias", "ifrs-portal-theme-cta" ),
		"popular_items" => __( "Categorias Populares", "ifrs-portal-theme-cta" ),
		"add_or_remove_items" => __( "Adicionar ou remover Categorias", "ifrs-portal-theme-cta" ),
		"not_found" => __( "Nenhuma categoria encontrada", "ifrs-portal-theme-cta" ),
		"no_terms" => __( "Nenhuma categoria", "ifrs-portal-theme-cta" ),
		"items_list" => __( "Lista de Categorias", "ifrs-portal-theme-cta" ),
	);

	$args = array(
		"label" => __( "Categorias de TA", "ifrs-portal-theme-cta" ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Categorias de TA",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'categorias-ta', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "categorias-ta",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "categorias-ta", array( "recurso-ta" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_categorias_ta' );

