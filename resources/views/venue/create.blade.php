@extends('layouts.main')

@section('content')

<div class="container-fluid mt-5 px-4">
    <h1>Veranstaltungsort anlegen</h1>
    <div class="button"><a href="{{route('venue.index') }}" class="btn btn-outline-secondary mt-2 mb-2">Alle Veranstaltungsorte</a></div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ihre Angaben sind nicht korrekt!<br><br>
            <ul>
                @foreach ( $errors->all() as $error )
                <li>{{ __('Fehler: ') }}{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('venue.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="street">Straße</label>
                    <input type="text" name="street" id="street" class="form-control">
                </div>
                <div class="form-group">
                    <label for="number">Hausnummer</label>
                    <input type="text" name="number" id="number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="city">Stadt</label>
                    <input type="text" name="city" id="city" class="form-control">
                </div>
                <div class="form-group">
                    <label for="zip">Postleitzahl</label>
                    <input type="text" name="zip" id="zip" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country_id">Land</label>
                    <select name="country_id" id="country_id" class="form-control">      
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone_number">Telefon</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="website_url">Webseite</label>
                    <input type="url" name="website_url" id="website_url" class="form-control">
                </div>
                <div class="form-group">
                    <label for="owner">Besitzer</label>
                    <input type="text" name="owner" id="owner" class="form-control">
                </div>
                <div class="form-group">
                    <label for="bookable">Buchbar</label>
                    <select name="bookable" id="bookable" class="form-control">
                        <option value="0">Nein</option>
                        <option value="1">Ja</option>
                    </select>
                </div>
            <button type="submit" class="btn btn-primary">Erstellen</button>
        </form>
    </div>
@endsection