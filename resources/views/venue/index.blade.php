@extends('layouts.main')

@section('content')
<div class="container-fluid mt-5 mb-5 px-4">
    <h1>Veranstaltungsort</h1>
    <a class="btn btn-secondary mb-2 mt-2" href="{{ route('venue.create') }}">Neuen Veranstaltungsort</a>

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        {{-- Maybe get Thead from DB --}}
        <thead>
            <tr>
                <th>Name</th>
                <th>Straße</th>
                <th>Hausnummer</th>
                <th>Stadt</th>
                <th>Postleitzahl</th>
                <th>Land</th>
                <th>Telefon</th>
                <th>E-mail</th>
                <th>Webseite</th>
                <th>Besitzer</th>
                <th>buchbar</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @if($venues ?? '')
                @foreach ($venues as $venue)
                    <tr>
                        <td>{{ $venue->name }}</td>
                        @foreach ($venue->addresses as $address)
                            <td>{{ $address->street }}</td>
                            <td>{{ $address->number }}</td>
                            <td>{{ $address->city }}</td>
                            <td>{{ $address->zip }}</td>
                            <td>{{ $address->country->country }}</td>
                        @endforeach
                        <td>{{ $venue->phone_number }}</td>
                        <td>{{ $venue->email }}</td>
                        <td>{{ $venue->website_url }}</td>
                        <td>{{ $venue->owner }}</td>
                        <td>{{ $venue->bookable == 1 ? 'Ja' : 'Nein' }}</td>

                        <td class="d-flex">
                            <button class="btn btn-primary mr-2">
                                <a style="text-decoration: none; color: white" href="">View</a>
                            </button>
                            <button class="btn btn-success mr-2">
                                <a style="text-decoration: none; color: white" href="/locations/{{ $venue->id }}/edit">Edit</a>
                            </button>
                        
                            <form action="/locations/{{ $venue->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection