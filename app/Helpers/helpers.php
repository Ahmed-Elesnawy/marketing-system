<?php





if ( !function_exists('user') )
{
    function user()
    {
        return auth()->user();
    }
}



if (!function_exists('check_default')) {
    /**
    * Check if given path contains default keyword
    * @param string $path
    * @return boolean
    */

    function check_default($path)
    {
        return preg_match('/default/', $path);
    }
}


if (!function_exists('upload')) {
    /**
    * Upload Image and resize it and return by path of it
    * @param string $file_name from $request
    * @param string $directory to store file in
    * @param int $width
    * @param int $height
    * @param string $old to delete old one if exists
    * @return string $path to save in DB
    */
    function upload($file_name, $directory, $width, $height, $old=null)
    {
        if ($old !== null and check_default($old) == 0) {
            
            check_file($old);
        }
        $path = request($file_name)->store($directory);
        $img = Image::make('storage/'.$path);
        $img->resize($width, $height)->save();

        return $path;
    }
}



if (!function_exists('check_file')) {
    /**
    * Check if file exist true ? delete it
    * @param string $file
    * @return void
    */

    function check_file($file)
    {
        if (Storage::has($file) and check_default($file) == 0) {
            Storage::delete($file);
        }

        return "";
    }
}




if (!function_exists('is_active'))
{
    /**
     * Add class menu open to sidebar if matched with given link
     * @param string $name
     * @return array
     */

     function is_active($name)
     {
         if ( request()->segment(1) == $name )
         {
             return 'active';
         }

         return '';
     }

 
}

if ( !function_exists('get_order_status') )
{
    function get_order_status()
    {
        return [
            'canceld'     => trans('software.canceld'),
            'discarded'   => trans('software.discarded'),
        ];
    }
}



if ( !function_exists('get_shipping_status') )
{
    function get_shipping_status()
    {
        return [
            'pending'    => trans('software.pending'),
            'processing' => trans('software.processing'),
            'shipped'    => trans('software.shipped'),
        ];
    }
}



