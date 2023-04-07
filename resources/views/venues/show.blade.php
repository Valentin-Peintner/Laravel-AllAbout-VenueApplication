@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex flex-wrap justify-content-between">
                    <h1>{{ $venue->name }}</h1>
                    <a class="btn btn-secondary mb-2 mt-2" href="{{route('venues.index') }}">Alle Veranstaltungsorte</a>
                </div>
                <div class="card-body">
                    <h2 class="card-title strong">Adresse</h2>
                    <ul class="list-group list-group-flush">
                        @foreach($venue->addresses as $address)
                            <li class="list-group-item">{{ $address->street }} {{ $address->number }}, {{ $address->zip }} {{ $address->city }}, {{ $address->country->country }}</li>
                            {{-- Hidden input for Jquery --}}
                            <input id="longitude" type="hidden" name="longitude" value="{{ $address->longitude}}" />
                            <input id="latitude"  type="hidden" name="latitude" value="{{ $address->latitude}}" />
                        @endforeach
                    </ul>
                    <h2 class="card-title mt-4">Details</h2>
                    <ul class="list-group">
                         <li class="list-group-item">Telefon: {{$venue->country_code}} {{ $venue->phone_number }}</li>
                        <li class="list-group-item">Email: {{ $venue->email }}</li>
                        <li class="list-group-item">Webseite: {{ $venue->website_url }}</li>
                        <li class="list-group-item">Besitzer: {{ $venue->owner }}</li>
                        <li class="list-group-item">Buchbar für Veranstaltungen: {{ $venue->bookable == 1 ? 'Ja' : 'Nein' }}</li>
                    </ul>
                </div>
                
                {{-- Googel Maps --}}
                <div id="map" style="height:300px;"></div>
            </div>
        </div>
    </div>
</div>

{{-- Google Maps einbinden --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap"></script>
@endsection
