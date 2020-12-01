<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonlistModel;
use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function getAll()
    {
        $all = System::query()
            ->select('id', 'routers', 'title', 'desc')
            ->get();
        return response()->json([
            'data' => $all
        ], 200);
    }

    public function saveStatic(Request $request)
    {
        System::query()
            ->where('id', $request->id)
            ->update(['desc' => $request->desc,]);
    }

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

    public function getPayDesc()
    {
        $all = CommonlistModel::query()
            ->select('id', 'type', 'icon', 'content')
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('type');

        return response()->json([
            'data' => $all->all()
        ], 200);
    }

    public function savePayDesc(Request $request)
    {
        CommonlistModel::query()
            ->updateOrCreate(['id' => $request->id],
                [
                    'icon' => $request->icon,
                    'type' => $request->type,
                    'content' => $request->input('content'),
                ]);
        return response()->json([
            'message' => '操作成功'
        ], 200);
    }

    public function delPayDesc(Request $request)
    {
        $del = CommonlistModel::destroy($request->id);
        if (!$del) {
            return response()->json([
                'message' => '删除失败'
            ], 403);
        }
        return response()->json([
            'message' => '已删除'
        ], 200);
    }
}
