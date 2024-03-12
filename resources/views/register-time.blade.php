<x-guest-layout>
    <center><h7><strong>Registrar tempo de corrida</strong></h7></center>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        @if(!request()->query('code'))
            <form method="GET" action="">
                @if(session('error'))
                    <div class="mt-3 alert alert-danger alert-dismissible show" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text"><strong>Erro!</strong> {{session('error')[0]}}</span>
                    </div>
                @endif
                @csrf
                <div class="mt-4">
                    <label>Digite sua Matrícula (somente números)</label>
                    <input @if(request()->query('code')) readonly @endif id="name" class="form-control block mt-1 w-full" type="number" name="code" value="{{ request()->query('code') }}" required/>
                </div>
                @if(!request()->query('code'))
                <!-- <div class="card mt-2 " style="font-size: 13px">
                    <div class="card-body">
                        <strong>Corrida virtual 5km - Domingo, Dia 28/05/2023</strong><br>
                        Seu percurso deverá ser registrado por GPS ou aplicativos de corrida e, ser publicado com print de imagem com o tempo da corrida através do link que enviaremos via e-mail.
                        <br>Boa corrida à todos e todas!
                    </div>
                </div> -->
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="btn btn-primary">Próximo</button>
                </div>
                @endif
            </form>
        @endif
        @if(request()->query('code'))
            <form method="POST" action="{{ route('save.time') }}" enctype="multipart/form-data">
                @csrf
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible show" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text"><strong>Erro!</strong> {{session('error')[0]}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible show" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text"><strong>Show!</strong> {{session('success')[0]}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="mt-4">
                    <label for="code"> Matrícula</label>
                    <input @if(request()->query('code')) readonly @endif id="code" class="form-control block mt-1 w-full" type="number" name="code" value="{{ request()->query('code') }}" required/>
                </div>

                <div class="mt-4">
                    <label for="name"> Nome</label>
                    <input readonly id="name" class="form-control block mt-1 w-full" type="text" name="name" value="{{ optional($user)->name}}" required/>
                </div>

                <div class="mt-4">
                    <label for="name"> Unidade</label>
                    <input readonly id="unit" class="form-control" type="text" name="unit" value="{{ optional($user)->unit}}" required/>
                </div>

                <div class="mt-4">
                    <label for="phone"> Tempo de corrida</label>
                    <input type="text" placeholder="HH:MM:SS" onkeypress="formatTime(this)" MaxLength="8" class="form-control" type="text" name="time" required />
                </div>

                <div class="mt-4">
                    <label for="email"> Imagem comprovando o tempo acima</label>
                    <input type="file" name="photo" required/>
                </div>

        
                <div class="card mt-2 " style="font-size: 13px">
                    <div class="card-body">
                        Seu percurso deverá ser registrado por GPS ou aplicativos de corrida e, ser publicado com print de imagem com o tempo da corrida através do formulário acima.
                    </div>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <div class="row">
                        <div class="col-6">
                            <a href=" {{ env('APP_URL') }}"><button type="button" class="btn btn-default">Resetar</button></a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </form>

        @endif
</x-guest-layout>
<style>
    input:read-only {
        font-weight: bold;
        color: #000;
        background: #ccc
    }
</style>
<script>
    function formatTime(timeInput) {

  intValidNum = timeInput.value;

  if (intValidNum < 24 && intValidNum.length == 2) {
      timeInput.value = timeInput.value + ":";
      return false;  
  }
  if (intValidNum == 24 && intValidNum.length == 2) {
      timeInput.value = timeInput.value.length - 2 + "0:";
      return false;
  }
  if (intValidNum > 24 && intValidNum.length == 2) {
      timeInput.value = "";
      return false;
  }

  if (intValidNum.length == 5 && intValidNum.slice(-2) < 60) {
    timeInput.value = timeInput.value + ":";
    return false;
  }
  if (intValidNum.length == 5 && intValidNum.slice(-2) > 60) {
    timeInput.value = timeInput.value.slice(0, 2) + ":";
    return false;
  }
  if (intValidNum.length == 5 && intValidNum.slice(-2) == 60) {
    timeInput.value = timeInput.value.slice(0, 2) + ":00:";
    return false;
  }


  if (intValidNum.length == 8 && intValidNum.slice(-2) > 60) {
    timeInput.value = timeInput.value.slice(0, 5) + ":";
    return false;
  }
  if (intValidNum.length == 8 && intValidNum.slice(-2) == 60) {
    timeInput.value = timeInput.value.slice(0, 5) + ":00";
    return false;
  }



}
</script>