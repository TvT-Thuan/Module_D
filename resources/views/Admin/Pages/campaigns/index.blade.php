@extends('Admin.Layouts.main')
@section('main')
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="{{ route('admin.campaigns.index') }}">Manage Campaigns</a></li>
            </ul>
        </div>
    </nav>
    @include('Admin.Layouts.alert')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Campaigns</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{ route('admin.campaigns.create') }}" class="btn btn-sm btn-outline-secondary">Create new
                        campaigns</a>
                </div>
            </div>
        </div>

        <div class="row campaign">
            @foreach ($data as $item)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <a href="{{ route('admin.campaigns.show', $item->id) }}" class="btn text-left campaign">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-subtitle">{{ $item->format_date }}</p>
                                <hr>
                                <p class="card-text">{{ $item->number_register }} registrations</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
