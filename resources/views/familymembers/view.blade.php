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
                                <label for="family_role">Family role:</label>
                                <select name="family_role" id="family_role" class="form-control" required>
                                    @foreach ($familyRoles as $familyRole)
                                        <option value="{{ $familyRole }}" @selected($familyRole == ($member['family_role'] ?? ''))>
                                            {{ $familyRole }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            <input type="hidden" id="member_id" name="member_id" value ="<?= $member['id']; ?>" class="form-control" required>
                            <input type="hidden" id="family_id" name="family_id" value ="<?= $member['family_id']; ?>" class="form-control" required>
                        
                            <!-- Submit Button -->
                            <?php if (\Auth::user()->name === 'secretary'): ?>
                            <button type="submit" class="btn btn-warning">Edit member</button>
                            <?php endif; ?>
                        </form>
                    </div>
                    <?php if (\Auth::user()->name === 'treasurer'): ?>
                    <div class="card-body">
                        <h2 class="card-title"><strong>Submit contribution paid: </strong></h2>
                        <form action="{{ route('families.members.add.contribution', ['family_id' => $member['family_id'], 'member_id' => $member['id']]) }}" method="POST">
                            @csrf
                            @method('POST')

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

                            <!-- Member type Input -->
                            <div class="form-group">
                                <label for="name">Member type:</label>
                                <select name="member_type" id="member_type" class="form-control" required>
                                    @if (!empty($memberTypes))
                                        @foreach ($memberTypes as $k => $memberType)
                                            <option value="{{ $memberType["id"] }}">{{ $memberType["type"] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <br>

                            <input type="hidden" id="member_id" name="member_id" value ="<?= $member['id']; ?>" class="form-control" required>
                            <input type="hidden" id="family_id" name="family_id" value ="<?= $member['family_id']; ?>" class="form-control" required>
                        
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    @endif

@endsection
