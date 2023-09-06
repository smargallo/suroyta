@extends('layouts.app')

@section('content')
<div class="px-5 py-4 container-fluid">
    <div class="row">
        <div class="mx-auto col-lg-9 col-12">
            <div class="mt-4 card blur">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.establishments.store') }}">
                        @csrf
                        <h6 class="mb-0">New Establishment</h6>
                        <p class="mb-4 text-sm">Create new establishment</p>

                        <div class="form-group {{ $errors->has('destination_id') ? 'has-danger' : 'has-success' }}">
                            <label for="destination_id">Select Destination</label>
                            <select name="destination_id" id="destination_id" class="form-control {{ $errors->has('destination_id') ? 'is-invalid' : 'is-valid' }}">
                                <option value="" disabled selected>Select a destination</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-danger' : 'has-success' }}">
                            <label for="name" class="form-label">Establishment Name</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : 'is-valid' }}" id="name" name="name"  onfocus="focused(this)"
                            onfocusout="defocused(this)" value="{{ old('name', $establishment->name) }}">
                        </div>

                        <div class="mt-4 row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>
                                        Status
                                    </label>
                                    <p class="text-xs form-text text-muted ms-1">
                                        Set to yes if you want the location to appear in the front end.
                                    </p>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            onclick="notify(this)" data-type="warning"
                                            data-content="Once a project is made private, you cannot revert it to a public project."
                                            data-title="Warning" data-icon="ni ni-bell-55">
                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-danger' : 'has-success' }}">

                            <label class="mt-4">Establishment Description</label>
                            <p class="form-text text-muted text-xs ms-1">
                                This is how others will learn about the establishment, so make it good!
                            </p>
                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : 'is-valid' }}" name="description" id="" cols="30" rows="10">{{ old('description', $establishment->description) }}</textarea>
                        </div>

                        <div class="form-group  {{ $errors->has('location') ? 'has-danger' : 'has-success' }}">
                            <label class="mt-4 form-label">Location</label>    
                            <input class="form-control {{ $errors->has('location') ? 'is-invalid' : 'is-valid' }}" type="text" name="location" value="{{ old('location', $establishment->location) }}">
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <a href="{{ route('admin.establishments.index') }}" name="button" class="m-0 btn btn-white">Cancel</a>
                            <button type="submit" name="button" class="m-0 btn btn-dark ms-2">Create establishment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
