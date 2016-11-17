<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Response;
use Validator;
use Session;
use Exception;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Zabor\Images\ImageCreator;

class ItemImageApiController extends Controller
{
    
    public function __construct(ImageCreator $image)
    {
        $this->image     = $image;
    }
    
    /**
     * [storeImage description]
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function storeImage(Request $request)
    {
        $key = $request->header('imageKey');

        $rules = [
            'file'  => 'required|image|max:2048|mimes:jpeg,png'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Response::json([
                  'error' => true,
                  'message' => 'Some problems while saving',
                  'code' => 400
                    ], 400);
        }

        $file = $request->file('file');

        $ext = $file->getClientOriginalExtension();

        $name = str_random(10) . '.'. $ext;

        $image = [
            'name' => $name,
            'path' => url("temp/{$name}")
        ];

        $file->move('temp', $name);

        Session::push('item_images.'. $key, $image);

        return Response::json([
            'name'      => $name,
            'message'   => 'uploaded',
            'code'      => 200
            ], 200);
    }

    /**
     * [removeImage description]
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function removeImage(Request $request)
    {

        $name = $request->input('name');

        $key = $request->header('imageKey');

        try {
            // checks if $name is numeric $image->id that is already in database or it is a alphabetic new name
            if (is_numeric($name)) {
                $image_id = (int) $name;

                $this->image->delete($image_id);
            } else {
                $array = [];

                foreach (Session::get('item_images.'. $key) as $image) {
                    if ($image['name'] != $name) {
                        $array[] = $image;
                    }
                }

                Session::put('item_images.'. $key, $array);
            }
        } catch (Exception $e) {
            return Response::json([
            'message'   => 'troubles',
            'code'      => 400
            ], 400);
        }

        return Response::json([
            'message'   => 'deleted succesfully',
            'code'      => 200
            ], 200);
    }
}
