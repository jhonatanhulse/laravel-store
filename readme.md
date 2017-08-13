## Setting up

After clonning the repository run `php composer.phar install`, this command will install dependencies and generate the `.env` file.

Configure the database connection in `.env` file like:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel-store
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

For simplicity the mail service is expecting to be Gmail SMTP Server. Its configuration can be made by allowing less secure apps in your Gmail Account Settings (https://myaccount.google.com/security#connectedapps) and edit `.env` file like following:

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
```

Execute migrations running `php artisan migrate`.

Configure `crontab` to execute scheduled tasks using the command `crontab -e` and adding the following line in the file:
`* * * * * php /path_to_your_project/artisan schedule:run >> /dev/null 2>&1`

## Running

To run the application you can just execute the command `php artisan serve` and it will be accessible through the address `localhost:8000`.

## Considerations

Because of lack of time to spend in the development of this Laravel Framework example I focused in the simplest solution which may not be the best approach for the same problem in production environments.

### TDD

Tests were not implemented because of lack of time and if I would implement I would use the Test Last approach.

### I18n

Strings were statically fixed in the source code which make difficult implementation of i18n. Ideally it should be made using Laravel I18n.

### Request validation

The validation is being performed directly in the controller methods. Ideally it should be done using Laravel Form Request Validation (https://laravel.com/docs/5.4/validation#form-request-validation)

### Database access

The database access is being performed directly through Eloquent models which make difficult to implement some features (e.g. cache strategy) and DRY principle. Ideally it could be done using Repository Pattern with Laravel Contracts and Dependency Injection.

### Product importation

The product importation is expecting that the CSV file has the header in the first line with the exact column names and files with size lower than 5MB as the following example:

```
name,price,category,description
p01,101.01,c01,description01
p02,102.02,c01,description02
p03,103.03,c02,description03
p04,104.04,c02,description04
p05,105.05,c03,description05
p06,106.06,c03,description06
p07,107.07,c04,description07
p08,108.08,c04,description08
p09,109.09,c05,description09
p10,110.10,c05,description10
p11,111.11,c06,description11
p12,112.12,c06,description12
p13,113.13,c07,description13
p14,114.14,c07,description14
p15,115.15,c08,description15
p16,116.16,c08,description16
p17,117.17,c09,description17
p18,118.18,c09,description18
p19,119.19,c10,description19
p20,120.20,c10,description20
```

The product validation is not being performed so any invalid value will cause the importation to fail. Moreover this feature is not dealing with files with large ammount of rows or large volume of imporations submitted. Ideally it should proccess valid rows in CSV file and return the rows which were not proccessed with its errors. To deal with larger files it could be done by limiting numbers of rows read like Laravel Excel supports (http://www.maatwebsite.nl/laravel-excel/docs/import). Analogously table pagination could be done to deal with with larger volume of imports.
