@extends('layouts.main')

@section('content')
<div class="container-fluid mt-5 mb-5 px-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <h2>Veranstaltungsorte</h2>
        <a class="btn btn-secondary mb-2 mt-2 float-end" href="{{ route('venues.create') }}">Neuer Veranstaltungsort</a>
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
                                <td class="align-middle">{{ $address->city }}</td>
                                <td class="align-middle">{{ $address->country->country }}</td>
                            @endforeach
                            <td class="d-flex justify-content-center">
                                {{-- Show --}}
                                <button class="btn btn-primary mr-2">
                                    <a style="text-decoration: none; color: white" href="{{ route('venues.show',$venue->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </button>
                                {{-- Edit --}}
                                <button class="btn btn-success mr-2">
                                    <a style="text-decoration: none; color: white" href="{{ route('venues.edit',$venue->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </button>
                            
                                {{-- Destroy --}}
                                <form action="{{ route('venues.destroy', $venue->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$venue->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                
                                    <!-- Modal Box -->
                                    <div class="modal fade" id="deleteModal-{{$venue->id}}" tabindex="-1" aria-labelledby="deleteModalLabel-{{$venue->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{$venue->id}}">{{$venue->name}} löschen</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Willst du wirklich diesen Veranstaltungsort löschen?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                                    <button type="submit" class="btn btn-danger">Löschen</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{-- Pagination --}}
    {{ $venues->links('pagination::bootstrap-4') }}
</div>
@endsection