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

php artisan db:seed --class=AdminSeeder

