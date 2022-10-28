<div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <div class="row g-2">
            <div class="col-md-10">
                <form action="{{ route('search') }}" method="GET">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="keyword" class="form-control border-0 py-3" placeholder="Search Keyword">
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0 py-3" name="subject">
                                <option selected>Select Subject</option>
                                @foreach ($subjects as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0 py-3" name="class">
                                <option selected>Select Class</option>
                                @foreach ($classes as $item)
                                <option value="{{ $item->id }}">{{ $item->class }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-light border-0 w-100 py-3">Search</button>
            </div>
        </form>
        </div>
    </div>
</div>