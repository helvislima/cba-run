<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('enrollment.export') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: #ccc; padding: 10px">Exportar matrículas</button>
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
                        </form>
                    @endif
                    <br>
                    <h5>Matrículas realizadas ({{ count($enrollments) }})</h5>
                    <hr>
                    <x-enrollment-table-component :enrollments="$enrollments" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
