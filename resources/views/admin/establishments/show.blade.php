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
        <div class="col-md-6">
            <div class="card shadow-xs border">
                <div class="card-body">
                    <h6 class="font-weight-semibold text-lg mb-0">Description</h6>
                    <div class="py-4">
                        {!! $establishment->description !!}
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6"> 
            <div class="row">
                <div class="card shadow-xs border">
                    <div class="card-body">
                        <h6 class="font-weight-semibold text-lg mb-0">Photos</h6>
                        <div class="position-relative overflow-hidden">
                            <div class="swiper mySwiper mt-4 mb-2" loop="true">
                                <div class="swiper-wrapper">
                                    @foreach ($images as $key => $image)
                                        
                                    <div class="swiper-slide">
                                        <div>
                                            <div
                                                class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                                <div class="full-background bg-contain"
                                                    style="background-image: url('{{ asset('storage/' . $image->image_path) }}')"></div>
                                                <div class="card-body text-start px-3 py-0 w-100">
                                                    <div class="row mt-12">
                                                        <div class="col-sm-3 mt-auto">
                                                            <h4 class="text-dark font-weight-bolder">#{{ $key + 1 }}</h4>
                                                            
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    @endforeach

                                        
                                </div>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
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
                            <h6 class="font-weight-semibold text-lg mb-0">Rooms</h6>
                            <p class="text-sm mb-sm-0 mb-2">These are the list of all rooms.</p>
                        </div>
                        <div class="ms-auto d-flex"> 
                            <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0"
                                data-bs-toggle="modal" data-bs-target="#createRoomModal">
                                <span class="btn-inner--icon mx-2 d-flex align-items-center">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="btn-inner--text">New Room</span>
                            </button>
                        </div>
                    </div>

                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Room Namme</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Capacity</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Price</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2">
                                            <div class="text-secondary text-xs font-weight-semibold opacity-7">
                                                {{ $room->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-secondary text-xs font-weight-semibold opacity-7">
                                        {{ $room->capacity }}</td>
                                    <td class="align-middle text-secondary text-xs font-weight-semibold opacity-7">
                                        {{ $room->price }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex alignt-items-center justify-content-center">

                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editroomModal"
                                                class="text-secondary font-weight-bold text-xs mx-2"
                                                data-bs-toggle="tooltip" data-bs-title="Edit Room"
                                                data-room-name="{{ $room->name }}">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <a href="#" class="text-danger font-weight-bold text-xs mx-2"
                                                data-bs-toggle="tooltip" data-bs-title="Delete Room"
                                                onclick="event.preventDefault(); document.getElementById('delete-service-form-{{ $room->id }}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>

                                        <form id="delete-service-form-{{ $room->id }}"
                                            action="{{ route('admin.delete.rooms', [$establishment->id, $room->id]) }}"
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
            <div class="card shadow-xs border">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Services</h6>
                            <p class="text-sm mb-sm-0 mb-2">These are the list of all services.</p>
                        </div>
                        <div class="ms-auto d-flex"> 
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

                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editServiceModal"
                                                class="text-secondary font-weight-bold text-xs mx-2"
                                                data-bs-toggle="tooltip" data-bs-title="Edit Service"
                                                data-service-name="{{ $service->name }}">
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
 
    </div>
</div>
<!-- Modals -->
<!-- Add a new service -->
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

<!-- Add a new room -->
<div class="modal fade" id="createRoomModal" tabindex="-1" role="dialog" aria-labelledby="createRoomModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRoomModalTitle">Add Room</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('admin.store.rooms', $establishment) }}" id="createRoom">
                    @csrf
                    <div class="form-group">
                        <label for="name">Room Name</label>
                        <input type="text" class="form-control" name="name" id="name" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                    </div>
                    <div class="d-flex ms-auto justify-content-between gap-1">
                        <div class="col-auto form-group">
                            <label for="name">Room Capacity</label>
                            <input type="number" class="form-control" name="capacity" id="capacity" required />
                        </div>
                        <div class="col-auto form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="price" id="price" required />
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark"
                    onclick="document.getElementById('createRoom').submit();">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script src="{{ asset('/assets/js/plugins/swiper-bundle.min.js') }}" crossorigin="anonymous"></script>
<script>
    if (document.getElementsByClassName('mySwiper')) {
        var swiper = new Swiper(".mySwiper", {
            effect: "fade",
            grabCursor: true,
            initialSlide: 0,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    };

</script>
@endsection