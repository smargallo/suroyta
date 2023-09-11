@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-md-flex align-items-center mb-3 mx-2">
                <div class="mb-md-0 mb-3">
                    <h3 class="font-weight-bold mb-0">{{ $establishment->name }}</h3>
                    <p class="mb-0">{{ $establishment->location }}</p>
                </div>
                <a href="{{ route('admin.establishments.edit', $establishment->id) }}"
                    class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">
                    <span class="btn-inner--text">Edit</span>
                </a>
                <button type="button" class="btn btn-sm btn-danger btn-icon d-flex align-items-center mb-0">
                    <span class="btn-inner--text">Delete</span>
                </button>
            </div>
        </div>
    </div>
    <hr class="my-0">
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card shadow-xs border">
                <div class="card-body">
                    <h6 class="font-weight-semibold text-lg mb-0">Description</h6>
                    <div>
                        {!! $establishment->description !!}
                    </div>
                    {{-- @if($establishment->images->count() > 0)
                        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                @foreach($establishment->images as $key => $image)
                                    <li data-target="#imageCarousel" data-slide-to="{{ $key }}"
                    class="{{ $key === 0 ? 'active' : '' }}"></li>
                    @endforeach
                    </ol>

                    <!-- Slides -->
                    <div class="carousel-inner">
                        @foreach($establishment->images as $key => $image)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Establishment Image">
                        </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="carousel-control-prev text-dark" href="#imageCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next text-dark" href="#imageCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                @endif --}}
            </div>
        </div>
    </div>
</div>
<div class="row my-4">

    <div class="col-lg-6 col-md-12">
        <div class="card shadow-xs border">
            <div class="card-header border-bottom pb-0">
                <div class="d-sm-flex align-items-center mb-3">
                    <div>
                        <h6 class="font-weight-semibold text-lg mb-0">Services</h6>
                        <p class="text-sm mb-sm-0 mb-2">These are the list of all services.</p>
                    </div>
                    <div class="ms-auto d-flex">
                        <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                            View report
                        </button>
                        <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0"
                            data-bs-toggle="modal" data-bs-target="#createServiceModal">
                            <span class="btn-inner--icon mx-2 d-flex align-items-center">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="btn-inner--text">New Service</span>
                        </button>
                    </div>
                </div>
 
            </div>
            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Service Namme</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Date</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                            <tr>
                                <td>
                                    <div class="d-flex px-2">
                                        <div class="text-secondary text-xs font-weight-semibold opacity-7">
                                            {{ $service->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-secondary text-xs font-weight-semibold opacity-7">
                                    {{ $service->created_at }}</td>
                                <td class="align-middle">
                                    <div class="d-flex alignt-items-center justify-content-center">

                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editServiceModal"  class="text-secondary font-weight-bold text-xs mx-2"
                                            data-bs-toggle="tooltip" data-bs-title="Edit Service" data-service-name="{{ $service->name }}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="#" class="text-danger font-weight-bold text-xs mx-2"
                                            data-bs-toggle="tooltip" data-bs-title="Delete Service"
                                            onclick="event.preventDefault(); document.getElementById('delete-service-form-{{ $service->id }}').submit();">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>

                                    <form id="delete-service-form-{{ $service->id }}"
                                        action="{{ route('admin.delete.services', [$establishment->id, $service->id]) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
       
    </div>
</div>
</div>
<!-- Add a new service -->
<!-- Modal -->
<div class="modal fade" id="createServiceModal" tabindex="-1" role="dialog" aria-labelledby="createServiceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createServiceModal">Edit Profile</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('admin.store.services', $establishment) }}" id="createService">
                    @csrf
                    <div class="form-group">
                        <label for="name">Service Name.</label>
                        <input class="form-control" name="name" id="name" required />
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('createService').submit();">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit service -->
<!-- Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="editServiceModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModal">Edit Profile</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('admin.store.services', $establishment) }}" id="editService">
                    @csrf
                    <div class="form-group">
                        <label for="name">Service Name.</label>
                        <input class="form-control" name="name" id="name" required />
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('editService').submit();">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection
