<section class="hero set-bg" data-setbg="{{ asset('new/img/hero/hero-bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero__text">
                    <div class="section-title">
                        <h2>Discover Diverse UNEB Resources</h2>
                        <p class="text-light">Explore a vast collection of past papers, solutions, mocks, assignments, exercises, tests, and termly examinations tailored to UNEB syllabi.</p>
                    </div>
                    <div class="hero__search__form">
                        <form action="{{ route('search') }}" method="GET">
                            <input type="text" name="keyword" placeholder="Search...">
                            <div class="select__option">
                                <select name="subject">
                                    <option value="">Choose Subject</option>
                                    @foreach ($subjects as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="select__option">
                                <select name="class">
                                    <option value="">Choose Class</option>
                                    @foreach ($classes as $item)
                                        <option value="{{ $item->id }}">{{ $item->class }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
