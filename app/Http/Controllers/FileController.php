<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TextResource;
use App\models\Text;

class FileController extends Controller
{
    //
    public function store(Request $request)
    {
       if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/').$name);
        }

       /*$image= new FileUpload();
       $image->image_name = $name;
       $image->save();*/

       $options = [
            "text" => $name
        ];

        $t = Text::create($options);
        $id = new TextResource($t);
        //return response(new TextResource($t));

       return response()->json(['success' => $id], 200);
     }
}
