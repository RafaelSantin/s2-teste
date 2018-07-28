# s2-teste
# Project Title

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
