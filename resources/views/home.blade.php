@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('layouts.search')

    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Most Popular Resources</h2>
                    </div>
                    <div class="categories__item__list">
                        @foreach ($popularClasses as $class)
                            <div class="categories__item">
                                <h5>{{ $class->class }}</h5>
                                <span>{{ $class->resource_count }} {{ Str::plural('Resources', $class->resource_count) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="most-search spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Overview of UNEB Resources</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="most__search__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-new-curriculum" role="tab">
                                    <span class="flaticon-039-fork"></span>
                                    New Curriculum
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-old-curriculum" role="tab">
                                    <span class="flaticon-030-kebab"></span>
                                    Old Curriculum
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-recent" role="tab">
                                    <span class="flaticon-032-food-truck"></span>
                                    Most Recent
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-popular" role="tab">
                                    <span class="flaticon-017-croissant"></span>
                                    Most Popular
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-new-curriculum" role="tabpanel">
                            <div class="row">
                                @foreach ($new_curriculum as $item)
                                <div class="col-lg-4 col-md-6">
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
                                                    <span style="text-transform:capitalize">{{ $item->curriculum }} Curriculum</span>
                                                </div>
                                                <div class="listing__item__text__info__right"><a href="{{ route('view-file', $item->slug) }}">Download</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-old-curriculum" role="tabpanel">
                            <div class="row">
                                @foreach ($old_curriculum as $item)
                                <div class="col-lg-4 col-md-6">
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
                                                    <span style="text-transform:capitalize">{{ $item->curriculum }} Curriculum</span>
                                                </div>
                                                <div class="listing__item__text__info__right"><a href="{{ route('view-file', $item->slug) }}">Download</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-recent" role="tabpanel">
                            <div class="row">
                                @foreach ($recent as $item)
                                <div class="col-lg-4 col-md-6">
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
                                                    <span style="text-transform:capitalize">{{ $item->curriculum }} Curriculum</span>
                                                </div>
                                                <div class="listing__item__text__info__right"><a href="{{ route('view-file', $item->slug) }}">Download</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-popular" role="tabpanel">
                            <div class="row">
                                @foreach ($popular as $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="listing__item">
                                        <div class="listing__item__text">
                                            <div class="listing__item__text__inside">
                                                <h5>{{ Str::limit($item->resources->title, 40, '...') }}</h5>

                                                <ul>
                                                    <small>
                                                        <i class="fa fa-suitcase text-primary me-2"></i>
                                                        <a href="{{ route('all-resources', ['subject', $item->resources->subject->slug])}}" class="text-muted"><i>{{ $item->resources->subject->title }} | </i></a>
                                                        <a href="{{ route('all-resources', ['class', $item->resources->class->slug])}}" class="text-muted"><i>{{ $item->resources->class->class  }} | </i></a>
                                                        <a href="{{ route('all-resources', ['tag', $item->resources->tag->slug])}}" class="text-muted"><i>{{ $item->resources->tag->tag }}</i></a>
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
                                                            <label class="flex-fill py-2"><i class="fa fa-user text-muted me-2"></i> {{ $item->resources->user->username }}</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="listing__item__text__info">
                                                <div class="listing__item__text__info__left">
                                                    <span style="text-transform:capitalize">{{ $item->resources->curriculum }} Curriculum</span>
                                                </div>
                                                <div class="listing__item__text__info__right"><a href="{{ route('view-file', $item->resources->slug) }}">Download</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
        <a class="btn btn-primary py-3 px-5" href="{{ route('all-resources', ['all', 'resources']) }}">Browse More Resources</a>
    </div>

    <section class="news-post spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="blog__item">
                        <div class="blog__item__text">
                            <h5>Browse by Subject</h5>
                            <ul class="blog__item__widget">
                                @foreach ($subjects as $item)
                                    <li><a href="{{ route('all-resources', ['subjects', $item->slug])}}">- {{ $item->title }} <span class="">({{ $item->resource->count() }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog__item">
                        <div class="blog__item__text">
                            <h5>Browse by Tags</h5>
                            <ul class="blog__item__widget">
                                @foreach ($tags as $item)
                                <li><a href="{{ route('all-resources', ['tag', $item->slug])}}">- {{ $item->tag }}<span class="">({{ $item->resource->count() }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog__item">
                        <div class="blog__item__text">
                            <h5>Browse by Class</h5>
                            <ul class="blog__item__widget">
                                @foreach ($classes as $item)
                                <li><a href="{{ route('all-resources', ['class', $item->slug])}}">- {{ $item->class }} <span class="">({{ $item->resource->count() }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
