<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::leftJoin(
            'product_photos', 'product_photos.product_id', '=', 'products.id')
            ->select(['product_photos.path_images','product_photos.created_at'])
            ->get();
        //$products = Product::with('productPhotos')->get();

        return view('welcome', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = Product::create($request->all());

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                // $name=$file->getClientOriginalName();
                $filename = $file->store('photos', 'public');
                // $file->move('storage/photos',$name);
                // $filename=time().'_'.$name;
                // dd($filename);
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'path_images' => $filename,
                ]);
            }
        }
        return redirect()->back()->with('message', 'salvo com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    private function imageUpload($images, $imageColumn = null)
    {

        $uploadedImages = [];

        if (is_array($images)) {

            foreach ($images as $image) {
                $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
            }

        } else {
            $uploadedImages = $images->store('logo', 'public');
        }

        return $uploadedImages;
    }
}
