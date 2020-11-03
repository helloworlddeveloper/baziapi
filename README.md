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

git config --global http.proxy "127.0.0.1:12000"


/www/server/panel/vhost/cert/data.water555.xyz/fullchain.pem

/www/server/panel/vhost/cert/data.water555.xyz/privkey.pem


````
{
	"authHost": "https://data.water555.xyz",
	"authEndpoint": "/broadcasting/auth",
	"clients": [],
	"database": "redis",
	"databaseConfig": {
		"redis": {},
		"sqlite": {
			"databasePath": "/database/laravel-echo-server.sqlite"
		}
	},
	"devMode": true,
	"host": null,
	"port": "2053",
	"protocol": "https",
	"socketio": {},
	"secureOptions": 67108864,
	"sslCertPath": "/www/server/panel/vhost/cert/data.water555.xyz/fullchain.pem",
	"sslKeyPath": "/www/server/panel/vhost/cert/data.water555.xyz/privkey.pem",
	"sslCertChainPath": "",
	"sslPassphrase": "",
	"subscribers": {
		"http": true,
		"redis": true
	},
	"apiOriginAllow": {
		"allowCors": true,
		"allowOrigin": "https://bazi.water555.xyz",
		"allowMethods": "GET,POST",
		"allowHeaders": "Origin, Content-Type, X-Auth-Token, X-Requested-With, Accept, Authorization, X-CSRF-TOKEN, X-Socket-Id"
	}
}
````

````
    這個不需要，cloudflare有允许https通过的端口2053
    
    location /ws/{
        proxy_pass http://127.0.0.1:6001/;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header X-Forwarded-For $remote_addr;
    }   
````