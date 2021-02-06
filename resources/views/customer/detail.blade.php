@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">CUSTOMER DETAIL</h4>

                        <!-- buttons -->
                        <a href="/customers"><button type="button" class="btn btn-primary mr-2">
                                << Back to customer list</button> </a> <!-- buttons -->

                                    <!-- start form -->
                                    @if(isset($customer))
                                    <!-- update route -->
                                    <form class="forms-sample" id="customer_form" method="post" action="/customers/{{$customer->id}}">
                                        <!-- form method spoofing -->
                                        {{ method_field('PUT') }}

                                        <input type="hidden" id="id" name="id" value="{{$customer->id}}">

                                        @else
                                        <!-- store route -->
                                        <form class="forms-sample" id="customer_form" method="post" action="/customers">
                                            @endif

                                            {{ csrf_field() }}

                                            <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                            <input type="hidden" id="module" name="module" value="customers">

                                            <!-- start name field -->
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" readonly class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" autofocus="autofocus" placeholder="Enter customer name" value="{{ isset($customer)? $customer->name : old('name') }}">
                                                <!-- validation error message -->
                                                <p class="text-danger">{{$errors->first('name')}}</p>
                                            </div>
                                            <!-- end name field -->

                                            <!-- start email field -->
                                            <div class="form-group">
                                                <label for="name">Email</label>
                                                <input type="text" readonly class="form-control {{$errors->has('price') ? 'is-invalid' :''}}" id="email" name="email" placeholder="Enter email" value="{{ isset($customer)? $customer->email : old('email') }}">
                                                <!-- validation error message -->
                                                <p class="text-danger">{{$errors->first('email')}}</p>
                                            </div>
                                            <!-- end email field -->

                                        </form>
                                        <!-- end form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @endsection

    @section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Entry and Edit Form
            $('#customer_form').validate({
                rules: {
                    name: 'required',
                    price: 'required',
                },
                messages: {
                    name: 'Item name is required',
                    price: 'Item price is required',
                },
                submitHandler: function(form) {
                    // disable submit button after first click
                    $(':submit').prop("disabled", true);
                    form.submit();
                }
            });
            //End Validation for Entry and Edit Form
        });
    </script>
    @endsection
