<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarControllerAPI extends Controller
{

    public function viewAll()
    {
        return Car::all();
    }

    public function view($id)
    {
        $car = Car::find($id);

        if ( $car == null)
        {
            return response()->json(['message' => 'car not found'], 404);
        }
        else return $car;
    }

    public function store(Request $request)
    {
        $car = new Car();
        $car->reg_number = $request->reg_number;
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->owner_id = $request->owner_id;
        $car->save();
        return $car;
    }

    public function update(Request $request, $id)
    {
        $car = Car::find($id);
        if ($car == null)
        {
            return response()->json(['message' => 'car not found'], 404);
        }
        else{
            $car->reg_number = $request->reg_number;
            $car->brand = $request->brand;
            $car->model = $request->model;
            $car->owner_id = $request->owner_id;
            $car->save();
            return $car;
        }
    }

    public function destroy($id)
    {
        $car = Car::find($id);
        if ($car == null)
        {
            return response()->json(['message' => 'car not found'], 404);
        }
        else{
            $car->delete();
            return true;
        }
    }
}
