<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function imageView($id, Request $request)
    {
        $image = CarImage::find($id);

        $car = Car::find($image->car_id);
        if ($request->user()->can('view-image', $car))
        {
            $path = storage_path("app/images/".$image->image_file);

            // Create a response and set the content type and disposition
            return response()->file($path, [
                'Content-Type' => 'image/*',
                'Content-Disposition' => 'inline; filename="'.$image->image_name.'"'
            ]);
        }
        else
        {
            return redirect()->route('cars.index');
        }
    }

    public function imageDownload($id, Request $request)
    {
        $image = CarImage::find($id);

        $car = Car::find($image->car_id);
        if ($request->user()->can('view-image', $car))
        {
            return response()->download(storage_path()."/app/images/".$image->image_file, $image->image_name);
        }
        else
        {
            return redirect()->route('cars.index');
        }
    }

    public function imageDownloadAll($id)
    {
        $car = Car::with('images')->find($id);

        $this->authorize('update', $car);

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

    public function imageDelete($id, Request $request)
    {
        $image = CarImage::find($id);

        $car = Car::find($image->car_id);
        if ($request->user()->can('view-image', $car))
        {
            unlink(storage_path()."/app/images/".$image->image_file);

            $image->delete();

            return redirect()->route('cars.edit',$image->car_id);
        }
        else
        {
            return redirect()->route('cars.index');
        }
    }
}
