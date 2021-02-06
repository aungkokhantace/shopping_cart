@extends('layouts.frontend_master')

@section('content')
<div class="main-panel-without-sidebar">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title">SHOPPING CART</h4>
                                
                                    <!-- start contine_shopping button -->
                                    <a href="/frontend/items"><button type="button" class="btn btn-primary mr-2">
                                            << Continue Shopping </button> </a> <!-- end contine_shopping button -->

                                <div class="table-responsive pt-3">
                                    <!-- start table -->
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Name</th>
                                                <th width="20%">Qty</th>
                                                <th>Amount</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0 ?>

                                            @if(session('cart'))
                                            @foreach(session('cart') as $id => $details)

                                            <?php $total += $details['price'] * $details['quantity'] ?>

                                            <tr>
                                                <td>{{ $details['name'] }}</td>
                                                <td>
                                                    <input type="number" value="{{ $details['quantity'] }}" class="quantity" />
                                                </td>
                                                <td align="right">${{ $details['price'] * $details['quantity'] }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm update_cart" data-id="{{ $id }}"><i class="mdi mdi-refresh"></i></button>
                                                    <button class="btn btn-danger btn-sm remove_from_cart" data-id="{{ $id }}"><i class="mdi mdi-delete"></i></button>
                                                </td>
                                            </tr>

                                            @endforeach
                                            @endif
                                            <tr class="table-info">
                                                <td></td>
                                                <td>Total Amount</td>
                                                <td align="right">${{$total}}</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- end table -->
                                    
                                    <!-- start payment button -->
                                    <form class="checkout_form" action="/checkout" method="post">
                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-info checkout_button" data-toggle="tooltip" data-placement="top" title="Checkout">
                                            Payment
                                        </button>
                                    </form> <!-- end payment button -->
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @endsection

    @section('scripts')
    <script type="text/javascript">
        window.onload = function() {
            console.log('this is on load');
            if (window.jQuery) {
                // jQuery is loaded  
                alert("Yeah!");
            } else {
                // jQuery is not loaded
                alert("Doesn't Work");
            }
        }

        $(".update_cart").click(function(e) {
            // e.preventDefault();
            var ele = $(this);

            $.ajax({
                // url: "'{{ url("update_cart") }}'",
                url: "/update_cart",
                method: "put",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
        $(".remove_from_cart").click(function(e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('
                    remove - from - cart ') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
    @endsection
