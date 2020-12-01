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
php artisan make:migration create_add_users_isfoot_table

php artisan storage:link

php artisan db:seed --class=AdminSeeder
php artisan passport:install
php artisan passport:install --force
php artisan passport:client --password --provider
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


{
  "name": "echo",
  "script": "laravel-echo-server",
  "args": "start"
}

pm2 start echo.json
pm2 restart echo

沉浸式命盘展示 <br />
实时排盘，实时显示确认 <br>
精确到日、时，考试、婚嫁、择日等体验完美 <br>
数据存储，查询修改随心所欲<br>
邮箱注册，不用手机号<br>
绿色网络服务器，确保隐私和数据安全<br>


<p style="text-align: justify;">
本站为个人独立运营维护，可免费使用。But，站点的运营维护需要花费大量的精力与费用，如果觉得本站对您有所帮助，还请您订阅一下，感谢支持！
</p>

<div class="row">

<div class="col col-6">
<p>普通用户</p>
<p class="subtitle-2">只能保存一条数据</p>
<p class="subtitle-2">无权修改顶部标题</p>
<p class="subtitle-2">无权隐藏底部版权</p>
<p class="subtitle-2">无权设置头像</p>
</div>

<div class="col col-6">
<p style="color: orangered;">订阅用户</p>
<p class="subtitle-2">保存数据没有限制</p>
<p class="subtitle-2">顶部标题可自定义</p>
<p class="subtitle-2">底部版权可隐藏</p>
<p class="subtitle-2">自定义头像</p>
</div>

</div>

既然不想保留本地的修改，那好办。直接将本地的状态恢复到上一个commit id 。然后用远程的代码直接覆盖本地就好了。

git reset --hard 
git pull origin master