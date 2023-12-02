@extends('layouts.app')

@section('title', 'Search ')

@section('content')
<div class="breadcrumb-area set-bg" data-setbg="{{ asset('new/img/breadcrumb/breadcrumb-normal.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                        <h4 class="mb-3 text-light">Search Results</h4>
                        <p>Showing {{ $resources->count() }} results for {{ $keyword }}</p>
                    <div class="breadcrumb__option">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <span>{{ $keyword }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Property List Start -->
    <div class="container-xxl py-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-9">
                    <div class="row g-4">
                        @if ($resources->count() >= 1)
                            @foreach ($resources as $item)
                            <div class="col-md-6">
                                <div class="listing__item">
                                    <div class="listing__item__text">
                                        <div class="listing__item__text__inside">
                                            <h5>{{ Str::limit($item->title, 40, '...') }}</h5>

                                            <ul>
                                                <small>
                                                    <i class="fa fa-suitcase text-primary me-2"></i>
                                                    <a href="{{ route('all-resources', ['subject', $item->subject->slug])}}" class="text-muted"><i>{{ $item->subject->title }} | </i></a>
                                                    <a href="{{ route('all-resources', ['class', $item->class->slug])}}" class="text-muted"><i>{{ $item->class->class  }} | </i></a>
                                                    <a href="{{ route('all-resources', ['tag', $item->tag->slug])}}" class="text-muted"><i>{{ $item->tag->tag }}</i></a>
                                                </small>
                                                <li>
                                                    <div class="d-flex border-top">
                                                        <label class="flex-fill border-end py-2">
                                                            <i class="fa fa-download text-muted me-2"></i>
                                                            @if (!empty($item->downloads))
                                                                {{ $item->downloads->count() }}
                                                            @else
                                                                0
                                                            @endif
                                                        </label>
                                                        <label class="flex-fill border-end py-2">
                                                            <i class="fa fa-eye text-muted me-2"></i>
                                                            @if (!empty($item->views))
                                                                {{ $item->views->count }}
                                                            @else
                                                                0
                                                            @endif
                                                        </label>
                                                        <label class="flex-fill py-2"><i class="fa fa-user text-muted me-2"></i> {{ $item->user->username }}</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="listing__item__text__info">
                                            <div class="listing__item__text__info__left">
                                                <span>Free</span>
                                            </div>
                                            <div class="listing__item__text__info__right"><a href="{{ route('view-file', $item->slug) }}">Read more</a></div>
                                        </div>
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
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="border-start px-3">
                        <h4 class="text-primary">Filter</h4>
                        <p><strong>By Curriculum</strong></p>
                        <small>
                            <span  class="me-2">
                                <a href="{{ route('all-resources', ['curriculum', 'new']) }}">
                                    New Curriculum
                                </a>
                                <span class="">(
                                    @php
                                        echo App\Models\Resource::where('curriculum', 'new')->get()->count()
                                    @endphp)
                                </span>
                            </span>
                        </small>
                        <small>
                            <span  class="me-2">
                                <a href="{{ route('all-resources', ['curriculum', 'old']) }}">
                                    Old Curriculum
                                </a>
                                <span class="">(
                                    @php
                                        echo App\Models\Resource::where('curriculum', 'old')->get()->count()
                                    @endphp)
                                </span>
                            </span>
                        </small>
                        <p class="mt-3"><strong>By Tag</strong></p>
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
                <div class="m-5">
                    {{ $resources->links()  }}
                </div>
            </div>
        </div>
    </div>
@endsection
