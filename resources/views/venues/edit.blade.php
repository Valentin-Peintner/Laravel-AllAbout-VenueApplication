@extends('layouts.main')

@section('content')


<div class="container-fluid mt-5 mb-5 px-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <h2>Veranstaltungsort bearbeiten</h2>
        <a class="btn btn-secondary mb-2 mt-2" href="{{route('venues.index') }}">Alle Veranstaltungsorte</a>
    </div>

    <form action="{{ route('venues.update',$venue->id)}} " method="POST" class="mt-5">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                {{-- Name --}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$venue->name) }}">

                    {{-- Error message --}}
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @foreach($venue->addresses as $address)
                {{-- Street --}}
                <div class="form-group">
                    <label for="street">Straße</label>
                    <input type="text" name="street" id="street" class="form-control @error('street') is-invalid @enderror" value="{{ old('street',$address->street) }}">

                    {{-- Error message --}}
                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Number --}}
                <div class="form-group">
                    <label for="number">Hausnummer</label>
                    <input type="text" name="number" id="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number',$address->number) }}">

                    {{-- Error message --}}
                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- City --}}
                <div class="form-group">
                    <label for="city">Stadt</label>
                    <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city',$address->city) }}">

                    {{-- Error message --}}
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Zip --}}
                <div class="form-group">
                    <label for="zip">Postleitzahl</label>
                    <input type="text" name="zip" id="zip" class="form-control @error('zip') is-invalid @enderror" value="{{ old('zip',$address->zip) }}">

                    {{-- Error message --}}
                    @error('zip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @endforeach
            </div>

            <div class="col-md-6">
                {{-- Country --}}
                <div class="form-group">
                    <label for="country_id">Land</label>
                    <select name="country_id" id="country_id" class="form-control">
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ $address->country_id == $country->id ? 'selected' : '' }}>{{ $country->country }}</option>
                        @endforeach
                    </select>
                </div>
               
                {{-- Phone --}}
                <div class="form-group">
                    <label for="phone_number">Telefon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <select class="form-control" name="country_code">
                                <option value="+43" {{ $venue->country_code == '+43' ? 'selected' : '' }}>+43</option>
                                <option value="+49" {{ $venue->country_code == '+49' ? 'selected' : '' }}>+49</option>
                                <option value="+41" {{ $venue->country_code == '+41' ? 'selected' : '' }}>+41</option>
                            </select>
                        </div>
                    <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number',$venue->phone_number) }}">

                    {{-- Error message --}}
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- E-Mail --}}
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$venue->email) }}">

                    {{-- Error message --}}
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- URL --}}
                <div class="form-group">
                    <label for="website_url">Webseite</label>
                    <input type="url" name="website_url" id="website_url" class="form-control @error('website_url') is-invalid @enderror" value="{{ old('website_url',$venue->website_url) }}">

                    {{-- Error message --}}
                    @error('website_url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Owner --}}
                <div class="form-group">
                    <label for="owner">Besitzer</label>
                    <input type="text" name="owner" id="owner" class="form-control @error('owner') is-invalid @enderror" value="{{ old('owner',$venue->owner) }}">

                    {{-- Error message --}}
                    @error('owner')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Bookable for Events --}}
                <div class="form-group">
                    <label for="bookable">Buchbar für Veranstaltungen</label>
                    <select name="bookable" id="bookable" class="form-control">
                        <option value="0" {{ $venue->bookable == 0 ? 'selected' : '' }}>Nein</option>
                        <option value="1" {{ $venue->bookable == 1 ? 'selected' : '' }}>Ja</option>
                    </select>
                </div>
            
                <button type="submit" class="btn btn-primary">Ändern</button>
    </form>
</div>
@endsection