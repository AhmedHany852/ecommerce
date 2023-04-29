<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Str;

class storeController extends Controller
{

    public function index(Request $request)
    {
        try {

            $store = Store::paginate(2)
                ->sortBy('stores.name');

            return view('dashboard.stores.index', compact('store'));
        } catch (\Exception $e) {
        }
    }


    public function create()
    {
        try {
            $store = new Store();
            return view('dashboard.stores.create', compact('store'));
        } catch (\Exception $e) {
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
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255'],
                'description' => ['nullable'],
                'logo_image' => ['nullable'],
                'cover_image' => ['nullable'],
                'status' => ['in:active,inactive'],
            ]);
            $data = $request->except('logo_image');
            $data = $request->except('cover_image');
            $data['logo_image'] = $this->uploadImage($request);
            $data['cover_image'] = $this->uploadImage($request);
            $store = Store::create($data);
            return redirect()->route('stores.index')->with('success', 'Store create');
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        try {
            $store = Store::find($id);
            return view('dashboard.stores.edit', compact('store'));
        } catch (\Exception $e) {
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'max:255'],
                'description' => ['nullable'],
                'logo_image' => ['nullable'],
                'cover_image' => ['nullable'],
                'status' => ['in:active,inactive'],
            ]);
            $store = Store::where('id', $id)->first();
            $input = $request->all();
            $store->fill($input)->save();
            return redirect()->route('stores.index')->with('success', 'Store update');
        } catch (\Exception $e) {
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
        try {
            $store = Store::where('id', $id)->first();
            $store->delete();
            return redirect()->route('stores.index')->with('success', 'Store delete');
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getFile(), $e->getLine());
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
}
