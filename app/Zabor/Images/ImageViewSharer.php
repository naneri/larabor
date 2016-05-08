<?php namespace App\Zabor\Images;

use Request;
use Session;
use JavaScript;

class ImageViewSharer 
{

	/**
	 * [shareItemAddImages description]
	 * @param  [type] $request [description]
	 * @param  array  $images  Array of images that are already stored. This variable is provided in case we open 'Edit item' page
	 * @return [type]          [description]
	 */
	public function shareItemAddImages($request, $images = [])
	{
		// processing if $request has old Input
		if(!empty($request->old())){

	        $image_key = $request->old('image_key');
	        
	        //appending images from session to the images from database
	        $images = array_merge($images, Session::get('item_images.' . $image_key));

	    // if the page has been opened for the first time    	
		}else{

			// refreshing the key if the item add page is opened for the first time
			$image_key = str_random(10);

            Session::put('item_images.' . $image_key, []);
            
		}

		// sharing images for dropzone plugin
		JavaScript::put('dz_images', $images);

		// sharing the image_key that will be used by the user
		view()->share(compact('image_key'));
	}
}