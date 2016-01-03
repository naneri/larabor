<?php namespace App\Zabor\Images;

use App\Zabor\Mysql\Item_resource;
use Image;
use File;
use Log;

class ImageCreator{

	public function __construct(Item_resource $image)
	{
		$this->image = $image;
	}

	public function storeAndSave(){

	}

	/**
	 * [storeAndSaveMultiple description]
	 * 
	 * @param  [array] $images  [description]
	 * @param  [int] $item_id [description]
	 * 
	 * @return [type]          [description]
	 */
	public function storeAndSaveMultiple($image_list = [], $item_id)
	{
		foreach($image_list as $image_data){
			Log::info('creating');
			$arr = explode('.' , $image_data['name']);
			$image = Image::make('uploads/temp/'. $image_data['name'])->encode('jpg');

			$thumbnail = $image->fit(240,200);
			$preview   = $image->fit(480,340);
			$original  = $image->fit(640,480);

			$directory = 'uploads/' . floor($item_id/100);
			if(!File::isDirectory($directory)){
				File::makeDirectory($directory);
			}

			$thumbnail->save("{$directory}/{$arr[0]}_thumbnail.{$arr[1]}", 100);
			$preview->save("{$directory}/{$arr[0]}_preview.{$arr[1]}", 100);	
			$original->save("{$directory}/{$arr[0]}.{$arr[1]}", 100);

			$this->image->create([
				'fk_i_item_id'  => $item_id, 
				's_name'		=> $arr[0], 
				's_extension'	=> $arr[1], 
				's_content_type'=> 'image/jpeg', 
				's_path'		=> $directory . '/'
				]);
		}
	}
}
