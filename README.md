# CBA-Run

## Descrição do Projeto

O **CBA-Run** é uma aplicação desenvolvida para gerenciar eventos de corrida internos, com foco em inscrições, registro de atividades e rankings baseados em desempenho. A aplicação opera sob o conceito de uma única corrida vigente, permitindo que administradores e colaboradores gerenciem e acompanhem seus dados de forma eficiente.

---

## Requisitos do Sistema

### Para rodar a aplicação, é necessário:
1. Servidor PHP:
   - PHP 8.1 ou superior.

2. Extensões PHP:
   - BCMath
   - Ctype
   - Fileinfo
   - JSON
   - Mbstring
   - OpenSSL
   - PDO
   - Tokenizer
   - XML

3. Banco de Dados:
   - MySQL 8.0+ (recomendado).

4. Dependências:
   - Composer 2.x
   - Node.js (versão 16 ou superior) para gerenciar assets front-end (Vite).

5. Permissões:
   - Os diretórios `storage` e `bootstrap/cache` devem ser graváveis pelo servidor.

PARA EXECUTAR

1. Clone o repositório:
   git clone https://github.com/helvislima/cba-run.git
   cd cba-run

2. Instale as dependências:
   composer install
   npm install

3. Configure o arquivo `.env` com suas credenciais do MySQL:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nome_do_banco
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha

4. Execute as migrations:
   php artisan migrate

5. Inicie o servidor local:
   php artisan serve
   npm run dev


## Funcionalidades da aplicação

1. Inscrições:
   - Colaboradores se inscrevem em unidades, limitadas pela quantidade de vagas disponíveis.

2. Gestão de Atividades:
   - Colaboradores registram o tempo percorrido e fazem upload de uma imagem para comprovação.

3. Ranking:
   - O sistema organiza os colaboradores em um ranking com base nos tempos registrados.

4. Administração:
   - O administrador faz login pela URL `/login`.
   - Ele não cria novas corridas; o sistema opera com uma única corrida vigente.
   - É possível exportar os rankings finais em formato CSV/Excel.

5. Identificação Automática:
   - Colaboradores não precisam de cadastro.
   - Eles inserem sua matrícula, e o sistema identifica automaticamente seus dados (nome, sobrenome e unidade).

## Modelos

1. User:
   - Representa os colaboradores.
   - Identificação automática pelo campo `registration_number` (matrícula).

2. Unit:
   - Define as unidades com vagas limitadas.
   - Campos:
     - `name`: Nome da unidade.
     - `total_slots`: Total de vagas disponíveis.
     - `occupied_slots`: Número de vagas já preenchidas.

3. Run:
   - Representa a corrida vigente.
   - Campos principais:
     - `name`: Nome da corrida.
     - `date`: Data do evento.

4. Enrollment:
   - Inscrição de colaboradores.
   - Relaciona usuários às unidades e corridas.

5. Ranking:
   - Organiza o desempenho dos colaboradores.
   - Campos principais:
     - `user_id`: Colaborador.
     - `run_id`: Corrida vigente.
     - `time`: Tempo registrado.
     - `evidence`: Caminho da imagem usada como comprovação.


## Controllers

1. DashboardController:
   - Exibe a página inicial com:
     - Quantidade de vagas disponíveis nas unidades.
     - Listagem das unidades com inscrições realizadas.
     - Opção de exportação de ranking para CSV/Excel.

2. RegisterController:
   - Gerencia a lógica de identificação do colaborador:
     - O usuário insere sua matrícula.
     - O sistema verifica o banco de dados, identifica o colaborador e informa sua unidade.
    
## Rotas

1. Inscrições:
   - POST /enroll: Realiza a inscrição do colaborador em uma unidade.

2. Registro de Atividades:
   - POST /activity: Registra o tempo e o upload de imagem para comprovação de quilometragem.

3. Ranking:
   - GET /ranking: Exibe o ranking atual da corrida vigente.

4. Página Inicial:
   - GET /: Página inicial com as opções de inscrição e listagem de vagas.


## Migrations (database)

1. users:
   - Representa os colaboradores.
   - Campos:
     - id: Identificador único do usuário.
     - name: Nome completo do colaborador.
     - email: Endereço de e-mail.
     - password: Senha criptografada.
     - registration_number: Matrícula do colaborador.
     - unit_id: Relaciona o colaborador a uma unidade.

2. units:
   - Define as unidades com vagas disponíveis.
   - Campos:
     - id: Identificador único.
     - name: Nome da unidade.
     - total_slots: Total de vagas disponíveis.
     - occupied_slots: Quantidade de vagas ocupadas.

3. runs:
   - Representa a corrida vigente.
   - Campos:
     - id: Identificador único.
     - name: Nome da corrida.
     - date: Data do evento.

4. enrollments:
   - Registra as inscrições dos colaboradores.
   - Campos:
     - id: Identificador único.
     - user_id: Relaciona a inscrição a um colaborador.
     - unit_id: Relaciona a inscrição a uma unidade.
     - run_id: Relaciona a inscrição à corrida vigente.

5. rankings:
   - Define o ranking baseado nos tempos registrados.
   - Campos:
     - id: Identificador único.
     - user_id: Relaciona o ranking a um colaborador.
     - run_id: Relaciona o ranking à corrida vigente.
     - time: Tempo registrado pelo colaborador.
     - evidence: Caminho do arquivo de imagem usado como comprovação.
