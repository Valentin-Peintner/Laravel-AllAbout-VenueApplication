<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::with(['addresses.country'])->get();
        // dd($venues);
        return view('venue.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('venue.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Input Validation
        $request->validate([
            'name' => 'required|max:50',
            'street' => 'required|max:100',
            'number' => 'required|numeric',
            'city' => 'required|max:255',
            'zip' => 'required|numeric',
            'country_id' => 'exists:countries,id',
            'venue_id' => 'exists:venues,id',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|max:255',
            'website_url' => 'required|url|max:255',
            'owner' => 'required|max:255',
            'bookable' => 'required|boolean'
        ]);

        // Get Country ID
        $country = Country::find($request->country_id);
    
        // Create new Venue
        $venue = new Venue;
        $venue->name = $request->name;
        $venue->phone_number = $request->phone_number;
        $venue->email = $request->email;
        $venue->website_url = $request->website_url;
        $venue->owner = $request->owner;
        $venue->bookable = $request->bookable;
        $venue->save();

        // Create new Address
        $address = new Address;
        $address->country_id = $country->id;
        $address->venue_id = $venue->id;
        $address->street = $request->street;
        $address->number = $request->number;
        $address->city = $request->city;
        $address->zip = $request->zip;
    
        $venue->addresses()->save($address);

        // Redirect to Index-Page
        return redirect()->route('venue.index')->with('success', 'Veranstaltungsort '.$request->name.' wurde angelegt!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
