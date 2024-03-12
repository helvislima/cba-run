<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(count($runs) > 0)
                        <h5>Histórico de corridas</h5>
                        <form>
                            <select onchange="this.form.submit()" name="run_id" class="form-control" required>
                                <option value="">Selecione a corrida</option>
                                @foreach($runs as $run)
                                    <option value="{{$run->id}}" @if($run->id == $runId) selected @endif>{{$run->name}}</option>
                                @endforeach
                            </select>
                    @endif
                    <br>
                    @if(!empty($runId))
                        <h5>Inscrições realizadas ({{ count($enrollments) }})</h5>
                        <hr>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
