# s2-teste

Teste para empresa, recebe um xml processa e adiciona no banco, criado metodo get para recuperação de dados. 


### Prerequisites

Docker instalado

### Installing

fazer download do repositorio em uma maquina com docker instalado

Acessar pasta onde foi clonado o sistema e executar o comando:

```
docker-compose up
```

(aguardar pois o build demorará um tempo), não foi criada uma imagem pois para deixar sistema com 
menos passos para instalação acabei deixando buildando direto

acessar pasta onde foi clonado o sistema e executar o comando:

```
docker-compose exec laravel php artisan migrate --force
```

### Acessando a aplicação

A porta liberada no docker é a 82, para acessar a aplicação fazer como no exemplo abaixo:

```
localhost:82
```

### get API

Junto com o sistema foram feitas dois retornos para obtenção de dados, uma para pessoas e outro para pedidos:

```
localhost:82/api/get-person
```

```
localhost:82/api/get-orders
```
