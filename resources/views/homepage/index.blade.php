
@extends('layouts.public')

@section('content')
    <x-carousel-component :page="'homepage'" :position="'main'" id="mainCarousel" class="d-none d-md-block"
                          style="height: 430px"/>

    <div class="my-4 py-2 row mx-0">

        <div class="col-sm-12 col-md-6 offset-md-3">

            <ul class="nav ms-auto" id="searchMenu" role="tablist">
                <li class="nav-item border-end" role="presentation">
                    <a class="nav-link active fs-sm fw-semibold pt-0 pb-1 px-0 mx-3"
                       id="searchHotelsLabel"
                       data-bs-toggle="tab"
                       data-bs-target="#searchHotels"
                       href="javascript:void(0);" role="tab" aria-controls="searchHotels" aria-selected="true">
                        <i class="ci ci-hotel-bell me-2"></i> Hotel
                    </a>

                </li>
                <li class="nav-item border-end" role="presentation">
                    <a class="nav-link fs-sm fw-semibold pt-0 pb-1 px-0 mx-3"
                       id="searchFlightsLabel"
                       data-bs-toggle="tab"
                       data-bs-target="#searchFlights"
                       href="javascript:void(0);" role="tab" aria-controls="searchFlights">
                        <i class="ci ci-departure me-2"></i> Voli
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link fs-sm fw-semibold pt-0 pb-1 px-0 mx-3"
                       id="searchHotelsFlightsLabel"
                       data-bs-toggle="tab"
                       data-bs-target="#searchHotelsFlights"
                       href="javascript:void(0);" role="tab" aria-controls="searchHotelsFlights">
                        <i class="ci ci-hotel-bell"></i><i class="ci ci-departure me-2"></i> Volo + Hotel
                    </a>
                </li>
            </ul>

            <div class="tab-content mt-3" id="searchMenuContent">
                <div class="tab-pane fade show active px-3"
                     id="searchHotels"
                     role="tabpanel"
                     aria-labelledby="searchHotelsLabel">

                    @include('homepage._search_hotels')

                </div>
                <div class="tab-pane fade px-3"
                     id="searchFlights"
                     role="tabpanel"
                     aria-labelledby="searchFlightsLabel">
                    Search your flights here
                </div>
                <div class="tab-pane fade px-3"
                     id="searchHotelsFlights"
                     role="tabpanel"
                     aria-labelledby="searchHotelsFlightsLabel">
                    Search your flight and hotel here
                </div>
            </div>

        </div>
    </div>

    <div class="bg-secondary py-5">

        <div class="container">
            <x-thematic-component :page="'homepage'" :position="'main'" :colSize="'col-md-3 col-sm-12'" class="g-1" />
        </div>
    </div>

@stop
