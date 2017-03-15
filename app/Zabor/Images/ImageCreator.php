<?php namespace App\Zabor\Images;

use App\Zabor\Mysql\Item_resource;
use Image;
use File;
use Log;

class ImageCreator
{

    public function __construct(Item_resource $image)
    {
        $this->image = $image;
    }

    public function storeAndSave()
    {
    }

    /**
     * @param array $image_list
     * @param $item_id
     */
    public function storeAndSaveMultiple($image_list = [], $item_id)
    {
        // directory creating logic
        $directory = "oc-content/uploads/" . floor($item_id/100);

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory);
        }

        foreach ($image_list as $image_data) {
            $arr = explode('.', $image_data['name']);

            $image = Image::make('temp/'. $image_data['name'])->encode('jpg');

        /*	$width = (int) max($image->width(), $image->height() * 3 / 4);

			$height = (int) max($image->height(), $image->width() * 4 / 3);

			$image->resizeCanvas($width, $height);*/

            $image_record = $this->image->create([
                'fk_i_item_id'  => $item_id,
                's_name'        => $arr[0],
                's_extension'   => 'jpg',
                's_content_type'=> 'image/jpeg',
                's_path'        => $directory . '/'
                ]);

            $original  = $image->fit(640, 480);
            $original->save("{$directory}/{$image_record->pk_i_id}.jpg", 80);

            $preview   = $image->fit(480, 340);
            $preview->save("{$directory}/{$image_record->pk_i_id}_preview.jpg", 80);

            $thumbnail = $image->fit(240, 200);
            $thumbnail->save("{$directory}/{$image_record->pk_i_id}_thumbnail.jpg", 80);
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $image = $this->image->find($id);

        $name = $image->pk_i_id;

        File::delete(public_path("{$image->s_path}{$name}_thumbnail.{$image->s_extension}"));
        File::delete(public_path("{$image->s_path}{$name}_preview.{$image->s_extension}"));
        File::delete(public_path("{$image->s_path}{$name}.{$image->s_extension}"));

        $image->delete();
        
        return true;
    }
}
