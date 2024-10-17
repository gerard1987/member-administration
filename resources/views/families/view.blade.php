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

                        <h3>Edit family</h3>
                        <div class="row">
                            <form action="{{ route('families.edit', ['id' => $family['id']]) }}" method="POST">
                                @csrf
                                @method('POST')
                            
                                <!-- Name Input -->
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" value="<?= $family['name']; ?>" class="form-control" required>
                                </div>
                            
                                <!-- Address Input -->
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" id="adress" name="adress" value="<?= $family['adress']; ?>" class="form-control" required>
                                </div>
    
                                <br>
    
                                <input type="hidden" id="family_id" name="family_id" value ="<?= $family['id']; ?>" class="form-control" required>
                            
                                <?php if (\Auth::user()->name === 'secretary'): ?>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-warning">Edit family</button>
                                <?php endif; ?>
                            </form>
                        </div>
                        
                        <hr>

                        <?php if (\Auth::user()->name === 'secretary'): ?>
                        <h3>Add member</h3>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-12 shadow-sm">
                                    <div class="card-body">
                                        <form action="{{ route('families.create.member', $family['id']) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                        
                                            <!-- Name Input -->
                                            <div class="form-group">
                                                <label for="name">Name:</label>
                                                <input type="text" id="name" name="name" class="form-control" required>
                                            </div>
                                        
                                            <!-- Address Input -->
                                            <div class="form-group">
                                                <label for="address">Date of birth:</label>
                                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required>
                                            </div>
                                            
                                            <!-- Family roles Input -->
                                            <div class="form-group">
                                                <label for="name">Family role:</label>
                                                <select name="family_role" id="family_role" class="form-control" required>
                                                    @if (!empty($familyRoles))
                                                        @foreach ($familyRoles as $k => $role)
                                                            <option value="{{ $role }}">{{ $role }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <br>

                                            <input type="hidden" id="family_id" name="family_id" value ="<?= $family['id']; ?>" class="form-control" required>
                                        
                                            <!-- Submit Button -->
                                            <button type="submit" class="btn btn-warning">Create family member</button>
                                        </form>
                                    </div>            
                                </div>
                            </div>
                        </div>
                        <br>

                        <hr>
                        <?php endif; ?>

                        <h3>Members</h3>
                        <div class="d-flex align-items-center">
                                @foreach ($family['familyMembers'] as $member)
                                <div class="card mb-6 shadow-sm">
                                    <div class="card-body">
                                        <h2 class="card-title">{{ $member['name'] }}</h2>
                                        <p class="card-text"><strong>Birthday:</strong> {{ $member['date_of_birth']  }}</p>
                                        <p class="card-text"><strong>Family type:</strong> {{ $member['family_role']  }}</p>
                                        <p>
                                            <a href="{{ route('families.members.view',  [$family['id'], $member['id']]) }}" class="btn btn-primary">View</a>
                                            <?php if (\Auth::user()->name === 'secretary'): ?>
                                            <form action="{{ route('families.members.delete', [$family['id'], $member['id']]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning">Delete</button>
                                            </form>
                                            <?php endif; ?>
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
