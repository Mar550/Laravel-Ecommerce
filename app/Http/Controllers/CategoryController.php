<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('products_count','desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        //Request = Formulaire
        //Validation + Création + Redirect
        $this->validate($request, [
            'category_name' => 'required|unique:categories',
            'description' => 'required|string',
            'category_image' => 'required|max:2048',
        ],[
            'category_name.required'=>'category name is required',
            'category_name.unique'=>'category name is unique',
            'description.required' => 'description is required',
            'description.string' => 'the description must be just characters',
            'category_image.max' => 'max file upload size is 2M',
        ]);

        /** Stockage => Créer un lien symbolique */ 
        //Storage /  public / files / image.png
        // Accéder aux images avec un lien symbolique 

        $path = $request->file('category_image')->store('public/files');
        //Stocker l'image dans la base de données  ($guarded-> to insert many data in the table)

        Category::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'category_image' => $path,
        ]);
        Session::put('message', 'Category created successfully !');
        // OR $request->session()->put('message', 'cagtegory created successfully');
        return redirect()->route('admin.categories.index')->with('message','Category Created Successfully');
    }

    public function show($id)
    {
        $product = Category::find($id)->products;
        $categorie = Category::find($id);
        return view('admin.categories.show', ['product' =>$product, 'categorie'=>$categorie]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $catWithProduct = $category->products;
        return view('admin.categories.edit', compact('catWithProduct','category'));
    }

    public function update(Request $request,$id)
    {
        //Get the category
        //Get the image of the category
        //Delete image from public files
        //Add new image in public files

        //Add new category informations
        //Save new informations
        //Session message updated successfully
        //Redirect route index

            $category = Category::find($id);
        $image = $category->category_image;
        
        if ($request->file('image')) {
            Storage::delete($image);
            $image = $request->file('image')->store('public/files');
        }

        $category->category_name = $request->category_name;
        $category->description = $request->category_description;
        $category->category_image = $image;

        $category->save();
        Session::put('update', 'item updated successfully');
        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {  
        $category = Category::find($id);
        if ($category != null) {
            $category->delete();
        }
        return redirect()->route('admin.categories.index');
    }
}
