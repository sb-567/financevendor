@extends('vendor.master')
@section('title',''.$title)

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">{{ $title }} List</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">{{$title}} List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row justify-content-center">
                        <div class="col-xl-9">
                            <div class="row">
                                
                                @if ($subscribe->count() != 0)

                                @foreach ($subscribe as $sub)
                                
                               
                                    <div class="col-lg-4">
                                        <div class="card pricing-box ribbon-box right">
                                            <div class="card-body p-4 m-2">
                                                <div class="ribbon-two ribbon-two-danger"><span>{{ $sub->offer_text }}</span></div>
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="mb-1 fw-semibold">{{ $sub->title }}</h5>
                                                            <p class="text-muted mb-0">Professional plans</p>
                                                        </div>
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-light rounded-circle text-primary">
                                                                <i class="ri-medal-line fs-20"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-4">
                                                        <h2><sup><small>₹</small></sup> {{ $sub->price }}<span class="fs-13 text-muted">/Month</span></h2>
                                                        <h3><sup><small>₹</small></sup> {{ $sub->cross_price }}<span class="fs-13 text-muted">/Month</span></h3>
                                                    </div>
                                                </div>
                                                <hr class="my-4 text-muted">
                                                <div>
                                                    <ul class="list-unstyled vstack gap-3 text-muted">
                                                        <li>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 text-success me-1">
                                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    Upto <b>15</b> Projects
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 text-success me-1">
                                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <b>Unlimited</b> Customers
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 text-success me-1">
                                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    Scalable Bandwidth
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 text-success me-1">
                                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <b>12</b> FTP Login
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 text-success me-1">
                                                                    <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <b>24/7</b> Support
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 text-danger me-1">
                                                                    <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <b>Unlimited</b> Storage
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="d-flex">
                                                                <div class="flex-shrink-0 text-danger me-1">
                                                                    <i class="ri-close-circle-fill fs-15 align-middle"></i>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    Domain
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="mt-4">
                                                        <a href="javascript:void(0);" class="btn btn-success w-100 waves-effect waves-light">Get started</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     @endforeach
                                
                                @endif
                                
                                <!--end col-->
                                
                            </div>
                            <!--end row-->
                        </div>
                        <!--end col-->
                    </div>

        

    </div>
    <!-- container-fluid -->
</div>


@endsection



@section('customscript')
    
@endsection

