@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Property List Start -->
    <div class="container-xxl py-5">
        <div class="container">

            @include('layouts.search')

            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                        <h1 class="mb-3">UNEB Solutions</h1>
                        <p>Welcome to the store of UNEB resources</p>
                    </div>
                </div>
                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Recent</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">Most Popular</a>
                        </li>
                        <li class="nav-item me-0">
                            <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">Free</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @foreach ($recent as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div>
                                </div>
                                <div class="p-4 pb-0">
                                    <h5 class="text-primary mb-3">
                                        @if ($item->price == 0 || $item->price == '')
                                            Free
                                        @else
                                            UGX {{ $item->price }}
                                        @endif
                                    </h5>
                                    <a class="d-block h6 mb-2" href="{{ route('view-file', $item->slug) }}">{{ Str::limit($item->title, 40, '...') }}</a>
                                    <small>
                                        <i class="fa fa-suitcase text-primary me-2"></i>
                                        <a href="{{ route('all-resources', ['subject', $item->subject->slug])}}" class="text-muted"><i>{{ $item->subject->title }} | </i></a>
                                        <a href="{{ route('all-resources', ['class', $item->class->slug])}}" class="text-muted"><i>{{ $item->class->class  }} | </i></a>
                                        <a href="{{ route('all-resources', ['tag', $item->tag->slug])}}" class="text-muted"><i>{{ $item->tag->tag }}</i></a>
                                    </small>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-download text-primary me-2"></i>
                                        @if (!empty($item->downloads))
                                            {{ $item->downloads->count() }}
                                        @else
                                            0
                                        @endif
                                    </small>
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-eye text-primary me-2"></i>
                                        @if (!empty($item->views))
                                            {{ $item->views->count }}
                                        @else
                                            0
                                        @endif
                                    </small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>{{ $item->user->username }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5" href="{{ route('all-resources', ['all', 'resources']) }}">Browse More Resources</a>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        @foreach ($popular as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div>
                                </div>
                                <div class="p-4 pb-0">
                                    <h5 class="text-primary mb-3">
                                        @if ($item->resources->price == 0 || $item->resources->price == '')
                                            Free
                                        @else
                                            UGX {{ $item->resources->price }}
                                        @endif
                                    </h5>
                                    <a class="d-block h6 mb-2" href="{{ route('view-file', $item->resources->slug) }}">{{ Str::limit($item->resources->title, 40, '...') }}</a>
                                    <small>
                                        <i class="fa fa-suitcase text-primary me-2"></i>
                                        <a href="{{ route('all-resources', ['subject', $item->resources->subject->slug])}}" class="text-muted"><i>{{ $item->resources->subject->title }} | </i></a>
                                        <a href="{{ route('all-resources', ['class', $item->resources->class->slug])}}" class="text-muted"><i>{{ $item->resources->class->class  }} | </i></a>
                                        <a href="{{ route('all-resources', ['tag', $item->resources->tag->slug])}}" class="text-muted"><i>{{ $item->resources->tag->tag }}</i></a>
                                    </small>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-download text-primary me-2"></i>
                                        @if (!empty($item->resources->downloads))
                                            {{ $item->resources->downloads->count() }}
                                        @else
                                            0
                                        @endif
                                    </small>
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-eye text-primary me-2"></i>
                                        @if (!empty($item->resources->views))
                                            {{ $item->resources->views->count }}
                                        @else
                                            0
                                        @endif
                                    </small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>{{ $item->resources->user->username }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5" href="{{ route('all-resources', ['all', 'resources']) }}">Browse More Resources</a>
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        @foreach ($free as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="property-item rounded overflow-hidden">
                                <div class="position-relative overflow-hidden">
                                    <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">Appartment</div>
                                </div>
                                <div class="p-4 pb-0">
                                    <h5 class="text-primary mb-3">
                                        @if ($item->price == 0 || $item->price == '')
                                            Free
                                        @else
                                            UGX {{ $item->price }}
                                        @endif
                                    </h5>
                                    <a class="d-block h6 mb-2" href="{{ route('view-file', $item->slug) }}">{{ Str::limit($item->title, 40, '...') }}</a>
                                    <small>
                                        <i class="fa fa-suitcase text-primary me-2"></i>
                                        <a href="{{ route('all-resources', ['subject', $item->subject->slug])}}" class="text-muted"><i>{{ $item->subject->title }} | </i></a>
                                        <a href="{{ route('all-resources', ['class', $item->class->slug])}}" class="text-muted"><i>{{ $item->class->class  }} | </i></a>
                                        <a href="{{ route('all-resources', ['tag', $item->tag->slug])}}" class="text-muted"><i>{{ $item->tag->tag }}</i></a>
                                    </small>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-download text-primary me-2"></i>
                                        @if (!empty($item->downloads))
                                            {{ $item->downloads->count() }}
                                        @else
                                            0
                                        @endif
                                    </small>
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-eye text-primary me-2"></i>
                                        @if (!empty($item->views))
                                            {{ $item->views->count }}
                                        @else
                                            0
                                        @endif
                                    </small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>{{ $item->user->username }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary py-3 px-5" href="{{ route('all-resources', ['all', 'resources']) }}">Browse More Resources</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Property List End -->

    <!-- Category Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="cat-item d-block rounded p-3">
                        <div class="rounded p-4">
                            <h6>Browse by Subject</h6>
                            <small>
                                @foreach ($subjects as $item)
                                    <span  class="me-2">
                                        <a href="{{ route('all-resources', ['subjects', $item->slug])}}">
                                            {{ $item->title }}
                                        </a>
                                        <span class="">({{ $item->resource->count() }})</span>
                                    </span>
                                @endforeach
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="cat-item d-block rounded p-3">
                        <div class="rounded p-4">
                            <h6>Browse by Class</h6>
                            <small>
                                @foreach ($classes as $item)
                                    <span  class="me-2">
                                        <a href="{{ route('all-resources', ['class', $item->slug])}}">
                                            {{ $item->class }}
                                        </a>
                                        <span class="">({{ $item->resource->count() }})</span>
                                    </span>
                                @endforeach
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="cat-item d-block rounded p-3">
                        <div class="rounded p-4">
                            <h6>Browse by Tags</h6>
                            <small>
                                @foreach ($tags as $item)
                                    <span  class="me-2">
                                        <a href="{{ route('all-resources', ['tag', $item->slug])}}">
                                            {{ $item->tag }}
                                        </a>
                                        <span class="">({{ $item->resource->count() }})</span>
                                    </span>
                                @endforeach
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">What Students Say About us!</h1>
                <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item bg-light rounded p-3">
                    <div class="bg-white border rounded p-4">
                        <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="{{ asset('assets/img/testimonial-1.jpg') }}" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Client Name</h6>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-3">
                    <div class="bg-white border rounded p-4">
                        <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="{{ asset('assets/img/testimonial-2.jpg') }}" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Client Name</h6>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-3">
                    <div class="bg-white border rounded p-4">
                        <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" src="{{ asset('assets/img/testimonial-3.jpg') }}" style="width: 45px; height: 45px;">
                            <div class="ps-3">
                                <h6 class="fw-bold mb-1">Client Name</h6>
                                <small>Profession</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
