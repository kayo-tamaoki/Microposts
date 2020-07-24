<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostFavoriteController extends Controller
{
    /**
     * 投稿をお気に入りするアクション。
     *
     * @param  $id  相手投稿のid
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿をお気に入りする
        \Auth::user()->favorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * 投稿をお気に入りから外すアクション。
     *
     * @param  $id  相手投稿のid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿をお気に入りから外す
        \Auth::user()->unfavorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}
