@if (session()->has('success'))
    <div class="alert alert-success mt-2">
        <p>{{ session('success') }}</p>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger mt-2">
        <p>{{ session('error') }}</p>
    </div>
@endif
