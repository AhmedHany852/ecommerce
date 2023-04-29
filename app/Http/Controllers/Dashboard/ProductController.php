<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use  App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Tag;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = Product::with(['store', 'categore'])
            ->filter($request->query())
            ->paginate(2);

        // print_r($datas);
        // exit;

        return view('dashboard.products.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            $product = new Product();
            $category = Product::with('categore')->get();
            $tags = implode(',', $product->tags()->pluck('name')->toArray());

            return view('dashboard.products.create', compact('product', 'category', 'tags'));
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // print_r($request->all());
            // exit;


            $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|int|exists:categories,id',
                'image' => 'nullable|image',
                'price' => 'required|numeric|min:0',
                'compare_price' => 'nullable|numeric|gt:price',
            ]);

            $request->merge([
                'slug' => Str::slug($request->post('name'))
            ]);
            $data = $request->except('image', 'tags');
            $store_id = Auth::user()->store_id;
            $data['store_id'] =  $store_id;
            // $image = "";
            if ($request->image) {
                $image = $this->uploadFile($request, null, 'product');
            }
            $data['image'] = $image;
            $category = Product::create($data);
            return redirect('/products')->with('success', 'Product create');
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Product::findOrFail($id);
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        $category = Product::with('categore')->get();

        return view('dashboard.products.edit', compact('product', 'tags', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            $product = Product::findOrFail($product->id);
            $product->update($request->except('tags'));
            $tags = json_decode($request->post('tags'));
            $tag_ids = [];
            $saved_tags = Tag::all();
            foreach ($tags as $item) {
                $slug = Str::slug($item->value);
                $tag = $saved_tags->where('slug', $slug)->first();
                if (!$tag) {
                    $tag = Tag::create([
                        'name' => $item->value,
                        'slug' => $slug,
                    ]);
                }
                $tag_ids[] = $tag->id;
            }

            $product->tags()->sync($tag_ids);

            return redirect()->route('products.index')
                ->with('success', 'Product updated');
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function uploadFile(Request $request, string $file_name = null, string $path): string
    {
        $imageName = Str::replace(' ', '', $request->file($file_name ?? "image")->getClientOriginalName());
        $path = $request->file($file_name ?? "image")->storeAs($path, rand(1, 99999) . $imageName, 'public');

        return 'storage/' . $path;
        // return asset('storage/app/public/' . $path);
    }
}