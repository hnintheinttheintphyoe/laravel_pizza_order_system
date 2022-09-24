@extends('user.layouts.master')
@section('content')
<!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5" style="height: 350px;">
                <table class="table table-light table-borderless table-hover text-center mb-0 " id="dataTable">
                    <thead class="thead-dark">
                            <th>Order Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            
                        
                    </thead>
                    <tbody class="align-middle">
                      @foreach ($order as $o)
                      <tr>
                        <td class="align-middle ">{{ $o->created_at->format('j-F-Y') }}</td>
                        <td class="align-middle ">{{ $o->order_code }}</td>
                        <td class="align-middle ">{{ $o->total_price }}</td>
                        <td class="align-middle ">
                            @if($o->status == '0')
                            <span class="text-warning"><i class="fa-solid fa-spinner"></i>Pending</span>
                            @elseif($o->status == '1' )
                            <span class="text-success"><i class="fa-solid fa-check"></i>Accept</span>
                            @elseif($o->status == '2')
                            <span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i>Reject</span>
                            @endif
                        </td>
                        </tr>   
                      @endforeach  
                       
                        
                    </tbody>
                </table>
               <div class="mt-3"> {{ $order->links() }}</div>
            </div>
            
        </div>
    </div>
    <!-- Cart End -->
@endsection
