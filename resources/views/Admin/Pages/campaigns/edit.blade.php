@extends('Admin.Layouts.main')
@section('main')
    @include('Admin.Layouts.sidebar')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="border-bottom mb-3 pt-3 pb-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h1 class="h2">{{ $campaign->name }}</h1>
            </div>
        </div>

        <form class="needs-validation" novalidate action="{{ route('admin.campaigns.update' ,$campaign->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputName">Name</label>
                    <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName"
                        name="name" placeholder="" value="{{ $campaign->name }} " />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputSlug">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="inputSlug"
                        name="slug" placeholder="" value="{{ $campaign->slug }}" />
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputDate">Date</label>
                    <input type="text" class="form-control @error('date') is-invalid @enderror" id="inputDate"
                        name="date" placeholder="yyyy-mm-dd" value="{{ $campaign->format_date }}" />
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="mb-4" />
            <button class="btn btn-primary" type="submit">Save campaign</button>
            <a href="{{ route('admin.campaigns.index') }}" class="btn btn-link">Cancel</a>
        </form>

    </main>
@endsection
