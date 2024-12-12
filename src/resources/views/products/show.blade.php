@extends('layouts.app')

@section('css')
 <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
    <h1>{{ $product->name }}</h1>

    <div>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="300">
    </div>

    <!-- 編集フォーム -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">商品名:</label>
            @error('name') 
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price">価格:</label>
            <input type="text" name="price" id="price" placeholder="価格を入力" value="{{ old('price', $product->price) }}" >
            @error('price') 
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">商品説明:</label>
            <textarea name="description" id="description" placeholder="商品の説明を入力" >{{ old('description', $product->description) }}</textarea>
            @error('description') 
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>季節:</label>
            @php
                // 商品の季節を取得
                $selectedSeasons = $product->seasons ? $product->seasons->pluck('id')->toArray() : [];
                $allSeasons = \App\Models\Season::all();
            @endphp

            @foreach ($allSeasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                        {{ in_array($season->id, old('seasons', $selectedSeasons)) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
            @endforeach
            @error('seasons')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="image">画像:</label>
            <input type="file" name="image" id="image">
            @error('image')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">変更を保存</button>
    </form>

    <!-- 削除フォーム -->
    @if(isset($product))
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <img src="{{ asset('images/trash-icon.png') }}" alt="削除">
            </button>
        </form>
    @endif

    <a href="{{ route('products.index') }}">商品一覧に戻る</a>
@endsection
