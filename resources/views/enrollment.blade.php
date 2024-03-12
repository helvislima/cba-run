<x-mail::message>
<p>Olá {{$user->name}},</p>
<p>Sua inscrição foi concluída! Parabéns, o seu primeiro passo pela diversidade foi dado.</p>
<p><strong>Domingo, Dia 28 de Maio de 2023</strong></p>
<p>Não esqueça de se preparar, baixe o Strava ou prepare o  APP e GPS de sua preferência, para registrar sua corrida.</p>
<hr>
<h3>Seus dados cadastrados:</h3>
<strong>Unidade</strong>: {{$user->unit}}<br>
<strong>Tamanho de camisa</strong>: {{$enrollment->tshirt}}<br>
<strong>Telefone: </strong>{{$enrollment->phone}}<br>
<br>
Obrigado,<br>
{{ env('APP_NAME') }}
</x-mail::message>
