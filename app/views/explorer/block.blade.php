@extends('layouts.master')

@section('title')
    Explorer - Block {{$block['hash']}}
@stop

@section('content')

    <section>
        <div class="container">
                <img src="http://soygeek.org/wp-content/themes/firsty/images/logo.svg" style="width: 30%; height: 30%">
            <h1>Bitcoin Block</h1>
            <div>{{$block['hash']}}</div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2 class="section-heading">Resumen</h2>
            <div class="row">
                <div class="three columns"><b>Fecha del block: </b>@datetime($block['block_time'])</div>
                <div class="three columns"><b>Numero/Altura:</b> {{$block['height']}}</div>
                <div class="three columns"><b>Transacciones:</b> {{$block['transactions']}}</div>
                <div class="three columns"><b>Tamaño:</b> {{$block['byte_size']}} bytes</div>
            </div>
            <div class="row">
                <div class="three columns"><b>Confirmaciones:</b> {{$block['confirmations']}}</div>
                <div class="three columns"><b>Rechazado:</b> {{$block['is_orphan'] ? 'yes' : 'no'}}</div>
            </div>
            <div class="row margin-t">
                <div class="three columns">
                    @if($block['prev_block'])
                    <b>Block Previo: </b>#<a href="{{ URL::route('block', $block['prev_block']) }}">{{$block['height']-1}}</a>
                    @endif
                </div>
                <div class="three columns">
                    @if($block['next_block'])
                    <b>Block Siguiente: </b>#<a href="{{ URL::route('block', $block['next_block']) }}">{{$block['height']+1}}</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="block-transactions">
        <div class="container">
            <div class="row">
                <div class="one-third column">
                    <h2>Transacciones</h2>
                    <div class="row">
                        <div><b>Total de transacciones:</b> {{$block['transactions']}}</div>
                        <div><b>Valor:</b> <span class="btc-value">@toBTC($block['value'])</span> BTC</div>
                    </div>
                </div>
                <div class="two-thirds column">
                    <div class="scroll-window">
                        <table class="u-full-width fixed-header transactions">
                            <thead>
                                <tr>
                                    <th><div>Total de Entrada</div></th>
                                    <th><div>Total de Salida</div></th>
                                    <th><div>Comision de la transacciones</div></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>Total de Entrada</td>
                                    <td>Total de Salida</td>
                                    <td>Comision de la transacciones<</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($transactions as $tx)
                                <tr>
                                    <td>{{$tx['total_input_value']}}</td>
                                    <td>{{$tx['total_output_value']}}</td>
                                    <td class="input">{{$tx['total_fee']}}</td>
                                    <td><a href="{{ URL::route('transaction', $tx['hash']) }}">Ver Transaccion</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </section>

    

    <section></section>
@stop
