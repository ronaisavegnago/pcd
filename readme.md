
# Elaborador de plano de classificação de documentos


Este software é construído inteiramente em PHP e MySQL, e seu objetivo
é permitir ao usuário inserir metadados de classes, subclasses, grupos e subgrupos
para visualizar o plano de classificação e ter a possibilidade de exportá-lo em no formato XML.

Software produzido por Ronai Savegnago Ribeiro e Marcelo Brondani, ambos mestrandos no Programa 
de Pós-Graduação em Patrimônio Cultural da Universidade Federal de Santa Maria e integrantes do
grupo de pesquisa Ged/A, sob orientação do Prof. Dr. Daniel Flores.

*******************
# Informação de versão

Esta é a primeira versão do software, logo podem ocorrer algumas falhas ou bugs, que poderão ser reportadas
na seção de Issues.

**************************
# Changelog e novas funcionalidades

Para a próxima versão, denominada Release Candidate, será implementado a funcionalidade de importar o plano de classificação
no formato XML e manipulá-lo no próprio software.

*******************
# Requisitos

É necessário no mínimo a versão 5.6 do PHP e MySQL 5.6.
O servidor web Apache também é necessário, visto o ambiente de execução do software.

************
# Instalação

De forma mais simplificada é possível baixar e instalar o `XAMPP <https://www.apachefriends.org/pt_br/index.html>`,
que contém o PHP, MySQL e o servidor de páginas web Apache.

Após, importar o arquivo contido neste repositório, 'pcd.sql', para seu banco de dados.

E por fim, acesse o seguinte endereço em seu navegador: http://localhost/pcd

*********
# Recursos

- Criar, editar, desativar, reativar e extinguir classes, subclasses, grupos e subgrupos do plano de classificação.
- Exportar todos os dados para o formato XML.

