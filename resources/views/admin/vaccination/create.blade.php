<!DOCTYPE html>
   {{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'ワクチン接種履歴新規作成')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="text-center">
                <h2>接種履歴作成</h2>
                </div>
                <form action="{{ route('admin.vaccination.create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">ワクチンの種類</label>
                        <div class="col-md-10">
                            <input type="search" class="form-control" list="list" name="vaccine" value="{{ old('vaccine') }}">
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
                        <label class="col-md-2">接種日</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">製品名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="product" value="{{ old('product') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">ロット番号</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="lot" value="{{ old('lot') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">クリニック</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="clinic" value="{{ old('clinic') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">医師</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="doctor" value="{{ old('doctor') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection