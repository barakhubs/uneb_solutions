@extends('layouts.app')

@section('title', 'Successful purchase')

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
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  <strong>Congratulations!</strong> Your purchase was successful!
                                </div>

                                <script>
                                  var alertList = document.querySelectorAll('.alert');
                                  alertList.forEach(function (alert) {
                                    new bootstrap.Alert(alert)
                                  })
                                </script>

                                <h4 class="mb-3">{{ $file->title }}</h4>
                                <p>Verify the secret code sent to phone number to download your resource file.</p>
                                <form action="{{ route('verify-code') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                      <label for="">Secret Code</label>
                                      <input type="text"
                                        class="form-control @error('code') is-invalid @enderror" name="code" id="code" aria-describedby="helpId" placeholder="Secret code">
                                      @error('code')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                      @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary">Download File</button>
                                    </div>
                                </form>
                            </div>


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
@endsection
