@extends('layouts.app')

@section('title', 'Search ')

@section('content')
    <!-- Property List Start -->
    <div class="container-xxl py-5">
        <div class="container">

            @include('layouts.search')

            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6 mb-3">
                    <div class="text-start mx-auto mb-2">
                        <h4 class="mb-3">Search Results</h4>
                        <p>Showing {{ $resources->count() }} results for {{ $keyword }}</p>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li style="text-transform: capitalize" class="breadcrumb-item active" aria-current="page">
                                {{ $keyword }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="row g-4">
                        @if ($resources->count() >= 1)
                            @foreach ($resources as $item)
                                <div class="col-lg-6 col-md-6">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden">
                                            <div
                                                class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                                For Sell</div>
                                            <div
                                                class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                                Appartment</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">
                                                @if ($item->price == 0 || $item->price == '')
                                                    Free
                                                @else
                                                    UGX {{ $item->price }}
                                                @endif
                                            </h5>
                                            <a class="d-block h6 mb-2"
                                                href="{{ route('view-file', $item->slug) }}">{{ Str::limit($item->title, 40, '...') }}</a>
                                            <small>
                                                <i class="fa fa-suitcase text-primary me-2"></i>
                                                <a href="{{ route('all-resources', ['subject', $item->subject->slug]) }}"
                                                    class="text-muted"><i>{{ $item->subject->title }} | </i></a>
                                                <a href="{{ route('all-resources', ['class', $item->class->slug]) }}"
                                                    class="text-muted"><i>{{ $item->class->class }} | </i></a>
                                                <a href="{{ route('all-resources', ['tag', $item->tag->slug]) }}"
                                                    class="text-muted"><i>{{ $item->tag->tag }}</i></a>
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
                                            <small class="flex-fill text-center py-2"><i
                                                    class="fa fa-user text-primary me-2"></i>{{ $item->user->username }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12 text-center">
                                <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                                <h1 class="display-5">EMPTY!</h1>
                                <h1 class="mb-4">Nothing Found</h1>
                                <p class="mb-4">We’re sorry, the resource you have searched for does not exist in our
                                    databse! <br>Maybe you try searching again with a different keyword?</p>
                                <a class="btn btn-primary py-3 px-5" href="/">Go Back To Home</a>
                            </div>
                        @endif
                        {{ $resources->links() }}
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="border-start px-3">
                        <h4 class="text-primary">Filter</h4>
                        <p><strong>By Tag</strong></p>
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

                        <p class="mt-3"><strong>By Class</strong></p>
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

                        <p class="mt-3"><strong>By Subject</strong></p>
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
        </div>
    </div>
@endsection
