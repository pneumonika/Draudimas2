<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Owner;
use App\Models\CarImage;
use Illuminate\Http\Request;


class CarController extends Controller
{
    public function Validation($request)
    {
        $this->validationRules =
        [
            'reg_number'=> 'regex:/^[A-Z]{3}[0-9]{3}/i',
            'brand'=> 'required|min:3|max:32',
            'model'=> 'required|max:32',
            'owner_id'=> 'required',
        ];
        $this->validationMessages =
        [
            'reg_number'=> __('Valstybinių numerių formatas turi būti: ABC123'),
            'brand'=> __('Markė turi būti nuo :min iki :max simbolių ilgio', ['min' => 3, 'max' => 32]),
            'model'=> __('Modelis yra privalomas ir turi būti iki :max simbolių ilgio', ['min' => 3, 'max' => 32]),
            'owner_id'=> __('Savininkas yra privalomas'),
        ];
        $this->validate($request, $this->validationRules, $this->validationMessages);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('cars.index', ['cars'=>Car::with('owner')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create', ['owners'=>Owner::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->Validation($request);

        $car = Car::create($request->all());
        $car->save();

        return redirect()->route('cars.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', ['car'=>$car], ['owners'=>Owner::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $this->Validation($request);

        $car->update($request->all());

        if ($request->file('image') !== null)
        {
            $file = $request->file('image');

            $file->store('/images');

            $carImage = new CarImage;
            $carImage->image_file = $file->hashName();
            $carImage->image_name = $file->getClientOriginalName();
            $carImage->car_id = $car->id;
            $carImage->save();
        }

        return redirect()->route('cars.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index');
    }
}
