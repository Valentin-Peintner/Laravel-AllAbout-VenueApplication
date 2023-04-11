<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Yaml\Yaml;

class ApiVenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::with(['addresses.country'])->orderBy('name')->get();
        return response()->json($venues);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Validation 
        $data = ['id' => $id];
        $rules = [
            'id' => 'required|numeric|exists:venues,id'
        ];
        $messages = [
            'id' => [
                'required' => 'Die angeforderte Ressource ist erforderlich',
                'numeric' => 'Die angeforderte Ressource ist keine Zahl',
                'exists' => 'Die angeforderte Ressource ist keine Zahl'
            ]
        ];

        $validator = Validator::make($data, $rules, $messages);

        if($validator->fails()) {
            return response()->json($validator->messages(), 404);
        }

        $venue = Venue::with(['addresses.country'])->where('id', $id)->first();
        return response()->json($venue);
    }
}
