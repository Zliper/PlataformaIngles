<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TextResource;
use App\models\Text;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class FileController extends Controller
{
    //
    public function store(Request $request)
    {
       if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          //\Image::make($request->get('image'))->save(public_path('images/').$name);
          //$image->store($request->get('image'));
          //Storage::disk('local')->put('file.txt', 'Contents');
          //Storage::putFileAs($image, new File(public_path('images')), $name);
          //Storage::putFile('images', new File('/path/to/photo'));
          
          $file = explode(";base64,", $image);

          Storage::put($name, base64_decode($file[1]));
          
          //Storage::putFile($image, new File(public_path('images/').$name));
          //$path = $request->get('image')->store('photos');
          //Storage::put('image.jpg', $contents);
        }

        //$path = $request->get('image')->store('photos');

       /* $image= new FileUpload();
       $image->image_name = $name;
       $image->save(); */

       $options = [
            "text" => $name
            //"text" => $path
        ];

        $t = Text::create($options);
        $id = new TextResource($t);
        //return response(new TextResource($t));

       return response()->json(['success' => $id], 200);
     }
}
