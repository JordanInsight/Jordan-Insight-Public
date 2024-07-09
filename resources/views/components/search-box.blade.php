@props(['Categories'])
<section class="banner-one" style="background-image: url({{ asset('assets/images/backgrounds/banner-1-1-bg.jpg') }});">
    <div class="container">
        <h2>Find your <span>next tour</span></h2>
        <p>Where would you like to go?</p>
        <form class="tour-search-one" action="{{ route('tour-standard.index') }}" method="GET">
            <div class="tour-search-one__inner">
                <div class="tour-search-one__inputs">
                    <div class="tour-search-one__input-box">
                        <label for="place">Where to</label>
                        <input type="text" placeholder="Enter keywords" name="place" id="place">
                    </div>
                    <div class="tour-search-one__input-box">
                        <label for="when">When</label>
                        <input type="date" name="when" id="when">
                    </div>
                    <div class="tour-search-one__input-box">
                        <label for="type">Type</label>
                        <select class="selectpicker" name="type" id="type">
                            @foreach ($Categories as $Category)
                                <option value="{{ $Category->id }}">{{ $Category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="tour-search-one__btn-wrap">
                    <button type="submit" class="thm-btn tour-search-one__btn">Find now</button>
                </div>
            </div>
        </form>
    </div>
</section>
