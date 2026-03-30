@if($blogs->count())
    @foreach ($blogs as $item)
        <div class="col-lg-4 col-sm-12 pr-30 mb-50">
            <div class="grid-4-img color-bg-9">
                <a href="{{ route('blogdetail', ['slug' => $item->slug]) }}">
                    <img src="{{ asset('public/uploads/blog/'.$item->image) }}" alt="">
                </a>
            </div>

            <div class="card-grid-style-4 mt-3">
                <span class="tag-dot mb-2">{{ $item->category }}</span>
                <a class="text-heading-5" href="{{ route('blogdetail', ['slug' => $item->slug]) }}">
                    {{ $item->blog_title }}
                </a>
            </div>
        </div>
    @endforeach
@endif