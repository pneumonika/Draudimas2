<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;


class OwnerController extends Controller
{
    public function Validation($request)
    {
        $this->validationRules =
            [
                'name' => 'required|min:3|max:32',
                'surname' => 'required|min:5|max:32',
                'phone' => 'max:32|numeric',
                'email' => 'required|unique:owners|min:7|max:64',
                'address' => 'required|max:100',
            ];
        $this->validationMessages =
            [
                'name' => __('Vardas turi būti nuo :min iki :max simbolių ilgio', ['min' => 3, 'max' => 32]),
                'surname' => __('Pavardė turi būti nuo :min iki :max simbolių ilgio', ['min' => 5, 'max' => 32]),
                'phone' => __('Telefono numeris turi būti sudarytas iš skaičių ir ne ilgesnis nei :max simboliai', ['max' => 32]),
                'email' => __('El. paštas turi būti unikalus ir nuo :min iki :max simbolių ilgio', ['min' => 7, 'max' => 64]),
                'address' => __('Adresas turi būti iki :max simbolių ilgio', ['max' => 100]),
            ];
        $this->validate($request, $this->validationRules, $this->validationMessages);
    }
    //
    public function create()
    {
        return view("owner.create");
    }
    public function store(Request $request)
    {
        $this->Validation($request);

        $owner = new Owner();
        $owner->name = $request->name;
        $owner->surname = $request->surname;
        $owner->phone = $request->phone;
        $owner->email = $request->email;
        $owner->address = $request->address;
        $owner->save();
        return redirect()->route('owner.index');
    }

    public function index(Request $request)
    {
        return view('owner.index', ['owners' => Owner::all()]);
    }

    public function edit($id)
    {
        $owner = Owner::find($id);
        return view('owner.edit', ['owner' => $owner]);
    }
    public function save($id, Request $request)
    {
        $this->Validation($request);

        $owner = Owner::find($id);
        $owner->name = $request->name;
        $owner->surname = $request->surname;
        $owner->phone = $request->phone;
        $owner->email = $request->email;
        $owner->address = $request->address;
        $owner->save();
        return redirect()->route('owner.index');
    }

    public function delete($id)
    {
        Owner::destroy($id);
        return redirect()->route('owner.index');
    }
}
