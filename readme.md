
## Instrucciones
1.Instalar dependencias via composer(composer install)<br>
2.Configurar archivo .env para la base de datos y establacer las credenciales en las variables P2P<br>
3.Correr migracion (<code>php artisan migrate --seed</code>)<br>
4.El sistema tiene un cron que chequea el estado de todas las transacciones pendientes y los actualiza<br>
    *Agregar la ruta y correr el crontab<br>
5.<code>php artisan serve</code>

