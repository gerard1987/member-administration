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
                        <h2 class="card-title"><strong>Member: </strong> {{ $member['name'] }}</h2>
                        <form action="{{ route('families.members.edit', ['family_id' => $member['family_id'], 'member_id' => $member['id']]) }}" method="POST">
                            @csrf
                            @method('POST')
                        
                            <!-- Name Input -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" value="<?= $member['name']; ?>" class="form-control" required>
                            </div>
                        
                            <!-- Address Input -->
                            <div class="form-group">
                                <label for="address">Date of birth:</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="<?= $member['date_of_birth']; ?>" class="form-control" required>
                            </div>

                            <!-- Address Input -->
                            <div class="form-group">
                                <label for="address">Member type id:</label>
                                <input type="number" id="member_type_id" name="member_type_id" value="<?= $member['member_type_id']; ?>" class="form-control" required>
                            </div>

                            <br>

                            <input type="hidden" id="member_id" name="member_id" value ="<?= $member['id']; ?>" class="form-control" required>
                            <input type="hidden" id="family_id" name="family_id" value ="<?= $member['family_id']; ?>" class="form-control" required>
                        
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-warning">Edit member</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
