@extends('layouts.app')

@section('title', 'Subjects')

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-3">Subjects</h1>
                <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod
                    sit. Ipsum diam justo sed rebum vero dolor duo.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-5">
                    <p>Add New Subject</p>
                    <div class="wow fadeInUp" data-wow-delay="0.5s">
                        <form method="POST" action="{{ route('subject-store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror" id="name"
                                            placeholder="Subject title">
                                        <label for="title">Subject Title</label>
                                        @error('title')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row gy-4">
                        <div class="col-md-12 col-lg-12 wow fadeIn" data-wow-delay="0.1s">
                            <div class="bg-light rounded p-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>No. of Resources</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects as $key => $item)
                                            <tr>
                                                <td scope="row">{{ $key + 1 }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td class="text-center">{{ $item->resource->count() }}</td>
                                                <td>
                                                    <span><a target="_blank" class="btn btn-primary" href="{{ route('all-resources', ['subjects', $item->slug])}}">View</a></span>
                                                    <span><a class="btn btn-danger" href="#delete-{{ $item->id }}"
                                                            data-bs-toggle="modal">Delete</a></span>
                                                </td>
                                            </tr>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete Subject</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this subject?
                                                            <br> <strong>This will remove all the associated resources</strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('subject-destroy') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Yes, Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $subjects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
