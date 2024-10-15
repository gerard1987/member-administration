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
                        
                            <!-- Date of birth Input -->
                            <div class="form-group">
                                <label for="address">Date of birth:</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="<?= $member['date_of_birth']; ?>" class="form-control" required>
                            </div>

                            <!-- Family type Input -->
                            <div class="form-group">
                                <label for="name">Family type:</label>
                                <input type="text" id="name" name="name" value="<?= $member['family_type']; ?>" class="form-control" required>
                            </div>

                            <!-- Member type Input -->
                            <div class="form-group">
                                <label for="address">Member type:</label>
                                <input type="text" id="member_type_id" name="member_type_id" value="<?= $member["memberType"]["type"]; ?>" class="form-control" required>
                            </div>

                            <br>

                            <input type="hidden" id="member_id" name="member_id" value ="<?= $member['id']; ?>" class="form-control" required>
                            <input type="hidden" id="family_id" name="family_id" value ="<?= $member['family_id']; ?>" class="form-control" required>
                        
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-warning">Edit member</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title"><strong>Add contribution: </strong></h2>
                        <form action="{{ route('families.members.edit', ['family_id' => $member['family_id'], 'member_id' => $member['id']]) }}" method="POST">
                            @csrf
                            @method('POST')
                        
                            <!-- Amount Input -->
                            <div class="form-group">
                                <label for="name">amount:</label>
                                <input type="text" id="amount" name="amount" value="" class="form-control" required>
                            </div>

                            <!-- Fiscal years Input -->
                            <div class="form-group">
                                <label for="name">Fiscal year:</label>
                                <select name="fiscal_year" id="fiscal_year" class="form-control" required>
                                    @if (!empty($fiscalYears))
                                        @foreach ($fiscalYears as $fiscalYear)
                                            <option value="{{ $fiscalYear["id"] }}">{{ $fiscalYear["year"] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            
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
