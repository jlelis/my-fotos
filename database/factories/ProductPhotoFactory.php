<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class ProductPhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductPhoto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $filepath = public_path('storage/photos');
        if(!File::exists($filepath)){
            File::makeDirectory($filepath);
        }
        return [

            'product_id' => Product::factory(0),
            'path_images' => 'photos/' . $this->faker->image($filepath, 640, 480, null, false,true),
        ];
    }
}
