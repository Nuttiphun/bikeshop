@extends("layouts.master")
@section('content')
<div class="container">
    <h1>ชําระเงิน</h1>

        <div class="breadcrumb">
            <li><a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> หน้าร้าน</a></li>
            <li><a href="{{ URL::to('cart/view') }}">สินค้าในตะกร้า</a></li>
            <li class="active">ชําระเงิน</li>
        </div>
        <div class="row">
            <div class="col-md-6">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>ข้อมูลลูกค้า </strong>
                        </div>
                    </div>
                    <table class="table table-bordered bs_table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>รหัส</th>
                                <th>ชื่อสินค้า </th>
                                <th>จํานวน</th>
                                <th class="bs-price">ราคา</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            <?php $sum_price = 0; $sum_qty = 0; ?>
                            @foreach($cart_items as $c)
                            <tr>
                                <td><img src="{{ asset($c['image_url']) }}" width="32"></td>
                                <td>{{ $c['code'] }}</td>
                                <td>{{ $c['name'] }}</td>
                                <td>{{ number_format($c['qty'], 0) }}</td>
                                <td class="bs-price">{{ number_format($c['price'], 0) }}</td>
                            </tr>
                            <?php $sum_price += $c['price'] ?>
                            <?php $sum_qty += $c['qty'] ?>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th colspan="3">รวม</th>
                                <th>{{ number_format($sum_qty, 0) }}</th>
                                <th class="bs-price">{{ number_format($sum_price, 0) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <strong>ข้อมูลลูกค้า </strong>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form id="formCheckout" action="./finish" method="POST">
                            @csrf
                            <input name="cust_userid" type="text" 
                            id="cust_userid" value="{{Auth::user()->id}}" 
                            readonly hidden />

                            <div class="form-group">
                                <label>ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" 
                            name="cust_name" id="cust_name" placeholder="ชื่อ-นามสกุล" 
                            value="{{Auth::user()->name}}">
                            </div>

                            <div class="form-group">
                                <label>อีเมล</label>
                            <input type="text" class="form-control" 
                            name="cust_email" id="cust_email" placeholder="อีเมล์ของท่าน"
                            value="{{Auth::user()->email}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ URL::to('cart/view') }}" class="btn btn-default">ย้อนกลับ </a>
        <div class="pull-right">
             {{-- <a href="javascript:complete()" class="btn btn-warning">พิมพ์ใบสั่งซื้อ</a> --}}
            <a id="btnFinish" href="#" class="btn btn-primary"><i class="fa fa-check"></i> จบการขาย</a>
        </div>
</div>

<script type="text/javascript"> 
    function complete() {
        window.open (
            "{{ URL::to('cart/complete') }}?cust_name="+ $('#cust_name').val() + '&cust_email='
            + $('#cust_email').val(), 
            "_blank",
        );
    }

    setTimeout(() => {
        document.querySelector('#btnFinish').addEventListener('click', () => {
            
            let cust_name = document.querySelector('#cust_name').value;
            let cust_email = document.querySelector('#cust_email').value;

            if(cust_name == '' || cust_email == ''){
                alert('กรุณากรอกข้อมูลลูกค้า');
                return;
            }

            let formCheckout = document.querySelector('#formCheckout');

            formCheckout.action = './finish'
            formCheckout.submit();

        });

    }, 1000);


</script>
@stop