@extends('layouts.frontend_master')

@section('content')
<div class="main-panel-without-sidebar">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">SHOPPING CART</h4>

                        <!-- start contine_shopping button -->
                        <a href="/view_transactions"><button type="button" class="btn btn-primary mr-2">
                                << Back to transaction list </button> </a> <!-- end contine_shopping button -->

                                    <div class="table-responsive pt-3">
                                        <!-- start table -->
                                        <table class="table table-bordered table-striped">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Name</th>
                                                    <th width="20%">Qty</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($transaction_details as $detail)
                                                <tr>
                                                    <td>{{ $detail->item->name }}</td>
                                                    <td>{{ $detail->qty }}</td>
                                                    <td align="right">${{number_format($detail->price * $detail->qty, 2, '.', '') }}</td>
                                                </tr>
                                                @endforeach
                                                <tr class="table-info">
                                                    <td></td>
                                                    <td>Total Amount</td>
                                                    <td align="right">${{ number_format($transaction->total_amount, 2, '.', '') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- end table -->
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
