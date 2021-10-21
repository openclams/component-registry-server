# Setup

## Downloading the project and server docker

Create a folder, e.g. code, and `cd code`.
In this folder install laradock, a set of dockercompose files to install all necessary applications to run this Laravel application.

git clone https://github.com/Laradock/laradock.git

Once you are finished, you can clone this repo.

git clone https://github.com/openclams/component-registry-server.git

NOw, you should have directory two new folders in your `code`.
```
├── Code
│   ├── component-registry-server
│   └── laradock
```

## Setting up the application and Laradock 

First we apply the default configuration of the Laraval application.

```
cd component-registry-server
```
Open the `.env` file, and change the `DB_*` variables.
If you use the standard configuration, then you need to change at least `DB_DATABASE` to `default`,

Next we change to the laradock folder to install and setup the server.

```
cd ../laradock
cp .env-example .env
```

Open the `.env` file, and change the `APP_CODE_PATH_HOST` variable to the application's path.

APP_CODE_PATH_HOST=../component-registry-server/

You can start the docker web server and database as follows.

```
docker-compose up -d nginx mysql phpmyadmin workspace 
```

After docker has booted up all container images, we can start with the actual setup.

## Setting up the Application

Enter the bash of the container with:

```
docker-compose exec  workspace bash
```

or if it does not work use:

```
docker exec -it laradock_workspace_1  /bin/bash
```

You should be  connected to the bash of the docker container now. 
Next call the following commands.

```
/var/www# composer install
/var/www# php artisan key:generate
/var/www# php artisan voyager:install
/var/www# php artisan route:clear
/var/www# php artisan cache:clear
```

Then create an admin user as follows:

```
php artisan voyager:admin your@email.com --create
```

And finally, call:
```
php artisan db:seed --class=UISeeder
```
to install missing UI elements.

Now you can access the admin panel via `http://localhost/admin`

## Making the sever externally available

If the web-app is outside of the local machine, you need to change 
the `APP_URL` variable of the application with the public IP. 

For example:

```
cd component-registry-server
vim .env
```

Now, change the `APP_URL` variable of the application with the public IP or 
domain name of the host.

Next, you need to tell the web-app where the server is.
Unfortuanly, you need to recompile the web-app to make changes take effect.

Change to the source folder of the web-app and open the `environments/environments.ts` file, and change
the `serviceServer` to the host's address accordingly.

## Connect to phpMyAdmin

If you wish to access phpMyAdmin, you need to call the following
link in your browser: `http://localhost:8081`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
