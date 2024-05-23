<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerControllerAPI extends Controller
{
    public function viewAll()
    {
        return Owner::all();
    }

    public function view($id)
    {
        $owner = Owner::find($id);

        if ( $owner == null)
        {
            return response()->json(['message' => 'owner not found'], 404);
        }
        else return $owner;
    }

    public function store(Request $request)
    {
        $owner = new Owner();
        $owner->name = $request->name;
        $owner->surname = $request->surname;
        $owner->phone = $request->phone;
        $owner->email = $request->email;
        $owner->address = $request->address;
        $owner->save();
        return $owner;
    }

    public function update(Request $request, $id)
    {
        $owner = Owner::find($id);
        if ($owner == null)
        {
            return response()->json(['message' => 'owner not found'], 404);
        }
        else{
            $owner->name = $request->name;
            $owner->surname = $request->surname;
            $owner->phone = $request->phone;
            $owner->email = $request->email;
            $owner->address = $request->address;
            $owner->save();
            return $owner;
        }
    }

    public function destroy($id)
    {
        $owner = Owner::find($id);
        if ($owner == null)
        {
            return response()->json(['message' => 'owner not found'], 404);
        }
        else{
            $owner->delete();
            return true;
        }
    }
}
