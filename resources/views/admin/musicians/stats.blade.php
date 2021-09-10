@extends('layouts.app')

@section('content')

<div class="container">
  <h1>Le tue statistiche</h1>
  @if (count($messages) == 0 && count($reviews) == 0)
      <h2 id="empty_page">Non hai statistiche disponibili</h2>
  @else

  <div class="chart_1">
    <h4>Numero di messaggi e recensioni ricevute ogni mese</h4>
    <canvas id="myChart"></canvas> {{-- tag canvas del "plug-in" che fa le chart con id="ide della chart sotto" --}}
  </div>
  <div class="chart_1">
    <h4>Voti ricevuti ogni mese</h4>
    <canvas id="myOtherChart"></canvas> {{-- tag canvas del "plug-in" che fa le chart con id="ide della chart sotto" --}}
  </div>
  @endif
  <a class="btn btn-grad" href="{{ route('admin.welcome') }}">Torna alla Dashboard</a>{{-- BTN CHE VA INDIETRO --}}
</div>

@endsection