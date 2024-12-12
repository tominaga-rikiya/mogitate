<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    // 商品一覧
    public function index(Request $request)
    {
        $query = $request->get('query');
        $products = Product::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%');
        })->paginate(6);

        return view('products.index', compact('products'));
    }

    // 商品詳細
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    // 商品登録フォーム
    public function register()
    {
        return view('products.register');
    }

    // 商品登録処理
    public function store(ProductRequest $request)
    {
        // バリデーションが自動的に通過した後の処理
        $validated = $request->validated(); // バリデーション済みデータを取得

        // 画像アップロード処理
        $imagePath = $request->file('image')->store('product_images', 'public');

        // 商品データをデータベースに保存
        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $imagePath,
            'description' => $validated['description'],
        ]);

        return redirect()->route('products.index')->with('success', '商品が登録されました');
    }

    // 商品更新フォーム
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.edit', compact('product'));
    }

    // 商品更新処理
    public function update(ProductRequest $request, $productId)
    {
        $validated = $request->validated(); // バリデーション済みデータを取得

        $product = Product::findOrFail($productId);
        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
        ]);

        // 画像の処理
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->update(['image' => $imagePath]);
        }

        return redirect()->route('products.show', $productId)->with('success', '商品が更新されました');
    }

    // 商品削除処理
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品が削除されました');
    }

    // 商品検索
    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->paginate(6);

        return view('products.index', compact('products'));
    }
}
