<?php

namespace Database\Seeders;

use App\Models\CommonlistModel;
use Illuminate\Database\Seeder;

class CommonlistSeeder extends Seeder
{
    public $lists = [
        ['type' => 'payDesc', 'icon' => 'mdi-star', 'title' => '',
            'content' => '支付备注信息请填写正确的账号名称。支付出现问题可发送Email或站内留言联系管理员。',
        ],
        ['type' => 'payDesc', 'icon' => 'mdi-star', 'title' => '',
            'content' => '年付订阅 ￥：30元 （$：4.5）',
        ],
        ['type' => 'payDesc', 'icon' => 'mdi-star', 'title' => '',
            'content' => '永久订阅 ￥：99元 （$：15）',
        ],
        ['type' => 'payDesc', 'icon' => 'mdi-star', 'title' => '',
            'content' => '付款后，管理员后台人工开通，可能会存在一定的时效，还请见谅。（干净绿色网络无法对接墙内支付接口）',
        ],
//===============================================================================================
        ['type' => 'other', 'icon' => 'mdi-star', 'title' => '',
            'content' => '批命',
        ],
        ['type' => 'other', 'icon' => 'mdi-star', 'title' => '',
            'content' => '易经占卦、解卦',
        ],
        ['type' => 'other', 'icon' => 'mdi-star', 'title' => '',
            'content' => '五行八字理论',
        ],
        ['type' => 'other', 'icon' => 'mdi-star', 'title' => '',
            'content' => '出售站点源码',
        ],
    ];

    public function run()
    {
        foreach ($this->lists as $list) {
            CommonlistModel::query()->create($list);
        }
    }
}
