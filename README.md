````
var jsonData = JSON.parse(responseBody);
if (jsonData.data.access_token){
    tests["body has access_token"] = true;
    postman.setEnvironmentVariable("access_token",jsonData.data.access_token);
}
else {
    tests["body has access_token"] = false;
}
````
````
php artisan ide-helper:generate
php artisan ide-helper:models
php artisan ide-helper:meta

`````
````
{{Route::current()}}
{{Route::currentRouteName()}}
{{Route::currentRouteAction()}}
{{Request::path()}}
````

php artisan passport:install

php artisan make:migration create_add_users_isfoot_table

php artisan db:seed --class=AdminSeeder

php artisan storage:link

来执行未执行过的迁移
php artisan migrate

php 配置 exec