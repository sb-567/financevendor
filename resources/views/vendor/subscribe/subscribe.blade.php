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
                                                
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1">
                                                            <h5 class="mb-1 fw-semibold">{{ $sub->title }}</h5>
                                                            <p>{{ $sub->offer_text }}</p>
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
                                                                    @if($sub->subscription_type=='1')
                                                                        <span>Day Wise</span>
                                                                    @else
                                                                        <span>Lead Wise</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @if(!empty($sub->subscription_type))
                                                            <li>
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0 text-success me-1">
                                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        @if($sub->time_duration==1)
                                                                            <span>15 Days </span>
                                                                        @elseif($sub->time_duration==2)
                                                                            <span>30 Days </span>
                                                                        @elseif($sub->time_duration==3)
                                                                            <span>365 Days </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0 text-success me-1">
                                                                        <i class="ri-checkbox-circle-fill fs-15 align-middle"></i>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <span>{{ $sub->time_duration }} Days</span>
                                                                    </div>
                                                                </div>
                                                            
                                                            </li>
                                                        @endif
                                                       
                                                    </ul>
                                                    <div class="mt-4">
                                                        <button type="button" onclick="buynow({{ $sub->id }})" class="btn btn-success w-100 waves-effect waves-light">Get started</button>
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


                        <form action="{{ url('payment-success') }}" id="subscribeForm" method="post">

                                    @csrf

                                    <input type="hidden" name="subid" id="razorpay_payment_id">
                                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                                    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                                    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                            
                        </form>

        

    </div>
    <!-- container-fluid -->
</div>


@endsection



@section('customscript')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

    function buynow(id) {

        const data = {
            subscription_id: id
        };

        fetch("{{ route('vendors.getsubcriptiondetail') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify(data)
        })
        .then(async response => {

            const result = await response.json();

            if (response.status === 422) {
                showServerErrors(result.errors, JSON.stringify(data));
                return Promise.reject("validation_error");
            }

            if (!response.ok) {
                return Promise.reject("server_error");
            }

            return result;
        })
        .then(orderData => {
            create_razorpayorder(orderData);
        })
        .catch(err => {

            if (err === "validation_error") {
                console.warn("Validation failed – Razorpay blocked");
                return;
            }

            console.error("Unexpected error:", err);
        });
    }

    function create_razorpayorder(orderData){

        
  console.log('openrzy111', orderData);
         fetch("{{ route('vendors.createOrder') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify(orderData)
        })
        .then(async response => {

            const result = await response.json();

            if (response.status === 422) {
                showServerErrors(result.errors, JSON.stringify(data));
                return Promise.reject("validation_error");
            }

            if (!response.ok) {
                return Promise.reject("server_error");
            }

            return result;
        })
        .then(orderData => {
            openRazorpay(orderData);
        })
        .catch(err => {

            if (err === "validation_error") {
                console.warn("Validation failed – Razorpay blocked");
                return;
            }

            console.error("Unexpected error:", err);
        });


    }

    function openRazorpay(orderData) {

   
//    const data = JSON.parse(pendingOrderData);
   console.log('openrzy', orderData);
   // console.log('openrzy', data.id);

    var options = {
        key: "rzp_test_S6thv6wjP1pgdq",
        amount: orderData.amount,
        currency: "INR",
        name: "LMS",
        description: "Test transaction",
        order_id: orderData.id,
        handler: function (response) {

            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;

            document.getElementById('checkoutForm').submit();
        },
        prefill: {
            name: "{{ $users->name ?? '' }}",
            email: "{{ $users->email ?? '' }}",
            contact: orderData.mobile ?? "{{ $users->mobile ?? '' }}" 
        },
         modal: {
            ondismiss: function () {
                // 🔄 Refresh page when Razorpay is closed
                window.location.reload();
            }
        },
        theme: {
            color: "#F37254"
        }
    };

    new Razorpay(options).open();
}




</script>



    
@endsection

