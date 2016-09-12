@extends('layouts.master')

@section('title')
    Explorer - Address {{$summary['address']}}
@stop

@section('content')

    <section>
        <div class="container">
            <img src="http://soygeek.org/wp-content/themes/firsty/images/logo.svg" style="width: 30%; height: 30%">
            <h1>Direccion de Bitcoin</h1>
            <div class="section-heading">{{$summary['address']}}</div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2 class="section-heading">Resumen</h2>
            <div class="row">
                <div class="six columns"><b>Direccion:</b> {{$summary['address']}}</div>
                <div class="three columns">
                    @if($summary['category'])
                    <b>Tag:</b> {{$summary['category']}}: {{$summary['tag']}}
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="three columns"><b>Balance:</b> <span class="btc-value">@toBTC($summary['balance'])</span> BTC</div>
            </div>
        </div>
    </section>

    <section class="address-transactions">
        <div class="container">
            <div class="row">
                <div class="one-third column">
                    <h2>Transacciones</h2>
                    <div class="margin-b">
                        <h5 class="no-margin">Recibidas</h5>
                        <div><b>Total:</b> {{$summary['total_transactions_in']}}</div>
                        <div><b>Cantidad:</b> <span class="btc-value">@toBTC($summary['received'])</span> BTC</div>
                        <div><b>No Confirmadas:</b> <span class="btc-value">@toBTC($summary['unconfirmed_received'])</span> BTC</div>
                    </div>
                    <div class="margin-b">
                        <h5 class="no-margin">Sent</h5>
                        <div><b>Total:</b> {{$summary['total_transactions_out']}}</div>
                        <div><b>Cantidad:</b> <span class="btc-value">@toBTC($summary['sent'])</span> BTC</div>
                        <div><b>No Confirmadas:</b> <span class="btc-value">@toBTC($summary['unconfirmed_sent'])</span> BTC</div>
                    </div>
                </div>
                <div class="two-thirds column">
                    <div class="scroll-window">
                        <table class="u-full-width fixed-header transactions">
                            <thead>
                                <tr>
                                    <th><div>Fecha</div></th>
                                    <th><div>Cantidad <small>(Satoshi)</small></div></th>
                                    <th><div>Confirmaciones</div></th>
                                    <th><div>Receptor</div></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>Fecha</td>
                                    <td>Cantidad <small>(Satoshi)</small></td>
                                    <td>Confirmaciones</td>
                                    <td>Receptor</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($transactions as $tx)
                                    @foreach ($tx['outputs'] as $txout)
                                        @if($txout['address'] == $summary['address'])
                                        <tr>
                                            <td>@datetime($tx['time'])</td>
                                            <td class="output">+{{$txout['value']}}</td>
                                            <td>{{$tx['confirmations']}}</td>
                                            <td>-</td>
                                            <td><a href="{{ URL::route('transaction', $tx['hash']) }}">Informacion de Transaccion</a> </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($tx['inputs'] as $txin)
                                        @if($txin['address'] == $summary['address'])
                                        <tr>
                                            <td>@datetime($tx['time'])</td>
                                            <td class="input">-{{$txin['value']}}</td>
                                            <td>{{$tx['confirmations']}}</td>
                                            <td><a href="{{ URL::route('address', $txin['address']) }}">{{ substr($txin['address'], 0, 8)}}</a>...</td>
                                            <td><a href="{{ URL::route('transaction', $tx['hash']) }}">Informacion de Transaccion</a> </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $transactions->links() }}
            </div>
        </div>
    </section>

   
    <section></section>
@stop
