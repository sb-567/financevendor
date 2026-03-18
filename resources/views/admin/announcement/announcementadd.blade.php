@extends('admin.master')
@section('title',''.$title)

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">{{ ucfirst($title) }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">{{ ucfirst($title) }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
         


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">{{ ucfirst($title) }}</h4>
                            
                        </div><!-- end card header -->
                        <div class="card-body">
                            
                            
                                <form method="post" action="{{route('admin.announcementsave')}}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <input type="hidden" name="id" value="@if(!empty($fetched->id)){{$fetched->id}}@endif" >
                                            <div class="mb-3">
                                                <label for="VertimeassageInput" class="form-label">Message</label>
                                                <textarea class="form-control tinymce" name="message" id="VertimeassageInput" rows="3" placeholder="Enter your message">@if(!empty($fetched->message)){{$fetched->message}}@endif</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="StartleaveDate" class="form-label">Start  Date</label>
                                                <input type="text" name="start_date" class="form-control flatpickr-input active" data-provider="flatpickr" value="@if(!empty($fetched->start_date)){{$fetched->start_date}}@endif" id="StartleaveDate" readonly="readonly" fdprocessedid="ifanho">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="StartleaveDate" class="form-label">End Date</label>
                                                <input type="text" name="end_date" class="form-control flatpickr-input active" data-provider="flatpickr" id="StartleaveDate" value="@if(!empty($fetched->end_date)){{$fetched->end_date}}@endif" readonly="readonly" fdprocessedid="ifanho">
                                            </div>
                                        </div>
                                        
                                

                                        <div class="col-lg-4">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                                             
                                                    <option value="1"  @if(!empty($fetched->status) && $fetched->status==1){{"selected"}}@endif>Active</option>
                                                    <option value="2"  @if(!empty($fetched->status) && $fetched->status==2){{"selected"}}@endif>Inactive</option>
                                                   
                                            </select>
                                            <label for="floatingSelect">Status</label>
                                        </div>
                                    </div>

                                        
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>

        

    </div>
    <!-- container-fluid -->
</div>


@endsection


@section('customscript')
<script>
 

//      document.querySelectorAll('.ckeditor').forEach(function (el) {
//     CKEDITOR.replace(el, {
//         allowedContent: true,   // allow all HTML
//         height: 200,
//           versionCheck: false
//     });
// });

tinymce.init({
    selector: '.tinymce',
    height: 300,

    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image',
        'charmap', 'preview', 'searchreplace',
        'code', 'fullscreen', 'media', 'table',
        'emoticons', 'wordcount'
    ],

    toolbar:
        'undo redo | blocks | bold italic underline | ' +
        'alignleft aligncenter alignright | bullist numlist | ' +
        'emoticons | image media table | code fullscreen',

    menubar: false,

    emoticons_database: 'emojis',   // full emoji set 😀
});

</script>
@endsection
