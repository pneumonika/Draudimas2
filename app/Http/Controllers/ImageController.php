<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function imageView($id)
    {
        $image = CarImage::find($id);

        $path = storage_path("app/images/".$image->image_file);

        // Create a response and set the content type and disposition
        return response()->file($path, [
            'Content-Type' => 'image/*',
            'Content-Disposition' => 'inline; filename="'.$image->image_name.'"'
        ]);
    }

    public function imageDownload($id)
    {
        $image = CarImage::find($id);

        return response()->download(storage_path()."/app/images/".$image->image_file, $image->image_name);
    }

    public function imageDownloadAll($id)
    {
        $car = Car::find($id);
        $zip = new \ZipArchive();
        $zipFileName = $car->brand . '_' . $car->model . '.zip';
        //$zipFileName = time() . '.zip';
        $zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        foreach ($car->images as $image) {
            $path = storage_path("app/images/".$image->image_file);
            $zip->addFile($path, $image->image_name);
        }

        $zip->close();

        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }

    public function imageDelete($id)
    {
        $image = CarImage::find($id);

        unlink(storage_path()."/app/images/".$image->image_file);

        $image->delete();

        return redirect()->route('cars.edit',$image->car_id);
    }
}
