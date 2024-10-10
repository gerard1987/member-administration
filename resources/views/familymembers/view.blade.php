@extends('layouts.app')
@section('title', 'Family View')
@section('content')

    @if(empty($member))
        <p>No member found.</p>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title"><strong>Member name:</strong> {{ $member['name'] }}</h2>
                        <p class="card-text"><strong>Birthday:</strong> {{ $member['date_of_birth']  }}</p>
                        <p class="card-text"><strong>Member id:</strong> {{ $member['member_type_id']  }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
