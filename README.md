# IFRS Extra Site Theme
Tema do [Wordpress](https://wordpress.org/) para os Sites Institucionais extras do [Instituto Federal do Rio Grande do Sul](https://ifrs.edu.br/).

## Dependência

Esse tema depende do tema [IFRS Portal Theme](https://github.com/IFRS/portal-theme), que precisa estar instalado na pasta de temas do Wordpress com o nome:

`ifrs-portal-theme`

## Uso

Para a construção desse projeto são necessárias as seguintes ferramentas:
-   [NodeJs](https://nodejs.org/) com [NPM](https://www.npmjs.com/)
-   [Gulp CLI](https://gulpjs.com/)

Após, é preciso instalar as dependências:

`npm install`

Para compilar/construir o tema no ambiente de desenvolvimento:

`gulp build`

ou, para produção:

`gulp build --production`

Esse projeto possui tarefas separadas para...

somente compilar os estilos:

`gulp sass`

compilar e minificar os estilos:

`gulp css`

preparar o projeto e copiar os arquivos para distribuição:

`gulp dist`

limpar o projeto:

`gulp clean`

## Licença

Esse código é distribuído sob a licença [GNU GPL 3.0](https://www.gnu.org/licenses/gpl-3.0.txt).

A documentação, as imagens e demais mídias são distribuídas sob a licença [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International](https://creativecommons.org/licenses/by-nc-sa/4.0/)
