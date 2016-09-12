@extends('layouts.master')

@section('title')
    A Simple Block Explorer
@stop

@section('content')

    <section>
        <div class="container">
          <img src="http://soygeek.org/wp-content/themes/firsty/images/logo.svg" style="width: 50%; height: 50%">
                <h1>Mi primer explorador de blockchain</h1>
            <p>
                Ejemplo utilizando el API de BlockTrail para crear un explorador.
            </p>
            {{ Form::open(array('route' => 'search', 'method' => 'get')) }}
                <div class="row">
                    <div class="ten columns">
                        {{ Form::text('query', null, array('placeholder' => 'Direccion, block hash/Numero o transaccion', 'class' => 'u-full-width')) }}
                    </div>
                    <div class="two columns">
                        {{ Form::submit('Buscar', array('class' => 'button button-primary')) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </section>

    <section>
        <div class="container">
            <h3 class="section-heading">Ultimos Bloques de Bitcoin</h3>
            <table class="u-full-width blocks">
                <thead>
                    <tr>
                        <th><div>Numero/Altura</div></th>
                        <th><div>Fecha</div></th>
                        <th><div>Transacciones</div></th>
                        <th><div>Tamaño</div></th>
                        <th><div></div></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blocks['data'] as $block)
                    <tr>
                        <td>#{{$block['height']}}</td>
                        <td>@datetime($block['block_time'])</td>
                        <td>{{$block['transactions']}}</td>
                        <td>{{$block['byte_size']}} bytes</td>
                        <td><a href="{{ URL::route('block', $block['hash']) }}">Inspeccionar Block</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    

    <section></section>
@stop
