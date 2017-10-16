
# Elaborador de plano de classificação de documentos


Este software é construído inteiramente em PHP e MySQL utilizando o framework web-PHP Codeigniter, em sua versão 3.
E seu objetivo é permitir ao usuário inserir metadados de classes, subclasses, grupos e subgrupos
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

Para a próxima versão, serão adicionados os metadados de temporalidade do e-ARQ Brasil. Além de haver a possibilidade de exportar e importar os planos de classificação em outros formatos de arquivo, como JSON ou CSV.

*******************
# Requisitos

É necessário no mínimo a versão 5.6 do PHP e MySQL 5.6.
O servidor web Apache também é necessário, visto o ambiente de execução do software.

************
# Instalação e utilização

Neste [link](https://goo.gl/E1wkvM) vocês pode baixar uma versão remasterizada do sistema operacional Ubuntu 17.04 com o elaborador de plano de classificação e o banco de dados já instalados. 

Para utilizar esta versão remasterizada, faça o download do arquivo .iso disponível no link acima e inicialize ou instale sistema em seu computador ou máquina virtual.

Usuário do SO: ubuntu
Senha: ubuntu

Usuário MySQL do banco de dados: root
Senha MySQL: 12345

************

É possível baixar o código fonte e o modelo entidade-relacionamento do banco de dados, e executar de forma nativa, baixando e instalando o [XAMPP](https://www.apachefriends.org/pt_br/index.html),
que contém o PHP, MySQL e o servidor de páginas web Apache.

Após, importar o arquivo contido neste repositório, [pcd.sql](https://github.com/ronaisavegnago/pcd/blob/master/pcd.sql), para seu banco de dados.

E por fim, acesse o seguinte endereço em seu navegador: http://localhost/pcd

*********
# Recursos

- Criar, editar, desativar, reativar e extinguir classes, subclasses, grupos e subgrupos do plano de classificação.
- Exportar todos os dados para o formato XML.
- Importar dados a partir de um plano de classificação em formato XML, armazenando-o no banco de dados local.

# Regras para importar Plano de Classificação

Para importar um plano de classificação é necessário seguir a **ordem e nomeclatura** dos elementos disponveis no arquivo [pcd.xml](https://github.com/ronaisavegnago/pcd/blob/master/pcd.xml), presente neste repositório e definidos a seguir: 

*elementos obrigatórios

	classes*
		classe*
			classe_codigo*
			classe_nome*

			registro_abertura*
				data*
				hora*
				responsavel*

			registro_desativacao
				data*
				hora*
				responsavel*

			registro_reativacao
				data*
				hora*
				responsavel*

			registro_extincao
				data*
				hora*
				responsavel*

			registro_mudanca_nome
				data*
				hora*
				responsavel*

			registro_deslocamento
				data*
				hora*
				responsavel*

		subclasse
			subclasse_codigo*
			subclasse_nome*
			subclasse_subordinacao*

			registro_abertura*
				data*
				hora*
				responsavel*

			registro_desativacao
				data*
				hora*
				responsavel*

			registro_reativacao
				data*
				hora*
				responsavel*

			registro_extincao
				data*
				hora*
				responsavel*

			registro_mudanca_nome
				data*
				hora*
				responsavel*

			registro_deslocamento
				data*
				hora*
				responsavel*

		grupo
			subclasse_codigo*
			subclasse_nome*
			subclasse_subordinacao*

			registro_abertura*
				data*
				hora*
				responsavel*

			registro_desativacao
				data*
				hora*
				responsavel*

			registro_reativacao
				data*
				hora*
				responsavel*

			registro_extincao
				data*
				hora*
				responsavel*

			registro_mudanca_nome
				data*
				hora*
				responsavel*

			registro_deslocamento
				data*
				hora*
				responsavel*

		subgrupo
			subclasse_codigo*
			subclasse_nome*
			subclasse_subordinacao*

			registro_abertura*
				data*
				hora*
				responsavel*

			registro_desativacao
				data*
				hora*
				responsavel*

			registro_reativacao
				data*
				hora*
				responsavel*

			registro_extincao
				data*
				hora*
				responsavel*

			registro_mudanca_nome
				data*
				hora*
				responsavel*

			registro_deslocamento
				data*
				hora*
				responsavel*

