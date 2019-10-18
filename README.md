## Installation

- clone project
- `composer install`

## Config
- set mongo db credentails in `\common\config\main-local.php` file. Set db name and credentials in `dsn`.
````
    'mongodb' => [
        'class' => '\yii\mongodb\Connection',
        'dsn' => 'mongodb://localhost:27017/yii',
    ],
````

## Api

- Api's are created as a separate module in `\api` folder.
- For the api versioning, module according to version number is created in `\api\modules`
