@props(['enrollments'])

@if(!empty($enrollments))
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Tamanho da camiseta</th>
            <th scope="col">Unidade</th>
            <th scope="col">Data de cadastro</th>
        </tr>
        </thead>
        <tbody>
        @foreach($enrollments as $enrollment)
            <tr>
                <th>{{ $enrollment->user_name }}</th>
                <th>{{ $enrollment->phone }}</th>
                <th>{{ $enrollment->tshirt }}</th>
                <th>{{ $enrollment->unit }}</th>
                <th>{{ date('d/m/Y', strtotime($enrollment->created_at)) }}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
