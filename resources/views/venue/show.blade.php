@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1>{{ $venue->name }}</h1>
                    <a class="btn btn-secondary mb-2 mt-2" href="{{route('venue.index') }}">Alle Veranstaltungsorte</a>
                </div>
                <div class="card-body">
                    <h2 class="card-title strong">Adresse</h2>
                    <ul class="list-group list-group-flush">
                        @foreach($venue->addresses as $address)
                            <li class="list-group-item">{{ $address->street }} {{ $address->number }}, {{ $address->zip }} {{ $address->city }}, {{ $address->country->country }}</li>
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
                {{-- <div id="map" style="width: 100%; height:300px;" onload="initMap()"></div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
