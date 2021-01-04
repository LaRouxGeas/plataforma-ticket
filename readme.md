## Instalar o Projeto

Para executar o projeto precisa-se de um ambiente linux com os seguintes pacotes instalados:
- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Composer [página de instruções para download]<https://getcomposer.org/download/>

## Fazer o clone do projeto

Após a instalação desses pacotes em um ambiente, preferencialmente em linux/mac, faça o clone desse repositório:
>git clone https://github.com/LaRouxGeas/plataforma-ticket

Depois, entre no diretório do projeto e utiliza-se o comando do composer, onde ele baixara as outras bibliotecas:
>composer install

## Executar o projeto

Antes de rodar o aplicativo o Laraver precisa do arquivo .env que contem as configurações da aplicação
Para gerar um .env podera executar o seguinte comandos:
>cp .env.example .env

e depois
>php artisan key:generate


Para começar a rodar a aplicação só precisa executar o comando artisan:
>sudo php artisan serve --host 0.0.0.0 --port 8000

Também é possível ajustar as variáveis acima para que fique como localhost:
>sudo php artisan serve --host 127.0.0.1 --port 8000
