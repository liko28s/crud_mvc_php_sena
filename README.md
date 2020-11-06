Cluster PHP - IBM DB2 - Balanceo de Carga
==================================

# Instalación #

Simplemente clone este repositorio y publique la carpeta application en su servidor web, posteriormente instale las dependencias con composer

# Requisitos #
 * Composer
 * Php 7
 * Mysql
 
# Despliegue Y Desarrollo#

  * instale [docker desktop](https://www.docker.com/products/docker-desktop)
  * Cuando esté listo solo ejecute `docker-compose up -d --build`. 
  * Importe la Base de datos con el siguiente comando (reemplaze los valores por los nombres correctos)
  
  ```docker exec -i nombre_contenedor_db_1 mysql -uusuario -pclave db < base_datos.sql```
  * Si no utiliza docker importe las tablas a la base de datos usando su herramienta preferida (phpMyAdmin, adminer, MysqlWorkbench)
  
  * Si no utiliza docker o publica en XAMP, Apache o algo similar, solo publique la carpeta application
  * Una vez se encuentre publicado instale las dependencias con composer
  
  Si usa  Docker
  
  ```docker run --rm --interactive --tty --volume $PWD:/app composer install```
  
  Si usa Xamp o apache utilice el instalador de composer que tenga instalado. 