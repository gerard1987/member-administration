<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family List</title>
</head>
<body>

    <h1>Families and Members</h1>

    @if($families->isEmpty())
        <p>No families found.</p>
    @else
        @foreach($families as $family)
            <div class="family-card">
                <h2>{{ $family->name }}</h2>
                <p><strong>Address:</strong> {{ $family->adress }}</p>

                @if($family->familyMembers->isEmpty())
                    <p>No family members found.</p>
                @else
                    <ul>
                        @foreach($family->familyMembers as $member)
                            <li>{{ $member->name }} ({{ $member->age }} years old)</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    @endif

</body>
</html>
