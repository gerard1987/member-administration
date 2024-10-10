@extends('layouts.app')
@section('title', 'Family View')
@section('content')

    @if(empty($family))
        <p>No family found.</p>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title"><strong>Family:</strong> {{ $family['name'] }}</h2>
                        <p class="card-text"><strong>Address:</strong> {{ $family['adress']  }}</p>
                        <hr>
                        <h3>Members</h3>
                        <div class="d-flex align-items-center">
                                @foreach ($family['familyMembers'] as $member)
                                <div class="card mb-6 shadow-sm">
                                    <div class="card-body">
                                        <h2 class="card-title">{{ $member['name'] }}</h2>
                                        <p class="card-text"><strong>Birthday:</strong> {{ $member['date_of_birth']  }}</p>
                                        <p class="card-text"><strong>Member id:</strong> {{ $member['member_type_id']  }}</p>
                                        <p>
                                            <a href="{{ route('families.members.view', $member['id']) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ route('families.members.view', $member['id']) }}" class="btn btn-warning">Delete</a>
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
