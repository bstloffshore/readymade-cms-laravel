<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
class SiteSettingsController extends Controller
{
    public function create()
    {
        $siteSetting=SiteSetting::first();
        return view('admin.site-settings.create',get_defined_vars());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'site_name_en' => 'required',
            ]);
            $siteSetting=SiteSetting::get();
            if($siteSetting->isEmpty())
            {
                $requestData = $request->post();
                if ($request->hasFile('header_logo')) {
                    $requestImage = $request->file('header_logo');
                    $image = time() . '.' . $requestImage->getClientOriginalExtension();
                    // Define the storage paths
                    $storagePath = 'site-settings/';
                    $thumbnailPath = 'public/site-settings/thumb/';
                    $largePath = 'public/site-settings/large/';

                    // Create the 'large' directory if it doesn't exist
                    if (!Storage::exists($largePath)) {
                        Storage::makeDirectory($largePath);
                    }
                    // Store the original image in 'public' storage
                    // Storage::putFileAs($storagePath, $requestImage, $image);
                    // Create a thumbnail
                    $thumbnail = Image::make($requestImage->path());
                    $thumbnail->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                    // Store the thumbnail in 'public' storage
                    Storage::put($thumbnailPath . $image, $thumbnail->stream());
                    // Store the original image in 'public' storage in the 'large' directory
                    Storage::putFileAs($largePath, $requestImage, $image);
                    // Update the image path in your database if needed
                    $requestData['header_logo'] = $image;
                }
                if ($request->hasFile('footer_logo')) {
                    $requestImage = $request->file('footer_logo');
                    $image = time() . '.' . $requestImage->getClientOriginalExtension();
                    // Define the storage paths
                    $storagePath = 'site-settings/';
                    $thumbnailPath = 'public/site-settings/thumb/';
                    $largePath = 'public/site-settings/large/';

                    // Create the 'large' directory if it doesn't exist
                    if (!Storage::exists($largePath)) {
                        Storage::makeDirectory($largePath);
                    }
                    // Store the original image in 'public' storage
                    // Storage::putFileAs($storagePath, $requestImage, $image);
                    // Create a thumbnail
                    $thumbnail = Image::make($requestImage->path());
                    $thumbnail->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                    // Store the thumbnail in 'public' storage
                    Storage::put($thumbnailPath . $image, $thumbnail->stream());
                    // Store the original image in 'public' storage in the 'large' directory
                    Storage::putFileAs($largePath, $requestImage, $image);
                    // Update the image path in your database if needed
                    $requestData['footer_logo'] = $image;
                }
                $siteSetting = SiteSetting::create($requestData);
                if($siteSetting){
                $response['error'] = false;
                $response['msg'] = 'The site setting was created successfully!';
                } else {
                $response['error'] = true;
                $response['msg'] = 'The site setting was not created.';
                }
            }else{
                $id=$request->id;
                $siteSetting = SiteSetting::findOrFail($id);
                $requestData = $request->post();
                if ($request->hasFile('header_logo')) {
                    $requestImage = $request->file('header_logo');
                    $image = time() . '.' . $requestImage->getClientOriginalExtension();
                    // Define the storage paths
                    $storagePath = 'site-settings/';
                    $thumbnailPath = 'public/site-settings/thumb/';
                    $largePath = 'public/site-settings/large/';

                    // Create the 'large' directory if it doesn't exist
                    if (!Storage::exists($largePath)) {
                        Storage::makeDirectory($largePath);
                    }
                    // Store the original image in 'public' storage
                    // Storage::putFileAs($storagePath, $requestImage, $image);
                    // Create a thumbnail
                    $thumbnail = Image::make($requestImage->path());
                    $thumbnail->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                    // Store the thumbnail in 'public' storage
                    Storage::put($thumbnailPath . $image, $thumbnail->stream());
                    // Store the original image in 'public' storage in the 'large' directory
                    Storage::putFileAs($largePath, $requestImage, $image);
                    // Update the image path in your database if needed
                    $requestData['header_logo'] = $image;
                }
                if ($request->hasFile('footer_logo')) {
                    $requestImage = $request->file('footer_logo');
                    $image = time() . '.' . $requestImage->getClientOriginalExtension();
                    // Define the storage paths
                    $storagePath = 'site-settings/';
                    $thumbnailPath = 'public/site-settings/thumb/';
                    $largePath = 'public/site-settings/large/';

                    // Create the 'large' directory if it doesn't exist
                    if (!Storage::exists($largePath)) {
                        Storage::makeDirectory($largePath);
                    }
                    // Store the original image in 'public' storage
                    // Storage::putFileAs($storagePath, $requestImage, $image);
                    // Create a thumbnail
                    $thumbnail = Image::make($requestImage->path());
                    $thumbnail->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // $thumbnailImage = time() . '_thumb.' . $requestImage->getClientOriginalExtension();
                    // Store the thumbnail in 'public' storage
                    Storage::put($thumbnailPath . $image, $thumbnail->stream());
                    // Store the original image in 'public' storage in the 'large' directory
                    Storage::putFileAs($largePath, $requestImage, $image);
                    // Update the image path in your database if needed
                    $requestData['footer_logo'] = $image;
                }
                $siteSetting->update($requestData);
                $response['error'] = false;
                $response['msg'] = 'The site setting was updated successfully!';
            }

        } catch ( Exception $ex ) {
            $response['error'] = true;
            $response['msg']   = $ex->getMessage();
            $this->log()->error( $response['msg'] );
        }
        return json_encode( $response );
    }
}
