@extends('layouts.app')

@section('title', 'Resources')

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="mx-auto mb-5">
                <div class="d-flex justify-content-between">
                    <h3 class="">Resources</h3>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNew">New
                        Resource</button>
                </div>
                <p class="mp-3">Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero
                    <br>ipsum sit eirmod
                    sit. Ipsum diam justo sed rebum vero dolor duo.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="row gy-4">
                        <div class="col-md-12 col-lg-12">
                            <div class="bg-light rounded p-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>File Type</th>
                                            <th>Downloads</th>
                                            <th>Views</th>
                                            <th>Price</th>
                                            <th>Subject</th>
                                            <th>Class</th>
                                            <th>Tag</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($resources as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td title="view" style="text-decoration: underline dashed 1px"><a href="{{ route('view-file', $item->slug) }}" target="_blank">{{ $item->title }}</a></td>
                                                <td>{{ $item->type }}</td>
                                                <td>{{ $item->downloads->count() }}</td>
                                                <td>
                                                    @if (!empty($item->views))
                                                        {{ $item->views->count }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>UGX {{ $item->price }}</td>
                                                <td>{{ $item->subject->title }}</td>
                                                <td>{{ $item->class->class }}</td>
                                                <td>{{ $item->tag->tag }}</td>
                                                <td>
                                                    <span><a href="#update-{{ $item->id }}" data-bs-toggle="modal"
                                                            class="btn-custom btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></span>
                                                    <span><a class="btn-custom btn btn-danger btn-sm"
                                                            href="#delete-{{ $item->id }}"
                                                            data-bs-toggle="modal"><i class="fa fa-trash"></i></a></span>

                                                </td>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                    Subject</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure you want to delete this resource?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('resource-destroy') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $item->id }}">
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-secondary">Yes,
                                                                        Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Update file resource -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div class="modal fade" id="update-{{ $item->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">New Resource</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST"
                                                                action="{{ route('resource-update', $item->id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <p>Editing Resource {!! $item->description !!}</p>
                                                                    <div>
                                                                        <div class="row g-3">
                                                                            <div class="col-md-12">
                                                                                <div class="form-floating">
                                                                                    <input type="text" name="title"
                                                                                        class="form-control @error('title') is-invalid @enderror"
                                                                                        id="name"
                                                                                        placeholder="Resource title"
                                                                                        value="{{ $item->title }}">
                                                                                    <label for="title">Resource
                                                                                        Title</label>
                                                                                    @error('title')
                                                                                        <small class="invalid-feedback"
                                                                                            role="alert">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="form-floating">
                                                                                    <input type="file" name="file"
                                                                                        class="form-control @error('file') is-invalid @enderror"
                                                                                        id="file"
                                                                                        placeholder="Resource file"
                                                                                        value="{{ $item->file }}">
                                                                                    <label for="title">Resource
                                                                                        file <small>(Leave empty if your are
                                                                                            not updating
                                                                                            file)</small></label>
                                                                                    @error('file')
                                                                                        <small class="invalid-feedback"
                                                                                            role="alert">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-floating">
                                                                                    <input type="number" name="price"
                                                                                        class="form-control @error('price') is-invalid @enderror"
                                                                                        placeholder="Price" min="0"
                                                                                        step="100"
                                                                                        value="{{ $item->price }}">
                                                                                    <label for="price">Price <small
                                                                                            class="text-muted">(Leave empty
                                                                                            if it is a free
                                                                                            resource)</small></label>
                                                                                    @error('price')
                                                                                        <small class="invalid-feedback"
                                                                                            role="alert">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-floating">
                                                                                    <select required name="subject"
                                                                                        class="form-control @error('subject') is-invalid @enderror">
                                                                                        <option>Select Subject</option>
                                                                                        @foreach ($subjects as $subject)
                                                                                            <option
                                                                                                @selected(true)
                                                                                                value="{{ $subject->id }}">
                                                                                                {{ $subject->title }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <label for="subject">Subject</label>
                                                                                    @error('subject')
                                                                                        <small class="invalid-feedback"
                                                                                            role="alert">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-floating">
                                                                                    <select required name="class"
                                                                                        class="form-control @error('class') is-invalid @enderror">
                                                                                        <option>Select Class</option>
                                                                                        @foreach ($classes as $class)
                                                                                            <option
                                                                                                @selected(true)
                                                                                                value="{{ $class->id }}">
                                                                                                {{ $class->class }}
                                                                                            </option>
                                                                                        @endforeach

                                                                                    </select>
                                                                                    <label for="class">Select
                                                                                        Class</label>
                                                                                    @error('class')
                                                                                        <small class="invalid-feedback"
                                                                                            role="alert">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-floating">
                                                                                    <select required name="tag"
                                                                                        class="form-control @error('tag') is-invalid @enderror">
                                                                                        <option>Select tag</option>
                                                                                        @foreach ($tags as $tag)
                                                                                            <option
                                                                                                @selected(true)
                                                                                                value="{{ $tag->id }}">
                                                                                                {{ $tag->tag }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <label for="tag">Tags</label>
                                                                                    @error('tag')
                                                                                        <small class="invalid-feedback"
                                                                                            role="alert">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <div class="">
                                                                                    <label for="title">Resource Description</label>

                                                                                    <textarea class="summernote @error('description') is-invalid @enderror" name="description">{{  $item->description  }}</textarea>
                                                                                    @error('title')
                                                                                        <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $resources->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal for adding esource --}}
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">New Resource</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('resource-store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>Add New Resource</p>
                        <div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror" id="name"
                                            placeholder="Resource title" value="{{ old('title') }}">
                                        <label for="title">Resource Title</label>
                                        @error('title')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="file" name="file"
                                            class="form-control @error('file') is-invalid @enderror" id="file"
                                            placeholder="Resource file" value="{{ old('file') }}">
                                        <label for="title">Resource file</label>
                                        @error('file')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" name="price"
                                            class="form-control @error('price') is-invalid @enderror" placeholder="Price"
                                            min="0" step="100" value="{{ old('price') }}">
                                        <label for="price">Price <small class="text-muted">(Leave empty if it is a free
                                                resource)</small></label>
                                        @error('price')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select required name="subject"
                                            class="form-control @error('subject') is-invalid @enderror">
                                            <option>Select Subject</option>
                                            @foreach ($subjects as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                        <label for="subject">Subject</label>
                                        @error('subject')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select required name="class"
                                            class="form-control @error('class') is-invalid @enderror">
                                            <option>Select Class</option>
                                            @foreach ($classes as $item)
                                                <option value="{{ $item->id }}">{{ $item->class }}</option>
                                            @endforeach

                                        </select>
                                        <label for="class">Select Class</label>
                                        @error('class')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select required name="tag"
                                            class="form-control @error('tag') is-invalid @enderror">
                                            <option>Select tag</option>
                                            @foreach ($tags as $item)
                                                <option value="{{ $item->id }}">{{ $item->tag }}</option>
                                            @endforeach
                                        </select>
                                        <label for="tag">Tags</label>
                                        @error('tag')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="">
                                        <label for="title">Resource Title</label>

                                        <textarea class="summernote @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                        @error('title')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
    </script>
@endsection
