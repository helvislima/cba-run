@props(['ranking'])
@props(['is_export'])

@if(!empty($ranking))
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Posição</th>
            <th scope="col">Nome</th>
            <th scope="col">Unidade</th>
            <th scope="col">Tempo</th>
            <th scope="col">Imagem do tempo</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ranking as $key => $value )
            <tr>
                <th>#{{ $key + 1 }}</th>
                <th>{{ $value->user_name }}</th>
                <th>{{ $value->unit }}</th>
                <th>{{ $value->time }}</th>
                @if(isset($is_export))
                    <th><a href="{{ env('APP_URL') }}/uploads/{{ $value->photo }}" target="_blank">{{ env('APP_URL') }}/uploads/{{ $value->photo }}</a></th>
                @else
                    <th><a href="{{ env('APP_URL') }}/uploads/{{ $value->photo }}" target="_blank"><img src="{{ env('APP_URL') }}/uploads/{{ $value->photo }}" style="height: 50px; width: 50px; object-fit: cover"></a></th>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
