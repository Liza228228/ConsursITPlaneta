<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
{
    // Получаем доступные категории
    $categories = Category::where('available', true)->get();

    // Получаем продукты для каждой доступной категории
    $productsByCategory = [];
    foreach ($categories as $category) {
        $productsByCategory[$category->id_category] = Product::where('id_category', $category->id_category)
            ->where('available', true) // Фильтруем только доступные товары
            ->with('category')
            ->get();
    }

    // Передаем данные в представление
    return view('shop.catalog', compact('categories', 'productsByCategory'));
}

public function show($id)
{
    // Получаем продукт по его ID
    $product = Product::with('category')->findOrFail($id);

    // Проверяем, доступен ли продукт
    if (!$product->available) {
        abort(404); // Если продукт недоступен, выводим ошибку 
    }

    // Передаем данные в представление
    return view('shop.show', compact('product'));
}
//поиск
public function search(Request $request)
{
    // Получаем запрос из формы поиска
    $query = $request->input('query');

    // Проверяем на пустое заполнение поля
    if (empty($query)) {
        return redirect()->back(); //остаемся на той же странице
    }

    // Ищем продукты, соответствующие запросу
    $products = Product::where('name_product', 'like', $query . '%') // Поиск по началу 
                       ->get();

    // Передаем результаты поиска в представление
    return view('shop.search', compact('products', 'query'));
}
}