<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function getStatic()
    {
        $homeDesc = System::query()->where('routers', 'home')->first();
        $subDesc = System::query()->where('routers', 'sub')->first();

        return response()->json([
            'data' => [
                'homeDesc' => $homeDesc->desc,
                'subDesc' => $subDesc->desc,
            ]
        ], 200);
    }

    public function saveHome(Request $request)
    {
        System::query()
            ->where('routers', 'home')
            ->updateOrInsert(
                [
                    'routers' => $request->routers,
                    'desc' => $request->desc,
                ]
            );
        return response()->json([
            'message' => 'homeDesc OK',
        ], 200);
    }

    public function saveSub(Request $request)
    {
        System::query()
            ->where('routers', 'sub')
            ->updateOrInsert(
                [
                    'routers' => $request->routers,
                    'desc' => $request->desc,
                ]
            );
        return response()->json([
            'message' => 'subDesc OK',
        ], 200);
    }
}
