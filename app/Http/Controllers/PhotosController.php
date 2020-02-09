<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Photo;
use App\Comment;
use Log;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('photos.index', ['photos'=> $photos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $this->validate($request, Photo::$rules);

        // post値を変数に格納
        $title = $request->title;
        $uploadImg = $request->file('photo');

        // モデル作成
        $photo = new Photo;

        // 画像がアップロードできているか確認し、ファイル名をPhotoインスタンスのプロパティにセット
        if($uploadImg->isValid()){
            $filePath = $uploadImg->store('public');
            // str_replace関数で$filePathからファイル名を取り出し、変数に格納
            $fileName = str_replace('public/', '', $filePath);
        }
        // その他の値をPhotoインスタンスのプロパティにセットして保存
        $photo->user_id = Auth::id();
        $photo->title = $title;
        $photo->photo = $fileName;
        $photo->save();

        // リダイレクトする（その時にsessionフラッシュにメッセージを入れる）
        return redirect('photos/create')->with('flash_message', __('Registered.'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // GETパラメータが数字かどうかチェックする
        if(!ctype_digit($id)){
            return redirect('photos/index')->with('flash_message', __('Invalid operation was performed.'));
        }

        $photo = Photo::find($id);
        $photo_id = $photo->id;
        $comments = Comment::where('photo_id', $photo_id);

        // 異常判定
        // if(empty($photo)){
        //     return
        // }

        return view('photos.show', compact('photo', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // GETパラメータが数字かどうかチェックする
        if(!ctype_digit($id)){
            return redirect('photos/create')->with('flash_message', __('Invalid operation was performed.'));
        }

        $photo = Photo::find($id);

        // 異常判定
        // if(empty($photo)){
        //     return
        // }

        return view('photos.edit', ['photo' => $photo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $this->validate($request, Photo::$rules);

        // GETパラメータが数字かどうかチェックする
        if(!ctype_digit($id)){
            return redirect('photos/create')->with('flash_message', __('Invalid operation was performed.'));
        }

        // post値を変数に格納
        $title = $request->title;
        $uploadImg = $request->file('photo');

        // 更新するレコードを検索
        $photo = Photo::find($id);

        // 画像がアップロードできているか確認し、ファイル名をPhotoインスタンスのプロパティにセット
        if($uploadImg->isValid()){
            $filePath = $uploadImg->store('public');
            // str_replace関数で$filePathからファイル名を取り出し、変数に格納
            $fileName = str_replace('public/', '', $filePath);
        }
        // その他の値をPhotoインスタンスのプロパティにセットして保存
        $photo->user_id = Auth::id();
        $photo->title = $title;
        $photo->photo = $fileName;
        $photo->save();

        // リダイレクトする（その時にsessionフラッシュにメッセージを入れる）
        return redirect('photos/create')->with('flash_message', __('Registered.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // GETパラメータが数字かどうかチェックする
        if(!ctype_digit($id)){
            return redirect('photos/create')->with('flash_message', __('Invalid operation was performed.'));
        }

        Photo::find($id)->delete();

        return redirect('/photos')->with('flash_message', __('Deleted.'));
    }
}
