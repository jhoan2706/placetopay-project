
## Instrucciones
1.Instalar dependencias via composer(composer install)<br>
2.Dar permisos al proyecto y correr <code>php artisan key:generate</code><br>
3.Configurar archivo .env para la base de datos y establacer las credenciales en las constantes P2P<br>
4.Correr migracion (<code>php artisan migrate --seed</code>)<br>
5.El sistema tiene un cron que chequea el estado de todas las transacciones pendientes y los actualiza<br>
    *Agregar la ruta y correr el crontab<br>
6.<code>php artisan serve</code>

