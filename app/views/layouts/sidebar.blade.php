<nav class="navbar container">
    <ul class="navbar-list">
        <li class="navbar-item"><a class="navbar-link" href="{{URL::route('home')}}">Inicio</a></li>

        @if(Route::currentRouteName() != 'home')
        <li class="navbar-item u-pull-right">
            {{ Form::open(array('route' => 'search', 'method' => 'get')) }}
                {{ Form::text('query', null, array('placeholder' => 'Direccion, block o transaccion', 'class' => 'u-full-width-2')) }}
                {{ Form::submit('Buscar') }}
            {{ Form::close() }}
        </li>
        @endif
    </ul>
    <div>
    </div>
</nav>