@extends('navbarerp')

@section('main')
    <h1>付款信息</h1>
    <hr/>


    {!! Form::open(['url' => 'finance/payments', 'class' => 'form-horizontal']) !!}

    @if ($payments->count())
        <table class="table table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>付款金额</th>
                <th>付款日期</th>
                <th>经办人</th>
                <th>支付方式</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr>
                     <td>
                        {{ $payment->amount }}
                    </td>
                    <td>
                        {{ $payment->paydate }}
                    </td>
                    <td>
                        @if(isset( $payment->user->name)) {{ $payment->user->name }} @else - @endif
                    </td>
                    <td>
                        {{ $payment->paymethod}}
                    </td>
                    <td>
                        {{ $payment->remark }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/finance/payments/'.$payment->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>
                        {!! Form::open(array('route' => array('payments.destroy', $payment->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                        {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        {!! $payments->render() !!}
    @else
        <div class="alert alert-warning alert-block">
            <i class="fa fa-warning"></i>
            {{'无记录', [], 'layouts'}}
        </div>
    @endif

    {!! Form::close() !!}


    @include('errors.list')
@stop

