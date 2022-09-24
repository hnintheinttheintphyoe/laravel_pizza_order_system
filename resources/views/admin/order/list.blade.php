@extends('admin.layout.master')
@section('title','Category List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                    
                </div>
                @if(session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
               
                {{-- <div class="d-flex justify-content-between">
                    <h4 class="">Search Key: <span class="text-danger">{{ request('key') }}</span></h4>
                    <form action="{{ route('admin#orderList') }}" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" class="form-control" value="{{ request('key') }}" name="key" placeholder="Search category.....">
                        <button class="btn btn-dark"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div> --}}
                <form action="{{ route('admin#listStatus') }}" method="get">
                    @csrf
                <div class="input-group col-4">
                    <div class=" me-2  mt-2 bg-white p-2 text-center shadow">
                        <h4><i class="fas fa-database fs-5"></i> <span class="text-danger me-2">{{ count($orderList) }}</span></h4>
                    </div>
  <select name="orderStatus" id="inputGroupSelect04" class="form-select ms-1 " >
    <option value="">All</option>
    <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
    <option value="1" @if(request('orderStatus') == '1') selected @endif>Accept</option>
    <option value="2" @if(request('orderStatus') == '2') selected @endif>Reject</option>
   </select>
  
  <button class="btn  bg-dark text-white" type="submit">Search</button>
  
</div>


</form>
               
                
                
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="dataList">
                          @foreach ($orderList as $o)
                            <tr>
                                
                                <td class="col-2">{{ $o->user_id }}
                                <input type="hidden" id="orderId" value="{{ $o->id }}"></td>
                                <td class="col-2">{{ $o->user_name }}</td>
                                <td class="col-2">{{ $o->created_at->format('j-F-Y') }}</td>
                                <td class="col-2"><a href="{{ route('admin#orderProductList',$o->order_code) }}">{{ $o->order_code }}</a></td>
                                <td class="col-2">{{ $o->total_price }}</td>
                                <td class="col-2">
                                    <select name="status" id="" class="form-control changeStatus">

                                        <option value="0" @if($o->status == 0) selected @endif>Pending..</option>
                                        <option value="1" @if($o->status == 1) selected @endif>Accept</option>
                                        <option value="2" @if($o->status == 2) selected @endif>Reject</option>
                                    </select>
                                </td>
                                </tr>  
                          @endforeach  
                        </tbody>

                        
                    </table>
                    <div class="mt-2">
                        {{-- {{ $orderList->links() }} --}}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>
               
                <!-- END DATA TABLE -->
                
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('scriptSource')
<script>
  $(document).ready(function(){
//   $('#orderStatus').change(function(){
//     $status=$('#orderStatus').val();
    
//     $.ajax({
//         type:'get',
//         url:'http://127.0.0.1:8000/admin/order/ajax/status',
//         data:{status : $status},
//         dataType:'json',
//         success:function(response){
//          $list='';
         
//         for($i=0;$i<response.length;$i++){
//            $months=['January','February','March','April','May','June','July','August','September','October','November','December'];
//             $dbDate=new Date(response[$i].created_at);
//            $finalDate= $months[$dbDate.getMonth()]+'-'+$dbDate.getDate()+'-'+$dbDate.getFullYear();
//            $statusMessage='';
//            if(response[$i].status == 0){
//             $statusMessage=`
//          <select name="status" id="" class="form-control changeStatus">
//                         <option value="${response[$i].status}" selected >Pending</option>
//                         <option value="${response[$i].status}" >Accept</option>
//                         <option value="${response[$i].status}" >Reject</option>
                                        
//                                     </select>
//             `;
//            }
//            else if(response[$i].status == 1){
//             $statusMessage=`
//          <select name="status" id="" class="form-control changeStatus">
//                         <option value="${response[$i].status}" selected >Pending</option>
//                         <option value="${response[$i].status}" selected>Accept</option>
//                         <option value="${response[$i].status}" >Reject</option>
                                        
//                                     </select>
//             `;
//            }
//            else if(response[$i].status == 2){
//             $statusMessage=`
//          <select name="status" id="" class="form-control changeStatus">
//                         <option value="${response[$i].status}" selected >Pending</option>
//                         <option value="${response[$i].status}" selected>Accept</option>
//                         <option value="${response[$i].status}" selected>Reject</option>
                                        
//                                     </select>
//             `;
//            }
//             $list+=`
//          <tr>
//                                 <td class="col-2"> ${response[$i].user_id} </td>
//                                 <td class="col-2"> ${response[$i].user_name} </td>
//                                 <td class="col-2"> ${$finalDate} </td>
//                                 <td class="col-2"> ${response[$i].order_code} </td>
//                                 <td class="col-2"> ${response[$i].total_price} </td>
//                                 <td class="col-2">
//                                    ${$statusMessage}
//                                 </td>
//                                 </tr>  
//          `;
//         }
//         $('.dataList').html($list);
//         }
//     })
//   })
  $('.changeStatus').change(function(){
    $parentNode=$(this).parents('tr');
    $currentStatus=$(this).val();
    $orderId=$parentNode.find('#orderId').val();
    $.ajax({
        type:'get',
        url:'http://127.0.0.1:8000/admin/order/ajax/status/change',
        data:{'status':$currentStatus,
              'orderId':$orderId},
        dataType:'json',
        success:function(){

        }      
    })
  })
  });  
    </script>    
@endsection