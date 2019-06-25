 @extends('navbarerp')

@section('main')
    <h1>收款信息</h1>
    <hr/>


    {!! Form::open(['url' => 'finance/receipts', 'class' => 'form-horizontal']) !!}


    @if ($receipts->count())
        <table class="table table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>收款金额</th>
                <th>收款日期</th>
                <th>支付方式</th>
                <th>经办人</th>
                <th>备注</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($receipts as $receipt)
                <tr>
                    <td>
                        {{ $receipt->amount }}
                    </td>
                    <td>
                        {{ $receipt->amount }}
                    </td>
                    <td>
                        {{$receipt->paymethod}}
                    </td>
                    <td>
                        @if(isset( $receipt->user->name)) {{ $receipt->user->name }} @else - @endif
                    </td>
                    <td>
                        {{ $receipt->remark }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/finance/receipts/'.$receipt->id.'/edit') }}" class="btn btn-success btn-sm pull-left">编辑</a>
                        {!! Form::open(array('route' => array('receipts.destroy', $receipt->id), 'method' => 'delete', 'onsubmit' => 'return confirm("确定删除此记录?");')) !!}
                        {!! Form::submit('删除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        {!! $receipts->render() !!}
    @else
        <div class="alert alert-warning alert-block">
            <i class="fa fa-warning"></i>
            {{'无记录', [], 'layouts'}}
        </div>
    @endif

    {!! Form::close() !!}

    @include('errors.list')
@stop

