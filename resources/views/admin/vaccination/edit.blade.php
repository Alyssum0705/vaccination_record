@extends('layouts.admin')
@section('title', 'ワクチン接種履歴の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>接種履歴編集</h2>
                <form action="{{ route('admin.vaccination.update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="vaccine">ワクチンの種類</label>
                        <div class="col-md-10">
                            <input type="search" class="form-control" list="list" name="vaccine" value="{{ $vaccination_form->vaccine }}">
                            <datalist id="list">
                                <option value="A型肝炎">
                                <option value="B型肝炎">
                                <option value="破傷風/ジフテリア/百日咳">
                                <option value="腸チフス">
                                <option value="髄膜炎">
                                <option value="狂犬病">
                                <option value="コレラ">
                                <option value="日本脳炎">
                                <option value="ポリオ">
                                <option value="麻疹/風疹/おたふく">
                                <option value="水痘">
                                <option value="ダニ脳炎">
                                <option value="新型コロナウィルス">
                                <option value="インフルエンザ">
                                <option value="黄熱病">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="date">接種日</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" value="{{ $vaccination_form->date }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="product">製品名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="product" value="{{ $vaccination_form->product }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="lot">ロット番号</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="lot" value="{{ $vaccination_form->lot }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="clinic">クリニック</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="clinic" value="{{ $vaccination_form->clinic }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="doctor">医師</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="doctor" value="{{ $vaccination_form->doctor }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $vaccination_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $vaccination_form->id }}">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($vaccination_form->histories != NULL)
                                @foreach ($vaccination_form->histories as $history)
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection