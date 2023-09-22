<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vaccination;
use App\Models\History;

use Carbon\Carbon;

class VaccinationController extends Controller
{
    //
    public function add()
    {
        return view('admin.vaccination.create');
    }
     public function create(Request $request)
    {
                // 以下を追記
        // Validationを行う
        $this->validate($request, News::$rules);

        $vaccination = new Vaccination;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $vaccination->image_path = basename($path);
        } else {
            $vaccination->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $vaccination->fill($form);
        $vaccination->save();

        // admin/news/createにリダイレクトする
        return redirect('admin/vaccination/create');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = vaccination::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Vaccination::all();
        }
        return view('admin.vaccination.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
     // 以下を追記

    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $vaccination = Vaccination::find($request->id);
        if (empty($vaccination)) {
            abort(404);
        }
        return view('admin.vaccination.edit', ['vaccination_form' => $vaccination]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, News::$rules);
        // News Modelからデータを取得する
        $vaccination = Vaccination::find($request->id);
        // 送信されてきたフォームデータを格納する
        $vaccination_form = $request->all();
        
         if ($request->remove == 'true') {
            $vaccination_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $vaccination_form['image_path'] = basename($path);
        } else {
            $vaccination_form['image_path'] = $vaccination->image_path;
        }

        unset($vaccination_form['image']);
        unset($vaccination_form['remove']);
        unset($vaccination_form['_token']);

        // 該当するデータを上書きして保存する
        $vaccination->fill($vaccination_form)->save();
        
        // 以下を追記(編集履歴の記録と参照)
        $history = new History();
        $history->vaccination_id = $vaccination->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/vaccination');
    }
    
     // 以下を追記

    public function delete(Request $request)
    {
        // 該当するvaccination Modelを取得
        $vaccination = Vaccination::find($request->id);

        // 削除する
        $vaccination->delete();

        return redirect('admin/vaccination/');
    }
}
