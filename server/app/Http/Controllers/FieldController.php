<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{
    public function list()
    {
        return Field::all();
    }

    private function pairing($newField, $newFieldData)
    {
        $newField->municipality = $newFieldData->municipality;
        $newField->img = $newFieldData->img;
        $newField->dimension = $newFieldData->dimension;
        $newField->cadastral_sheet = $newFieldData->cadastral_sheet;
        $newField->cadastral_map = $newFieldData->cadastral_map;
        $newField->cadastral_parcel = $newFieldData->cadastral_parcel;
        $newField->ground_type = $newFieldData->ground_type;
        $newField->irrigation_type = $newFieldData->irrigation_type;
        $newField->offer_type = $newFieldData->offer_type;
        $newField->offer_fee = $newFieldData->offer_fee;
        $newField->availability = $newFieldData->availability;

        $newField->save();
        return $newField;
    }

    public function create(Request $request)
    {
        $newFieldData = json_decode($request->getContent());
        $newField = new Field();

        $newField = $this->pairing($newField, $newFieldData);
        return $newField;
    }

    public function edit(Request $request, $id)
    {
        $field = Field::find($id);
        $newFieldData = json_decode($request->getContent());

        $field = $this->pairing($field, $newFieldData);
        return $field;
    }

    public function view($id)
    {
        return Field::find($id);
    }
}
