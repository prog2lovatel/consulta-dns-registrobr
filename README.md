# Consulta DNS no RegistroBR
Este programa consulta as informações ns de uma lista de dominios em csv passadas pelo usuário.

# Requisitos

- PHP 8.1 instalado na máquina que irá executar este programa;
- VPN;

# Como Funciona

Primeiro você deve clonar este repositório para sua máquina:
```sh
git clone https://github.com/prog2lovatel/consulta-dns-registrobr.git
```
 Entrar na pasta através do comando:
 
 ```sh
cd consulta-dns-registrobr
```

Logo em seguida você deve estabelecer uma conexão VPN, pois assim não corre o risco do RegistroBr bloquear seu acesso por DDOS.

Por fim executar o programa pelo comando:
 ```sh
php index.php
```
Já dentro do programa você deve informar o caminho para seu arquivo .CSV que contém a lista de dns a serem consultados.
Então ele retornará o caminho para lista de resultados também em .CSV. 
