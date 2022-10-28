@extends('layouts.app')

@section('title', $file->title)

@section('content')
    @include('layouts.search')

    <div class="container-xxl py-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li style="text-transform: capitalize" class="breadcrumb-item"><a href="{{ route('all-resources', ['tag', $file->tag->slug])}}">{{ $file->tag->tag }}</a></li>
                    <li style="text-transform: capitalize" class="breadcrumb-item active" aria-current="page">{{ $file->title }}</li>
                </ol>
            </nav>
            <div class="bg-light rounded p-3">
                <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                    <div class="row g-5">
                        <div class="col-lg-7 wow fadeIn" data-wow-delay="0.5s">
                            <div class="mb-4">
                                <h4 class="mb-3">{{ $file->title }}</h4>
                                <p>{!! $file->description !!}</p>
                            </div>
                            <a class="btn btn-dark">UGX&nbsp;{{ $file->price }}</a>
                            @if ($file->price == 0 || $file->price == '')
                                <a href="{{ route('download-file', $file->slug) }}" class="btn btn-primary me-2"><i
                                    class="fa fa-download me-2"></i>Download</a>
                                <a href="#preview-modal" data-bs-toggle="modal" class="btn btn-primary me-2"><i
                                        class="fa fa-eye me-2"></i>Preview</a>
                            @else
                                <a href="#buy-now-modal" data-bs-toggle="modal" class="btn btn-primary me-2"><i
                                    class="fa fa-shopping-cart me-2"></i>Buy Now</a>
                            @endif
                        </div>
                        <div class="col-lg-5 wow fadeIn" data-wow-delay="0.5s">
                            <h6>Resource Attributes</h6>
                            <small>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Class:
                                        <span class="text-muted">{{ $file->class->class }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Subject:
                                        <span class="text-muted">{{ $file->subject->title }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Tag:
                                        <span class="text-muted">{{ $file->tag->tag }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Added by:
                                        <span class="text-muted">{{ $file->user->username }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        File Type:
                                        <span class="text-muted">{{ $file->type }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Size
                                        <span class="text-muted">{{ number_format($file->size/1000000, 2) }}MB</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Views
                                        <span class="text-muted">{{ $views }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Downloads
                                        <span class="text-muted">{{ $downloads }}</span>
                                    </li>
                                </ul>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="buy-now-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Buy Resource</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('purchase-file') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <h6 class="mb-1">Fill in the details below to continue</h6>
                        <small><i>Currently supporting MTN Uganda only</i></small>
                        <input type="hidden" name="amount" value="{{ $file->price }}">
                        <input type="hidden" name="resource" value="{{ $file->id }}">
                        <div class="form-group mb-4">
                          <input type="text" name="phone" id="" class="form-control @error('phone') is-invalid @enderror" placeholder="+256770000000">
                          <small><i>Phone number should include code +256</i></small>
                          @error('phone')
                              <small class="invalid-feedback" role="alert">{{ $message }}</small>
                          @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="preview-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Preview Resource</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('purchase-file') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <h6 class="mb-1">{{ $file->title}}</h6>
                        {{-- <iframe src ="{{ asset('/laraview/#../pdf/hi.pdf') }}" width="1000px" height="600px"></iframe> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        PDFObject.embed("http://127.0.0.1:8000/storage/files/16653877341664295332brit-invoice.pdf", "#pdf-viewer");
    </script>
@endsection
