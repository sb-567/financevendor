@extends('website.master')
@section('title',''.$title)

@section('content')

  <main class="main">
      <section class="section-box">
        <div class="banner-hero banner-breadcrums">
          <div class="container text-center">
            <h1 class="text-heading-2 color-gray-1000 mb-20">Blogs</h1>
            

            <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb justify-content-center bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Blogs
                        </li>
                    </ul>
                </nav>

          </div>
        </div>
      </section>
    
      
       <section class="section-box">
       
        <div class="container mt-90">
         

           <div class="row" id="blog-data">
              @include('website.partials.blog_data')
          </div>

          <div class="mt-20 mb-30 text-center">
              @if ($blogs->hasMorePages())
                  <button id="load-more" data-page="2" class="btn btn-black icon-arrow-right-white">
                      Load more posts
                  </button>
              @endif
          </div>
          
        </div>



        
        
      </section>

     


   

@endsection



@section('customscript')

<script>
$(document).ready(function () {

    $('#load-more').on('click', function () {
        let button = $(this);
        let page = button.data('page');

        $.ajax({
            url: "?page=" + page,
            type: "GET",
            beforeSend: function () {
                button.text('Loading...');
            },
            success: function (data) {

                if (data.trim() === '') {
                    button.hide();
                    return;
                }

                $('#blog-data').append(data);
                button.data('page', page + 1);
                button.text('Load more posts');
            }
        });
    });

});
</script>
    
@endsection