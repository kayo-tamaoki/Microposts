<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts 
            
        ]);
    } 

    /**
     * ユーザのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
 
    public function favorites($id)  //修正前コメント..ルーティングのパラメーターはidなので、$idであるべき Route::group(['prefix' => 'users/{id}'], function ()
    {
        // idの値でユーザを検索して取得  修正前コメント..引数を直せば、この記述は正しいが、代入する変数名は、$user_idではなく、$userが適切
        $user = User::findOrFail($id);
    
        // 関係するモデルの件数をロード  修正前コメント..こちらも$user_idから$userへ。
        $user->loadRelationshipCounts();
    
        //お気に入りの投稿一覧を作成日時の降順で取得  修正前コメント..$userは上記コードにどこにもない。上記を$user_idから$userに変更すれば正しい記述。
        $favorites = $user->favorites()->paginate(10);
    
        // お気に入りの詳細ビューでそれらを表示  修正前コメント..$favoritesにはUser or Micropostインスタンスどちらのコレクションが代入されているか？ビューに渡す変数名はusersでいいのか？
        return view('users.favorites', [
            'user' => $user,
            'microposts' => $favorites,
        ]);
    }
}
