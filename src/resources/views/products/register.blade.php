@extends('layouts.app')

@section('css')
 <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <h1>商品登録</h1>

    <!-- 商品登録フォーム -->
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="name">商品名:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力" >
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price">値段:</label>
            <input type="text" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力" >
            @error('price')
                <p class="error-message" >{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>季節:</label>
            @php
                $seasons = \App\Models\Season::all();
            @endphp
            @foreach ($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
            @endforeach
            @error('seasons')
                <p class="error-message" >{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">商品説明:</label>
            <textarea name="description" id="description" placeholder="商品の説明を入力" >{{ old('description') }}</textarea>
            @error('description')
                <p class="error-message" >{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image">商品画像:</label>
            <input type="file" name="image" id="image" >
            @error('image')
                <p class="error-message" >{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">登録</button>
    </form>

    <!-- 戻るボタン -->
    <a href="{{ route('products.index') }}">商品一覧に戻る</a>
@endsection
