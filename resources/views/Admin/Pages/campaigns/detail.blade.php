@extends('Admin.Layouts.main')
@section('main')
    @include('Admin.Layouts.sidebar')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        @include('Admin.Layouts.alert')
        <div class="border-bottom mb-3 pt-3 pb-2 event-title">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h1 class="h2">{{ $campaign->name }}</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-sm btn-outline-secondary">Edit
                            campaign</a>
                    </div>
                </div>
            </div>
            <span class="h6">{{ $campaign->format_date }}</span>
        </div>

        <!-- Tickets -->
        <div id="tickets" class="mb-3 pt-3 pb-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h2 class="h4">Tickets</h2>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('admin.campaigns.tickets.create', $campaign->id) }}"
                            class="btn btn-sm btn-outline-secondary">
                            Create new ticket
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- list ticket --}}
        <div class="row tickets">
            @foreach ($campaign->Tickets as $ticket)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ticket->name }}</h5>
                            <p class="card-text">{{ $ticket->cost }} .-</p>
                            <p class="card-text">{!! $ticket->format_special_validity !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- List Sessions --}}
        <div id="sessions" class="mb-3 pt-3 pb-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h2 class="h4">Sessions</h2>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('admin.campaigns.sessions.create', $campaign->id) }}" class="btn btn-sm btn-outline-secondary">
                            Create new session
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive sessions">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Type</th>
                        <th class="w-100">Title</th>
                        <th>Vaccinator</th>
                        <th>Area</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaign->Sessions() as $session)
                        <tr>
                            <td class="text-nowrap">{{ $session->format_time }}</td>
                            <td>{{ $session->type }}</td>
                            <td><a href="{{ route('admin.campaigns.sessions.edit',['campaign' => $campaign->id, 'session' => $session->id]) }}">{{ $session->title }}</a></td>
                            <td class="text-nowrap">{{ $session->vaccinator }}</td>
                            <td class="text-nowrap">{{ $session->area_and_place }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Areas -->
        <div id="channels" class="mb-3 pt-3 pb-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h2 class="h4">Areas</h2>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('admin.campaigns.areas.create', $campaign->id) }}"
                            class="btn btn-sm btn-outline-secondary">
                            Create new area
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row channels">
            @foreach ($campaign->Areas as $area)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $area->name }}</h5>
                            <p class="card-text">{{ $area->session_and_place }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Palces -->
        <div id="rooms" class="mb-3 pt-3 pb-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h2 class="h4">Places</h2>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('admin.campaigns.places.create', $campaign->id) }}"
                            class="btn btn-sm btn-outline-secondary">
                            Create new place
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive rooms">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Capacity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaign->Places as $place)
                        <tr>
                            <td>{{ $place->name }}</td>
                            <td>{{ $place->capacity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
