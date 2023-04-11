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
        $venues = Venue::with(['addresses.country'])->orderBy('name')->paginate(5);
        return view('venues.index', compact('venues'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('venues.create', compact('countries'));
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
            'name' => 'required|max:50|unique:venues,name',
            'street' => 'required|string|regex:/^[a-zA-ZßÄÖÜäöü -]+$/|max:50',
            'number' => 'required|regex:/^\d+[a-zA-Z]?(?:\/[\d\w]+)?(?:\s?[\/ -]\s?\d+[a-zA-Z]*)?$/u',
            'city' => 'required|max:50|regex:/^[a-zA-ZßÄÖÜäöü -]+$/',
            'zip' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
            'country_code' => 'required',
            'phone_number' => 'required|numeric|digits_between:9,10',
            'email' => 'required|email|max:50',
            'website_url' => 'required|url|max:50',
            'owner' => 'required|string|regex:/^[a-zA-ZÄÖÜäöü .-]+$/|max:50',
            'bookable' => 'required|boolean'
        ]);

        // Get Country ID
        $country = Country::find($request->country_id);

        // Geo Api Request
        $addressData = [
            'street' => $request->street,
            'number' => $request->number,
            'city' => $request->city,
            'zip' => $request->zip,
            'country' => $country->country
        ];

        // URL 
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode(http_build_query($addressData)) . "&key=AIzaSyC3cB7r9fDyaX40V8Kbp8XELqSlwwd6fD4";
     
        // Open URL with curl_init & save answer in $response 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($response);

        // If no results found
        if (! isset($json->results) || count($json->results) <= 0) {
            return redirect()->back()->withErrors(['street' => 'Diese Adresse gibt es nicht.',])->withInput();
        }

        // Create new Venue
        $venue = new Venue;
        $venue->name = $request->name;
        $venue->country_code = $request->country_code;
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
        
        // Add Latitude and Longitude to DB Table addresses
        $address->latitude = $json->results[0]->geometry->location->lat;
        $address->longitude = $json->results[0]->geometry->location->lng;
        $address->save();

        // Redirect to Index-Page
        return redirect()->route('venues.index')->with('success', 'Veranstaltungsort '.$request->name.' wurde angelegt!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venue = Venue::with(['addresses.country'])->findOrFail($id);
        return view('venues.show', compact('venue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venue = Venue::with(['addresses.country'])->findOrFail($id);
        $countries = Country::all();
        return view('venues.edit', compact('venue','countries'));
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
        // Input Validation
        $request->validate([
            'name' => 'required|max:50|unique:venues,name,' . $id,
            'street' => 'required|string|regex:/^[a-zA-ZßÄÖÜäöü -]+$/|max:50',
            'number' => 'required|regex:/^\d+[a-zA-Z]?(?:\/[\d\w]+)?(?:\s?[\/ -]\s?\d+[a-zA-Z]*)?$/u',
            'city' => 'required|max:50|regex:/^[a-zA-ZßÄÖÜäöü -]+$/',
            'zip' => 'required|numeric',
            'country_id' => 'required|exists:countries,id',
            'country_code' => 'required',
            'phone_number' => 'required|numeric|digits_between:9,10',
            'email' => 'required|email|max:50',
            'website_url' => 'required|url|max:50',
            'owner' => 'required|string|regex:/^[a-zA-ZÄÖÜäöü .-]+$/|max:50',
            'bookable' => 'required|boolean'
        ]);

        // Get Country ID
        $country = Country::find($request->country_id);

        // Geo Api Request
        $addressData = [
            'street' => $request->street,
            'number' => $request->number,
            'city' => $request->city,
            'zip' => $request->zip,
            'country' => $country->country
        ];

        // Open URL with curl_init & save answer in $response 
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode(http_build_query($addressData)) . "&key=AIzaSyC3cB7r9fDyaX40V8Kbp8XELqSlwwd6fD4";
     
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($response);

        // If no results found
        if (! isset($json->results) || count($json->results) <= 0) {
            return redirect()->back()->withErrors(['street' => 'Diese Adresse gibt es nicht.',])->withInput();
        }
    
        // Update Venue
        $venue = Venue::findOrFail($id);
        $venue->name = $request->name;
        $venue->country_code = $request->country_code;
        $venue->phone_number = $request->phone_number;
        $venue->email = $request->email;
        $venue->website_url = $request->website_url;
        $venue->owner = $request->owner;
        $venue->bookable = $request->bookable;
        $venue->save();

        // Update Address
        $address = $venue->addresses->first();
        $address->country_id = $country->id;
        $address->venue_id = $venue->id;
        $address->street = $request->street;
        $address->number = $request->number;
        $address->city = $request->city;
        $address->zip = $request->zip;  
        
        // Update Latitude and Longitude to DB Table addresses
        $address->latitude = $json->results[0]->geometry->location->lat;
        $address->longitude = $json->results[0]->geometry->location->lng;
        $address->save();

        // Redirect to Index-Page
        return redirect()->route('venues.index')->with('success', 'Veranstaltungsort '.$request->name.' wurde aktualisert!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venue = Venue::findorFail($id);

        // First delete the addresses associated with the venue ID
        $venue->addresses()->where('venue_id', $id)->delete();
        
        // Then delete Venue
        $venue->delete();

        return redirect()->route('venues.index')->with('success', 'Veranstaltungsort '.$venue->name.' wurde gelöscht!');
    }
}
