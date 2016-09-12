@extends('layouts.master')

@section('title')
    Explorer - Transaction {{$hash}}
@stop
@section('content')

    <section>
        <div class="container">
            <img src="http://soygeek.org/wp-content/themes/firsty/images/logo.svg" style="width: 30%; height: 30%">
            <h1>Bitcoin Transacciones</h1>
            <div>{{$hash}}</div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2 class="section-heading">Resumen</h2>
            <div class="row">
                <div class="four columns"><b>Valor Estimado: </b><span class="btc-value">@toBTC($estimated_value)</span> BTC</div>
                <div class="three columns"><b>Confirmaciones: </b>{{$confirmations}}</div>
                <div class="three columns"><b>Revision: </b>@datetime($first_seen_at)</div>
            </div>
            <div class="row">
                <div class="four columns"><b>Comision de transaccion: </b><span class="btc-value">@toBTC($total_fee)</span> BTC</div>
                @if ($block_hash)
                <div class="three columns"><b>Block: </b>#<a href="{{ URL::route('block', $block_hash) }}">{{$block_height}}</a></div>
                @endif
            </div>
        </div>
    </section>

    <section class="address-transactions">
        <div class="container">
            <div class="row">
                <div class="one-third column">
                    <h2>Entrada</h2>
                    <div><b>Total:</b> {{ count($inputs) }}</div>
                    <div><b>Cantidad:</b> <span class="btc-value">@toBTC($total_input_value)</span> BTC</div>
                </div>
                <div class="two-thirds column scroll-window">
                    <table class="u-full-width fixed-header inputs">
                        <thead>
                            <tr>
                                <th><div>Cantidad <small>(Satoshi)</small></div></th>
                                <th><div>Origen</div></th>
                                <th><div>Transaccion Original</div></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td>Cantidad <small>(Satoshi)</small></td>
                                <td>Origen</td>
                                <td>Transaccion Original</td>
                                <td></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($inputs as $input)
                            <tr>
                                <td class="input">{{$input['value']}}</td>
                                <td>
                                    @if($input['address'])
                                    <a href="{{ URL::route('address', $input['address']) }}">{{ substr($input['address'], 0, 8)}}</a>...
                                    @else
                                    - 
                                    @endif
                                </td>
                                <td>
                                    @if($input['output_hash'])
                                    <a href="{{ URL::route('transaction', $input['output_hash']) }}">{{ substr($input['output_hash'], 0, 8)}}</a>...
                                    @else
                                    coinbase
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <section class="address-transactions">
        <div class="container">
            <div class="row">
                <div class="one-third column">
                    <h2>Salidas</h2>
                    <div><b>Total:</b> {{ count($outputs) }}</div>
                    <div><b>Cantidad:</b> <span class="btc-value">@toBTC($total_output_value)</span> BTC</div>
                </div>
                <div class="two-thirds column scroll-window">
                    <table class="u-full-width fixed-header outputs">
                        <thead>
                            <tr>
                                <th><div>Cantidad <small>(Satoshi)</small></div></th>
                                <th><div>Receptor</div></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td>Cantidad <small>(Satoshi)</small></td>
                                <td>Receptor</td>
                                <td></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($outputs as $output)
                            <tr>
                                <td class="output">{{$output['value']}}</td>
                                <td><a href="{{ URL::route('address', $output['address']) }}">{{ substr($output['address'], 0, 8)}}</a>...</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

   
    <section></section>
@stop
