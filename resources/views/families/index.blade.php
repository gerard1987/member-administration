@extends('layouts.app')
@section('title', 'Family overview')
@section('content')

    <h1>Families and Members</h1>
    <hr>

    @if($families->isEmpty())
        <p>No families found.</p>
    @else
        <div class="row">
            @foreach($families as $family)
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title">{{ $family['name'] }}</h2>
                            <p class="card-text"><strong>Address:</strong> {{ $family['adress'] }}</p>
                            <p>
                                <a href="{{ route('families.view', $family['id']) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('families.view', $family['id']) }}" class="btn btn-warning">Delete</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
