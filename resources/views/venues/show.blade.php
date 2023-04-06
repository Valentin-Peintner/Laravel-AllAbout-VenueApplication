@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1>{{ $venue->name }}</h1>
                    <a class="btn btn-secondary mb-2 mt-2" href="{{route('venues.index') }}">Alle Veranstaltungsorte</a>
                </div>
                <div class="card-body">
                    <h2 class="card-title strong">Adresse</h2>
                    <ul class="list-group list-group-flush">
                        @foreach($venue->addresses as $address)
                            <li class="list-group-item">{{ $address->street }} {{ $address->number }}, {{ $address->zip }} {{ $address->city }}, {{ $address->country->country }}</li>
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
                {{-- Maps einbinden --}}
                <div id="map" style="height:300px;"></div>
            </div>
        </div>
    </div>
</div>

{{-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{env('MIX_GOOGLE_MAPS_API_KEY')}}"></script> --}}
{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3cB7r9fDyaX40V8Kbp8XELqSlwwd6fD4&callback=initMap"></script> --}}

{{-- Show Map | Javascript Code, soll ich einen eigene Datei dafür anlegen --}}
{{-- <script>
    function initMap() {
        // create map object
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: {{ $address->latitude }}, lng: {{ $address->longitude }}},
            zoom: 12
        });

        // create marker object
        var marker = new google.maps.Marker({
            position: {lat: {{ $address->latitude }}, lng: {{ $address->longitude }}},
            map: map,
            title: 'Your Event Location'
        });
    }
  </script> --}}
  
  <script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&callback=initMap"></script>
@endsection
