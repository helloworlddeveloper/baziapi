<?php
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
