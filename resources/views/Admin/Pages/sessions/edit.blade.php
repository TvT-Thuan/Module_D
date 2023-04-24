@extends('Admin.Layouts.main')
@section('main')
    @include('Admin.Layouts.sidebar')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
           @include('Admin.Layouts.nav')
        <div class="mb-3 pt-3 pb-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h2 class="h4">Edit session</h2>
            </div>
        </div>

        <form class="needs-validation" novalidate
            action="{{ route('admin.campaigns.sessions.update', ['campaign' => $campaign->id, 'session' => $session->id]) }}"
            method="POST">
            @csrf
            @method('PUT')
            @include('Admin.Layouts.alert')
            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="selectType">Type</label>
                    <select class="form-control @error('type') is-invalid @enderror" id="selectType" name="type">
                        <option value="normal" {{ old('type', $session->type) == 'normal' ? 'selected' : '' }}>Normal
                        </option>
                        <option value="service" {{ old('type', $session->type) == 'service' ? 'selected' : '' }}>Service
                        </option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputTitle">Title</label>
                    <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputTitle"
                        name="title" placeholder="" value="{{ old('title', $session->title) }}" />
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputParticipant">Participant</label>
                    <input type="text" class="form-control @error('participant') is-invalid @enderror"
                        id="inputParticipant" name="participant" placeholder=""
                        value="{{ old('participant', $session->vaccinator) }}" />
                    @error('participant')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="selectPlace">Place</label>
                    <select class="form-control @error('place') is-invalid @enderror" id="selectPlace" name="place">
                        @foreach ($campaign->Places as $place)
                            <option value="{{ $place->id }}"
                                {{ old('place', $session->place_id) == $place->id ? 'selected' : '' }}>
                                {{ $place->area_and_place }}</option>
                        @endforeach
                        {{-- $session->place_id --}}
                    </select>
                    @error('place')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputCost">Cost</label>
                    <input type="number" class="form-control @error('cost') is-invalid @enderror" id="inputCost"
                        name="cost" placeholder="0" value="{{ old('cost', $session->cost) }}" />
                    @error('cost')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 mb-3">
                    <label for="inputStart">Start</label>
                    <input type="text" class="form-control @error('start') is-invalid @enderror" id="inputStart"
                        name="start" placeholder="yyyy-mm-dd HH:MM"
                        value="{{ old('start', $session->format_time_start) }}" />
                    @error('start')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-lg-6 mb-3">
                    <label for="inputEnd">End</label>
                    <input type="text" class="form-control @error('end') is-invalid @enderror" id="inputEnd"
                        name="end" placeholder="yyyy-mm-dd HH:MM"
                        value="{{ old('end', $session->format_time_end) }}" />
                    @error('end')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-3">
                    <label for="textareaDescription">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="textareaDescription" name="description" placeholder="" rows="5">{{ old('description', $session->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="mb-4" />
            <button class="btn btn-primary" type="submit">Save session</button>
            <a href="{{ route('admin.campaigns.show', $campaign->id) }}" class="btn btn-link">Cancel</a>
        </form>

    </main>
@endsection
