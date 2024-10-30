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
                        <h3>Age: <?= $member->getAge(); ?></h3>
                        <h3>Contribution paid: €<?= $member->getTotalContribution(); ?></h3>
                        <form action="{{ route('families.members.edit', ['family_id' => $member->family_id, 'member_id' => $member->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                        
                            <!-- Name Input -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" value="<?= $member->name; ?>" class="form-control" required>
                            </div>
                        
                            <!-- Date of birth Input -->
                            <div class="form-group">
                                <label for="address">Date of birth:</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="<?= $member->date_of_birth; ?>" class="form-control" required>
                            </div>

                            <!-- Family type Input -->
                            <div class="form-group">
                                <label for="family_role">Family role:</label>
                                <select name="family_role" id="family_role" class="form-control" required>
                                    @foreach ($familyRoles as $familyRole)
                                        <option value="{{ $familyRole }}" @selected($familyRole == ($member->family_role ?? ''))>
                                            {{ $familyRole }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            <input type="hidden" id="member_id" name="member_id" value ="<?= $member['id']; ?>" class="form-control" required>
                            <input type="hidden" id="family_id" name="family_id" value ="<?= $member['family_id']; ?>" class="form-control" required>
                        
                            <!-- Submit Button -->
                            @if (\Auth::user()->name === 'secretary')
                            <button type="submit" class="btn btn-warning">Edit member</button>
                            @endif
                        </form>
                    </div>
                    @if (\Auth::user()->name === 'treasurer')
                    <div class="card-body">
                        <h2 class="card-title"><strong>Add contribution: </strong></h2>
                        <form action="{{ route('families.members.add.contribution', ['family_id' => $member->family_id, 'member_id' => $member->id]) }}" method="POST">
                            @csrf
                            @method('POST')

                            <!-- Fiscal years Input -->
                            <div class="form-group">
                                <label for="name">Fiscal year:</label>
                                <select name="fiscal_year" id="fiscal_year" class="form-control" required>
                                    @if (!empty($fiscalYears))
                                        @foreach ($fiscalYears as $fiscalYear)
                                            <option value="{{ $fiscalYear->id }}">{{ $fiscalYear->year }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Member type Input -->
                            <div class="form-group">
                                <label for="name">Member type:</label>
                                <select name="member_type" id="member_type" class="form-control" required>
                                    @if (!empty($memberTypes))
                                        @foreach ($memberTypes as $k => $memberType)
                                            <option value="{{ $memberType->id }}">
                                                {{ $memberType->type }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <br>

                            <input type="hidden" id="member_id" name="member_id" value ="<?= $member->id; ?>" class="form-control" required>
                            <input type="hidden" id="family_id" name="family_id" value ="<?= $member->family_id; ?>" class="form-control" required>
                        
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </form>
                    </div>

                    <div class="card-body">
                        <h4>Contributions</h4>

                        @if ($member->contributions->isEmpty())
                            <p>No contributions found.</p>
                        @else
                            @foreach ($member->contributions as $contribution)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- MemberType -->
                                            <div class="col-6 col-md-3">
                                                <strong>Member type:</strong> 
                                                <p>{{ $contribution->memberType->type }}</p>
                                            </div>
            
                                            <!-- Amount -->
                                            <div class="col-6 col-md-3">
                                                <strong>Amount:</strong> 
                                                <p>€{{ $contribution->amount }}</p>
                                            </div>
            
                                            <!-- Fiscal Year -->
                                            <div class="col-6 col-md-3">
                                                <strong>Fiscal Year:</strong> 
                                                <p>{{ $contribution->fiscalYear->year ?? 'N/A' }}</p>
                                            </div>
            
                                            <!-- Date -->
                                            <div class="col-6 col-md-3">
                                                <strong>Date:</strong> 
                                                <p>{{ $contribution->created_at->format('d-m-Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p>
                                                <form action="{{ route('families.members.delete.contribution', ['family_id' => $member->family_id, 'member_id' => $member->id, 'contribution_id' => $contribution->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this contribution?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    
                                                    <button type="submit" class="btn btn-warning">Delete</button>
                                                </form>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>                  
                    @endif

                    <br>
                    <div class="card-body">
                        <button onclick="window.history.back();" class="btn btn-secondary">Back</button>
                    </div>

                </div>
            </div>
        </div>
    @endif

@endsection
