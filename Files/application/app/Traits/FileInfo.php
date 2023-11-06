<?php

namespace App\Traits;

trait FileInfo
{

    /*
    |--------------------------------------------------------------------------
    | File Information
    |--------------------------------------------------------------------------
    |
    | This trait basically contain the path of files and size of images.
    | All information are stored as an array. Developer will be able to access
    | this info as method and property using FileManager class.
    |
    */

    public function fileInfo(){

        $data['depositVerify'] = [
            'path'      =>'assets/images/verify/deposit'
        ];
        $data['verify'] = [
            'path'      =>'assets/verify'
        ];
        $data['default'] = [
            'path'      => 'assets/images/default.png',
        ];

        $data['ticket'] = [
            'path'      => 'assets/support',
        ];
        $data['logoIcon'] = [
            'path'      => 'assets/images/logoIcon',
        ];
        $data['favicon'] = [
            'size'      => '128x128',
        ];
        $data['extensions'] = [
            'path'      => 'assets/images/extensions',
            'size'      => '36x36',
        ];
        $data['seo'] = [
            'path'      => 'assets/images/seo',
            'size'      => '1180x600',
        ];
        $data['userProfile'] = [
            'path'      =>'assets/images/user/profile',
            'size'      =>'350x300',
        ];
        $data['adminProfile'] = [
            'path'      =>'assets/admin/images/profile',
            'size'      =>'400x400',
        ];
        $data['category'] = [
            'path'      => 'assets/images/categories',
            'size'      =>'194x194',
        ];
        $data['productImages'] = [
            'path'      => 'assets/images/product_images',
            'size'      =>'400 x 400',
        ];
        $data['customProductImages'] = [
            'path'      => 'assets/images/customProductImages',
            'size'      =>'500 x 500',
        ];
        $data['hero'] = [
            'path'      =>'assets/images/frontend/banner',
        ];
        $data['about'] = [
            'path'      =>'assets/images/frontend/about',
        ];
        $data['about'] = [
            'path'      =>'assets/images/frontend/about',
        ];

        $data['testimonial'] = [
            'path'      =>'assets/images/frontend/testimonial',
        ];
         $data['blog'] = [
            'path'      =>'assets/images/frontend/blog',
        ];
        return $data;
	}

}
