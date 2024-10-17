@extends('layouts.app')
@section('title', 'Family overview')
@section('content')

    <h1>Families and Members</h1>
    <hr>

    <?php if (\Auth::user()->name === 'secretary'): ?>
    <h3>Create family</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-12 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('families.create') }}" method="POST">
                        @csrf
                        @method('POST')
                    
                        <!-- Family Name Input -->
                        <div class="form-group">
                            <label for="name">Family Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                    
                        <!-- Address Input -->
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" id="adress" name="adress" class="form-control" required>
                        </div>
                        <br>
                    
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-warning">Create Family</button>
                    </form>
                </div>            
            </div>
        </div>
    </div>
    <?php endif; ?>
    <br>

    @if($families->isEmpty())
        <p>No families found.</p>
    @else
        <h3>Overview</h3>
        <div class="row">
            @foreach($families as $family)
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex col-md-12">
                                <div class="col-md-8">
                                    <h2 class="card-title">{{ $family['name'] }}</h2>
                                    <p class="card-text"><strong>Address:</strong> {{ $family['adress'] }}</p>
                                </div>
                                <div class="d-flex flex-wrap col-md-4">
                                    <p>Contributie: €<?= $family->getTotalContributions(); ?></p>
                                    <div class="d-flex flex-wrap align-items-end col-md-12">
                                        <div class="col-md-4">
                                            <p class="mb-0"><a href="{{ route('families.view', $family['id']) }}" class="btn btn-primary">View</a></p>
                                        </div>
                                        <?php if (\Auth::user()->name === 'secretary'): ?>
                                        <div class="col-md-8">
                                            <form action="{{ route('families.delete', $family['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this family?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning text-nowrap">Delete Family</button>
                                            </form>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
