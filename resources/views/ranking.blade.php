
<x-app-layout>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('ranking.export') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: #ccc; padding: 10px">Exportar ranking</button>
                    </form>
                    <br>
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
                            <x-ranking-table-component :ranking="$ranking" />
                        </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
