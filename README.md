# Projeto Centro de Apoio
(Web App) - Sistema de Ticketing / Centro de Apoio


Aplicação web com frontend e back-office para submissão e gestão de pedidos de apoio incorporando uma dashboard de cliente, agente e administrador.

# TODO

Data de apresentação - 31 de Janeiro 2023 / 
Prazo de conclusão de desenvolvimento - 28 de Janeiro 2023

### Critério de avaliação PWEB

- [X] POO
	- [x] class DB (db.php) - prepara ligação a base de dados
- [x] PHP Mailer
	- [x] pagina contacto.php - sistema incorporado de mail com recaptcha
	- [x] teste requer hospedagem online
- [x] CRUD
- [x] BD
- [x] Internacionalização (landing page apenas)
	- [x] paginas de langs criadas (PT-PT, EN-US, FR-FR, ES-SP)
	- [x] finalizar traduções
- [x] Validação de formulários com JS ou JQuery
	- [x] aplicado em criar-conta.php
- [x] Bootstrap
- [x] Hospedagem online

### Critério de avaliação GPSI / INT

- [x] Relatório de Gestão de Projeto
- [x] Integração de sistema login
- [x] Integração de knownledge base na fase de criação de ticket


## DEV
### Landing Page

- [x] Verificar e corrigir responsividade para modo Tablet/Telefone
- [x] Fazer textos de páginas em falta
	- [x] Politica de Privacidade
	- [x] Termos
- [x] Melhorar a página de contacto
	- [x] Incorporar o PHP Mailer
	- [x] Incorporar Google Maps iFrame com localização
	- [x] Incorporar Recaptcha para submissão de formulário
- [x] Adicionar anchor to the top
- [x] Adicionar seletor de lingua (PT ou EN) em dropdown
- [x] Melhorar o alinhamento do footer-bottom
- [x] Adicionar páginas de Politica de Privacidade e Termos de Utilização
- [ ] Melhorar página de Criar Conta
	- [ ] (OPCIONAL) Incorporar Recaptcha para submissão de formulário
	- [x] Aplicar validação de campos (password e re-password) com JS / JQuery
- [x] (OPCIONAL) Adicionar "loader animation" ao arrancar qualquer página

### Backoffice (paineis - global)

- [x] Melhorar design de topnav
- [x] Melhorar design de sidebar
- [x] Adicionar footer
	- [x] Incorporar copyright, titulo e termos de utilização
- [ ] Limpar codigo e aplicar comentários para
- [ ] Knowledge Base o scrollspy não funciona corretamente
- [ ] Adicionar Page Preloader ao conteudo dos paineis
- [x] Adicionar pagina 404 por defeito
- [x] Adicionar botão scroll-to-top

### Painel Cliente

- [x] Criar paginas listar tickets por tipos de estado e prioridades
- [x] Melhorar design de página Ticket
- [ ] Incorporar anexos em criar ticket
- [ ] Adicionar texto de como usar na metade em branco do card de criação de ticket

### Painel Agente

- [x] Incorporar gráficos e estatisticas no Painel de Agente
- [x] Adicionar ao sidebar links para Tickets Em Espera (com counter) e Tickets Novos (com counter)

### Painel Administrador

- [ ] Criar opções para a página de Definições no Painel de Administrador
- [ ] Adicionar links dropdown para sidebar para Gerir Clientes, Gerir Agentes e Gerir KB
- [x] Paginas Registar Cliente e Registar Agente precisam ter validação de confirma password

### Bugs

- [x] Anchor redirect de items da nav da KB está a falhar
- [x] Em qualquer pagina de detalhes de Ticket se clicar no logotipo vai para pagina 404
- [x] Corrigir valores na página Criar Conta na parte do Departamento