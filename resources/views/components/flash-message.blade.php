@if(session('status'))
    @php
        $type = session('status')['type'] ?? 'info';
        $message = session('status')['message'] ?? session('status');
    @endphp

    <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif