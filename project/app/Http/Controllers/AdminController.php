<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class AdminController extends Controller
{
    // Проверка доступа администратора
    private function checkAdminAccess()
    {
        //если пользователь не авторизован
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
    }

    // Отображение главной страницы администратора
    public function index()
    {
        $this->checkAdminAccess(); // Проверяем доступ
        return view('admin.index'); 
    }

    // Отображение списка пользователей
    public function users()
    {
        $this->checkAdminAccess(); 
        $users = User::all(); // Получаем всех пользователей
        return view('admin.users', compact('users')); 
    }

    // Отображение списка продукции
    public function products()
    {
        $this->checkAdminAccess(); 
        $products = Product::all(); // Получаем все продукты
        return view('admin.products', compact('products')); 
    }

    // Отображение формы редактирования продукта
    public function editProduct($id)
    {
        $this->checkAdminAccess(); 
        $product = Product::findOrFail($id); // Получаем продукцию по ID
        $categories = Category::where('available', 1)->get(); // Получаем доступные категории
        return view('admin.edit-product', compact('product', 'categories')); 
    }
    // Обновление продукции
    public function updateProduct(Request $request, $id)
    {
        $this->checkAdminAccess(); 
        $product = Product::findOrFail($id); // Получаем продукт по ID

        // Обновляем данные продукта
        $product->update([
            'name_product' => $request->input('name_product'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'weight' => $request->input('weight'),
            'quantity' => $request->input('quantity'),
            'available' => $request->input('available'),
            'id_category' => $request->input('id_category'), 
        ]);

        // Если загружено изображение, сохраняем его
        if ($request->hasFile('picture')) {
            $fileName = $request->file('picture')->getClientOriginalName(); // получаем  имя файла
            $path = public_path('images/product/' . $fileName); // путь для сохранения файла
            $request->file('picture')->move(public_path('images/product'), $fileName); // перемещаем файл в папку 
            $product->picture = '/images/product/' . $fileName; // Сохраняем путь к изображению в бд
            $product->save();
        }

        return redirect()->route('admin.products')->with('success', 'Продукт обновлен'); 
    }
    
    //  форма создания нового продукта
    public function createProduct()
    {
        $this->checkAdminAccess(); 
        $categories = Category::where('available', 1)->get(); 
        return view('admin.create-product', compact('categories')); 
    }

    // сохранение новой продукции
    public function storeProduct(Request $request)
{
    $this->checkAdminAccess(); 

    // Правила валидации
    $rules = [
        'name_product' => 'required|string|max:255|unique:products,name_product', // Уникальное ограничение
        'description' => 'required|string',
        'price' => 'required|numeric',
        'weight' => 'required|numeric',
        'quantity' => 'required|integer',
        'available' => 'required|boolean',
        'id_category' => 'required|exists:categories,id_category',
        'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    // Сообщения об ошибках
    $messages = [
        'name_product.required' => 'Поле "Название продукта" обязательно для заполнения.',
        'name_product.unique' => 'Продукция с таким названием уже существует.', // Сообщение об ошибке
        'description.required' => 'Поле "Описание" обязательно для заполнения.',
        'price.required' => 'Поле "Цена" обязательно для заполнения.',
        'price.numeric' => 'Поле "Цена" должно быть числом.',
        'weight.required' => 'Поле "Вес" обязательно для заполнения.',
        'weight.numeric' => 'Поле "Вес" должно быть числом.',
        'quantity.required' => 'Поле "Количество" обязательно для заполнения.',
        'quantity.integer' => 'Поле "Количество" должно быть целым числом.',
        'available.required' => 'Поле "Доступность" обязательно для заполнения.',
        'available.boolean' => 'Поле "Доступность" должно да/нет.',
        'id_category.required' => 'Поле "Категория" обязательно для заполнения.',
        'id_category.exists' => 'Выбранная категория не существует.',
        'picture.required' => 'Поле "Изображение" обязательно для заполнения.',
        'picture.image' => 'Загруженный файл должен быть изображением.',
        'picture.mimes' => 'Изображение должно быть в формате jpeg, png, jpg или gif.',
        'picture.max' => 'Размер изображения не должен превышать 2 МБ.',
    ];

    // Валидация данных
    $request->validate($rules, $messages);

    // Создаем новый продукт
    $product = Product::create($request->all());

    if ($request->hasFile('picture')) {
        $fileName = $request->file('picture')->getClientOriginalName();
        $path = public_path('images/product/' . $fileName);
        $request->file('picture')->move(public_path('images/product'), $fileName);
        $product->picture = '/images/product/' . $fileName;
        $product->save();
    }

    return redirect()->route('admin.products')->with('success', 'Продукт добавлен');
}

    // Удаление продукции
    public function deleteProduct($id)
    {
        $this->checkAdminAccess(); 
        Product::destroy($id); // удаление продукции по ID
        return redirect()->route('admin.products')->with('success', 'Продукт удален'); 
    }

    //  список заказов
    public function orders()
    {
        $this->checkAdminAccess(); 
        $orders = Order::with('user')->get(); 
        return view('admin.orders', compact('orders')); 
    }

    // Обновление статуса заказа
    public function updateOrderStatus(Request $request, $id)
    {
        $this->checkAdminAccess(); 
        $order = Order::findOrFail($id); 
        $order->status = $request->status; // обнавление статус заказа
        $order->save();
        return redirect()->route('admin.orders')->with('success', 'Статус заказа обновлен'); 
    }

    // список категорий
    public function categories()
    {
        $this->checkAdminAccess(); 
        $categories = Category::all(); 
        return view('admin.categories', compact('categories')); 
    }

    // форма создания новой категории
    public function createCategory()
    {
        $this->checkAdminAccess(); 
        return view('admin.create-category'); 
    }

    // сохранение новой категории
    public function storeCategory(Request $request)
{
    $this->checkAdminAccess(); 

    // Правила валидации
    $rules = [
        'name_category' => 'required|string|max:255|unique:categories,name_category', 
        'available' => 'required|boolean',
    ];

    // Сообщения об ошибках
    $messages = [
        'name_category.required' => 'Поле "Название категории" обязательно для заполнения.',
        'name_category.unique' => 'Категория с таким названием уже существует.', 
        'available.required' => 'Поле "Доступность" обязательно для заполнения.',
        'available.boolean' => 'Поле "Доступность" должно быть да/нет.',
    ];

    // Валидация данных
    $request->validate($rules, $messages);

    // Создаем новую категорию
    $category = Category::create($request->all());

    return redirect()->route('admin.categories')->with('success', 'Категория добавлена');
}

    // форма редактирования категории
    public function editCategory($id)
    {
        $this->checkAdminAccess(); 
        $category = Category::findOrFail($id); 
        return view('admin.edit-category', compact('category')); 
    }

    // обновление категории
    public function updateCategory(Request $request, $id)
{
    $this->checkAdminAccess(); 

    // Правила валидации
    $rules = [
        'name_category' => 'required|string|max:255',
        'available' => 'required|boolean',
    ];

    // Сообщения об ошибках
    $messages = [
        'name_category.required' => 'Поле "Название категории" обязательно для заполнения.',
        'available.required' => 'Поле "Доступность" обязательно для заполнения.',
        'available.boolean' => 'Поле "Доступность" должно быть логическим значением.',
    ];

    // Валидация данных
    $request->validate($rules, $messages);

    // Обновляем категорию
    $category = Category::findOrFail($id);
    $category->update($request->all());

    return redirect()->route('admin.categories')->with('success', 'Категория обновлена');
}

    // Удаление категории
    public function deleteCategory($id)
    {
        $this->checkAdminAccess(); 
        Category::destroy($id); 
        return redirect()->route('admin.categories')->with('success', 'Категория удалена'); 
    }
}