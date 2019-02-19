# IFRS Portal Theme CTA
Tema [Wordpress](https://wordpress.org) para o [Centro Tecnológico de Acessibilidade](https://cta.ifrs.edu.br) do [Instituto Federal do Rio Grande do Sul](https://ifrs.edu.br).

## Dependência

Esse tema depende do tema [IFRS Portal Theme](https://github.com/IFRS/portal-theme), que precisa estar instalado na pasta de temas do Wordpress com o nome:

`ifrs-portal-theme`

### Plugins do Wordpress utilizados pelo Repositório de Tecnologia Assistiva

-	[CMB2](https://github.com/CMB2/CMB2)
-	[CPT UI](https://github.com/WebDevStudios/custom-post-type-ui)


## Desenvolvimento

Para a construção desse projeto são necessárias as seguintes ferramentas:
-   [NodeJs](https://nodejs.org) com [NPM](https://www.npmjs.com)
-   [Gulp CLI](https://gulpjs.com)

Após, é preciso instalar as dependências:

`npm install`

Para compilar/construir o tema no ambiente de desenvolvimento:

`gulp build`

ou, para produção:

`gulp build --production`

Esse projeto possui tarefas separadas para:

- somente compilar os estilos:

`gulp sass`

- compilar e minificar os estilos:

`gulp styles`

- preparar o projeto e copiar os arquivos para distribuição:

`gulp dist`

- limpar o projeto:

`gulp clean`

### Watch

Para observar modificações e rodar um servidor proxy para fazer live reload, execute:

`gulp`

Se o projeto for acessível em outra URL que não "localhost", use o seguinte parâmetro:

`gulp --URL=url_do_projeto`

## Repositório de Tecnologia Assistiva

Para a utilização do repositório de tecnologia assistiva é necessário importar as definições 
de Post Types e Taxonomies com o plugin CPT UI.

### Post Type

```javascript 
    {"recurso-ta":{"name":"recurso-ta","label":"Recursos de TA","singular_label":"Recurso de TA","description":"Reposit\u00f3rio de Tecnologias Assistivas do CTA","public":"true","publicly_queryable":"true","show_ui":"true","show_in_nav_menus":"true","show_in_rest":"false","rest_base":"","has_archive":"true","has_archive_string":"","exclude_from_search":"false","capability_type":"post","hierarchical":"true","rewrite":"true","rewrite_slug":"","rewrite_withfront":"true","query_var":"true","query_var_slug":"","menu_position":"5","show_in_menu":"true","show_in_menu_string":"","menu_icon":"","supports":["title","editor","thumbnail"],"taxonomies":["post_tag","categorias-ta"],"labels":{"menu_name":"Recursos de TA","all_items":"Todos Recursos","add_new":"Cadastrar novo","add_new_item":"Cadastrar novo Recurso","edit_item":"Editar Recurso","new_item":"Novo Recurso","view_item":"Ver Recurso","view_items":"Ver Recursos","search_items":"Buscar Recursos","not_found":"Nenhum Recurso encontrado","not_found_in_trash":"Nenhum Recurso encontrado na lixeira","parent":"Recurso Pai:","featured_image":"Imagem de destaque","set_featured_image":"Adicionar imagem de destaque","remove_featured_image":"Remover imagem de destaque","use_featured_image":"Utilizar como imagem de destaque","archives":"Reposit\u00f3rio de TAs","insert_into_item":"Inserir no Recurso","uploaded_to_this_item":"Carregar neste Recurso","filter_items_list":"Filtrar lista de Recursos","items_list_navigation":"Navega\u00e7\u00e3o da lista de Recursos","items_list":"Lista de Recursos","attributes":"Atributos do Recurso","parent_item_colon":"Recurso Pai:"},"custom_supports":""}}
```

### Taxonomy

```javascript
    {"categorias-ta":{"name":"categorias-ta","label":"Categorias de TA","singular_label":"Categoria de TA","description":"Divis\u00e3o das Categorias de Recursos de Tecnologia Assistiva.","public":"true","hierarchical":"true","show_ui":"true","show_in_menu":"true","show_in_nav_menus":"true","query_var":"true","query_var_slug":"","rewrite":"true","rewrite_slug":"","rewrite_withfront":"1","rewrite_hierarchical":"0","show_admin_column":"false","show_in_rest":"false","show_in_quick_edit":"","rest_base":"","labels":{"menu_name":"Categorias de TA","all_items":"Todas categorias","edit_item":"Editar categoria","view_item":"Visualizar categoria","update_item":"Modificar nome da Categoria","add_new_item":"Adicionar nova Categoria","new_item_name":"Novo nome de Categoria","parent_item":"Categoria Superior","parent_item_colon":"Categoria Superior:","search_items":"Pesquisar Categorias","popular_items":"Categorias Populares","add_or_remove_items":"Adicionar ou remover Categorias","not_found":"Nenhuma categoria encontrada","no_terms":"Nenhuma categoria","items_list":"Lista de Categorias","separate_items_with_commas":"","choose_from_most_used":"","items_list_navigation":""},"object_types":["recurso-ta"]}}
```

## Licença

Esse código é distribuído sob a licença [GNU GPL 3.0](https://www.gnu.org/licenses/gpl-3.0.txt).

A documentação, as imagens e demais mídias são distribuídas sob a licença [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International](https://creativecommons.org/licenses/by-nc-sa/4.0)
