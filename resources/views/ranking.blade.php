
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
                        @if(!request()->query('unit_id'))
                            <h5>Ranking - Corrida Geral (Todas as unidades)</h5>
                            <small>Para ver de cada unidade, use o filtro abaixo</small><p>
                        @else
                            <h5>Ranking - {{$unitNameFiltered}}</h5>
                            <small>Para ver de outra unidade, use o filtro abaixo</small><p>
                        @endif
                            <select onchange="this.form.submit()" name="unit_id" class="form-control" required>
                                <option value="">Filtrar por unidades</option>
                                @foreach($units as $unit)
                                    <option value="{{$unit->id}}" @if($unit->id == request()->query('unit_id')) selected @endif>{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </form>
                        <hr>
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
                                            <th><a href="/public/uploads/{{ $value->photo }}" target="_blank"><img style="max-height: 50px; max-width: 50px; object-fit:cover" width="100" src="/public/uploads/{{ $value->photo }}"></a></th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
