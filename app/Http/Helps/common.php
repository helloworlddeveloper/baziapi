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
