<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    public $sub = <<<EOT
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
EOT;

    public function run()
    {
        \DB::table('systems')->insert([
            'routers' => 'home',
            'desc' => "
沉浸式命盘展示 <br />
实时排盘，实时显示确认 <br>
精确到日、时，考试、婚嫁、择日等体验完美 <br>
数据存储，查询修改随心所欲<br>
邮箱注册，不用手机号<br>
绿色网络服务器，确保隐私和数据安全<br>
            "
        ]);

        \DB::table('systems')->insert([
            'routers' => 'sub',
            'desc' => $this->sub,
        ]);
    }
}
