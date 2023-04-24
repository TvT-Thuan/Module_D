@extends('Admin.Layouts.main')
@section('main')
    @include('Admin.Layouts.sidebar')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        @include('Admin.Layouts.nav')
        <div class="mb-3 pt-3 pb-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h2 class="h4">Create new area</h2>
            </div>
        </div>

        <form class="needs-validation" novalidate action="{{ route('admin.campaigns.areas.store', $campaign->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName"
                        name="name" placeholder="" value="{{ old('name') }} " />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary" type="submit">Save area</button>
            <a href="{{ route('admin.campaigns.show', $campaign->id) }}" class="btn btn-link">Cancel</a>
        </form>

    </main>
@endsection
