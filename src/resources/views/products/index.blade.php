@extends('layouts.app')

@section('css')
 <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
  <a href="{{ route('products.register') }}" class="btn">+商品を追加</a>
  
  <!-- 検索フォーム -->
    <form action="{{ route('products.index') }}" method="GET" enctype="multipart/form-data" 
    class="search-form" >
        <input type="text" name="query" placeholder="商品名で検索" value="{{ request('query') }}">
        <button type="submit">検索</button>
    </form>

    <div class="product-container">
        @forelse ($products as $product)
            <a href="{{ route('products.show', $product->id) }}" class="product-item">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>価格: {{ $product->price }}円</p>
            </a>
        @empty
            <p>該当する商品がありません。</p>
        @endforelse
    </div>

    <!-- ページネーション -->
    <div class="pagination">
        {{ $products->links() }}
    </div>
@endsection