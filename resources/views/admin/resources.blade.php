@extends('layouts.app')

@section('title', 'Resources')

@section('content')
<div class="breadcrumb-area set-bg" data-setbg="{{ asset('new/img/breadcrumb/breadcrumb-normal.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Resources</h2>
                    <div class="breadcrumb__option">
                        <a href="/admin"><i class="fa fa-home"></i> Dashboard</a>
                        <span>Resources</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="about spad">
    <div class="container">
        <div class="mx-auto mb-5">
            <div class="d-flex justify-content-between">
                <h3 class="">Resources</h3>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNew">New
                    Resource</button>
            </div>
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
                                        <th>Curriculum</th>
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
                                            <td style="text-transform: capitalize">{{ $item->curriculum }}</td>
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
                                                                data-bs-dismiss="modal" aria-label="Close">x</button>
                                                        </div>
                                                        <form method="POST" action="{{ route('resource-update', $item->id) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p>Editing Resource {!! $item->description !!}</p>
                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="title">Resource Title</label>
                                                                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                                                                placeholder="Resource title" value="{{ $item->title }}">
                                                                            @error('title')
                                                                                <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row mx-1">
                                                                            <label for="tag" class="col-12">Curriculum</label>
                                                                            <select required name="curriculum" class="col-12 form-select @error('curriculum') is-invalid @enderror">
                                                                                <option value="new" {{ $item->curriculum == 'new' ? 'selected' : '' }}>New Curriculum</option>
                                                                                <option value="old" {{ $item->curriculum == 'old' ? 'selected' : '' }}>Old Curriculum</option>
                                                                            </select>
                                                                            
                                                                            @error('curriculum')
                                                                                <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="file">Resource File <small>(Leave empty if not updating)</small></label>
                                                                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                                                                                placeholder="Resource file" value="{{ $item->file }}">
                                                                            @error('file')
                                                                                <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                        
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="price">Price <small class="text-muted">(Leave empty if it is a free resource)</small></label>
                                                                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                                                                placeholder="Price" min="0" step="100" value="{{ $item->price }}">
                                                                            @error('price')
                                                                                <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                        
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row mx-1">
                                                                            <label for="subject" class="col-12">Subject</label>
                                                                            <select required name="subject" class="col-12 form-select @error('subject') is-invalid @enderror">
                                                                                <option value="">Select Subject</option>
                                                                                @foreach ($subjects as $subject)
                                                                                    <option value="{{ $subject->id }}" {{ $item->subject_id == $subject->id ? 'selected' : '' }}>
                                                                                        {{ $subject->title }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('subject')
                                                                                <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row mx-1">
                                                                            <label for="class" class="col-12">Select Class</label>
                                                                            <select required name="class" class="col-12 form-select @error('class') is-invalid @enderror">
                                                                                <option value="">Select Class</option>
                                                                                @foreach ($classes as $class)
                                                                                    <option value="{{ $class->id }}" {{ $item->class_id == $class->id ? 'selected' : '' }}>
                                                                                        {{ $class->class }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('class')
                                                                                <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row mx-1">
                                                                            <label for="tag" class="col-12">Tags</label>
                                                                            <select required name="tag" class="col-12 form-select @error('tag') is-invalid @enderror">
                                                                                <option value="">Select Tag</option>
                                                                                @foreach ($tags as $tag)
                                                                                    <option value="{{ $tag->id }}" {{ $item->tag_id == $tag->id ? 'selected' : '' }}>
                                                                                        {{ $tag->tag }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('tag')
                                                                                <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                        
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="description">Resource Description</label>
                                                                            <textarea class="summernote form-control @error('description') is-invalid @enderror"
                                                                                name="description">{{ $item->description }}</textarea>
                                                                            @error('description')
                                                                                <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                                                            @enderror
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
</section>
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
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="title">Resource Title</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror" id="name"
                                            placeholder="Resource title" value="{{ old('title') }}">
                                        @error('title')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row mx-1">
                                        <label for="tag" class="col-12">Curriculum</label>
                                        <select required name="curriculum" class="col-12 form-select @error('curriculum') is-invalid @enderror">
                                            <option value="new" {{ $item->curriculum == 'new' ? 'selected' : '' }}>New Curriculum</option>
                                            <option value="old" {{ $item->curriculum == 'old' ? 'selected' : '' }}>Old Curriculum</option>
                                        </select>
                                        
                                        @error('curriculum')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="title">Resource file</label>
                                        <input type="file" name="file"
                                            class="form-control @error('file') is-invalid @enderror" id="file"
                                            placeholder="Resource file" value="{{ old('file') }}">
                                        @error('file')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="price">Price <small class="text-muted">(Leave empty if it is a free
                                                resource)</small></label>
                                        <input type="number" name="price"
                                            class="form-control @error('price') is-invalid @enderror" placeholder="Price"
                                            min="0" step="100" value="{{ old('price') }}">
                                        @error('price')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-2 row mx-1">
                                        <label for="subject" class="col-12">Subject</label>
                                        <select required name="subject"
                                            class="form-control col-12 @error('subject') is-invalid @enderror">
                                            <option>Select Subject</option>
                                            @foreach ($subjects as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-2 row mx-1">
                                        <label for="class" class="col-12">Select Class</label>
                                        <select required name="class"
                                            class="col-12 form-control @error('class') is-invalid @enderror">
                                            <option>Select Class</option>
                                            @foreach ($classes as $item)
                                                <option value="{{ $item->id }}">{{ $item->class }}</option>
                                            @endforeach

                                        </select>
                                        @error('class')
                                            <small class="invalid-feedback" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-2 row mx-1">
                                        <label for="tag" class="col-12">Tags</label>
                                        <select required name="tag"
                                            class="col-12 form-control @error('tag') is-invalid @enderror">
                                            <option>Select tag</option>
                                            @foreach ($tags as $item)
                                                <option value="{{ $item->id }}">{{ $item->tag }}</option>
                                            @endforeach
                                        </select>
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
