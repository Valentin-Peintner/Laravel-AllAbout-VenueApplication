@extends('layouts.main')

@section('content')
<div class="container-fluid mt-5 mb-5 px-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Veranstaltungsorte</h2>
        <a class="btn btn-secondary mb-2 mt-2 float-end" href="{{ route('venue.create') }}">Neuer Veranstaltungsort</a>
    </div>

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th class="w-25">Name</th>
                <th class="w-25">Stadt</th>
                <th class="w-25">Land</th>
                <th class="w-25">Aktionen</th>
            </tr>
        </thead>

        <tbody>
            @if($venues ?? '')
                @foreach ($venues as $venue)
                    <tr>
                        <td class="align-middle">{{ $venue->name }}</td>
                        @foreach ($venue->addresses as $address)
                            {{-- <td>{{ $address->street }}</td>
                            <td>{{ $address->number }}</td> --}}
                            <td class="align-middle">{{ $address->city }}</td>
                            {{-- <td>{{ $address->zip }}</td> --}}
                            <td class="align-middle">{{ $address->country->country }}</td>
                        @endforeach
                        {{-- <td>{{ $venue->phone_number }}</td>
                        <td>{{ $venue->email }}</td>
                        <td>{{ $venue->website_url }}</td>
                        <td>{{ $venue->bookable == 1 ? 'Ja' : 'Nein' }}</td> --}}

                        <td class="d-flex justify-content-center">
                            <button class="btn btn-primary mr-2">
                                <a style="text-decoration: none; color: white" href="{{ route('venue.show',$venue->id) }}"><i class="fa fa-eye"></i></a>
                            </button>
                            <button class="btn btn-success mr-2">
                                <a style="text-decoration: none; color: white" href="{{ route('venue.edit',$venue->id) }}"><i class="fa fa-pencil"></i>
                                </a>
                            </button>
                        
                            <form action="/venue/{{ $venue->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{-- Pagination --}}
    {{ $venues->links('pagination::bootstrap-4') }}
</div>
@endsection