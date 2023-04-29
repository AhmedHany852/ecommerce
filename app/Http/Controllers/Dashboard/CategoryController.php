<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\categoryRequest;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    try {

      // $query = Category::filter($request->query());

      // if ($name = $request->query('name')) {
      //   $query->where('name', 'LIKE', "%{$name}%");
      // }
      // if ($status = $request->query('status')) {
      //   $query->where('status', 'LIKE', "%{$status}%");
      // }
      // print_r($query);
      // exit;

      // $categories = Category::filter($request->query())
      //   ->orderBy('categories.name')
      //   ->paginate(2);
      $categories = Category::leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_id')

        ->select([
          'categories.*',
          'parents.name as parent_name'
        ])
        ->filter($request->query())
        ->orderBy('categories.name')
        ->paginate(2);

      return view('dashboard.categories.index', compact('categories'));
    } catch (\Exception $e) {
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    try {

      $category = new Category();
      $parents = Category::all();
      return view('dashboard.categories.create', compact('parents', 'category'));
    } catch (\Exception $e) {
    }
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(categoryRequest $request)
  {
    try {
      $request->merge([
        'slug' => Str::slug($request->post('name'))
      ]);
      $data = $request->except('image');
      $data['image'] = $this->uploadImage($request);
      $category  = Category::create($data);
      return redirect('/categories')->with('success', 'categories create');
    } catch (\Exception $e) {
    }
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show(category $category)
  {

    return view('dashboard.categories.show', [
      'category' => $category,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    try {

      $category = Category::findOrFail($id);
      $parents = Category::where('id', '!=', $id)
        ->where(function ($query) use ($id) {
          $query->whereNull('parent_id')
            ->orwhere('parent_id', '!=', $id)
            ->withCount('products');
        })
        ->get();
      return view('dashboard.categories.edit', compact('category', 'parents'));
    } catch (\Exception $e) {
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(categoryRequest $request, $id)
  {

    try {

      $category = Category::find($id);
      $old_image = $category->image;
      $data = $request->except('image');
      $data['image'] = $this->uploadImage($request);
      if ($old_image && isset($data['image'])) {
        Storage::disk('public')->delete($old_image);
      }
      $category->update($data);
      return Redirect::route('categories.index')->with(['success' => 'category updated']);
    } catch (\Exception $e) {
    }
  }
  public function destroy($id)
  {
    try {
      if (!empty($id)) {
        $Category  = Category::where('id', $id)->first();
        $Category->delete();
      }
      if ($Category->image) {
        Storage::disk('public')->delete($Category->image);
      }
      return Redirect::route('categories.index')->with(['success' => 'category deleted']);
    } catch (\Exception $e) {
    }
  }

  protected function uploadImage(Request $request)
  {
    if (!$request->hasFile('image')) {
      return;
    }
    $file = $request->file('image'); // UploadedFile Object
    $path = $file->store('uploads', [
      'disk' => 'public'
    ]);
    return $path;
  }
  public function trash()
  {
    try {
      $category = Category::onlyTrashed();
      return view('dashboard.categories.trash', compact('category'));
    } catch (\Exception $e) {
    }
  }
  public function restore(Request $request, $id)
  {
    try {
      $category =  Category::onlyTrashed()->findOrFail($id);
      $category->restore();
      return view('dashboard.categories.trashed')->with('succes', 'Category restord');
    } catch (\Exception $e) {
    }
  }
  public function forceDelete($id)
  {
    try {
      $Category =  Category::onlyTrashed()->findOrfail($id);
      $Category->forceDelete();
      return redirect()->route('categories.trash')->with('succes', 'Category deleted forever ');
    } catch (\Exception $e) {
    }
  }
}
