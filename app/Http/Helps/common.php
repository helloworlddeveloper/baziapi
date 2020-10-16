<?php
/**
 * User: 白小飞
 * DateTime: 2020-09-15-0015 9:09
 * 删除令牌
 */
function revoked()
{
    $tokenModel = \Auth::user()->token();
    $tokenModel->update([
        'revoked' => 1,
    ]);
    \DB::table('oauth_refresh_tokens')
        ->where(['access_token_id' => $tokenModel->id])->update([
            'revoked' => 1,
        ]);
}

// sql助手函数打印
function getSql()
{
    app('db')->listen(function ($sql) {
        $singleSql = $sql->sql;
        if ($sql->bindings) {
            foreach ($sql->bindings as $replace) {
                $value = is_numeric($replace) ? $replace : "'" . $replace . "'";
                $singleSql = preg_replace('/\?/', $value, $singleSql, 1);
            }
        }
        //dump($singleSql);//print_r($singleSql);
        $GLOBALS['sql'] = $singleSql;
    });
}
