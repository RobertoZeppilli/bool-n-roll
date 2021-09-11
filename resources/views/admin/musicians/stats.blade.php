@extends('layouts.app')

@section('content')
<div class="my_container">
  <h1 class="stat_title">Le tue statistiche</h1>
  @if (count($messages) == 0 && count($reviews) == 0)
      <h2 id="empty_page">Non hai statistiche disponibili</h2>
  @else

  <div class="chart_1">
    <h4>Numero di messaggi e recensioni ricevute ogni mese</h4>
    <canvas id="myChart"></canvas>
  </div>
  <div class="chart_1">
    <h4>Voti ricevuti ogni mese</h4>
    <canvas id="myOtherChart"></canvas>
  </div>
  @endif
  <p class="link_dashboard"><a href="{{ route('admin.welcome') }}">Torna alla Dashboard</a></p>
</div>
@endsection


{{-- push dello script in quello stack in app.blade --}}
@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.10.6/dayjs.min.js" integrity="sha512-bwD3VD/j6ypSSnyjuaURidZksoVx3L1RPvTkleC48SbHCZsemT3VKMD39KknPnH728LLXVMTisESIBOAb5/W0Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>dayjs().format()</script>

<script>

  dayjs().format()
var ctx = document.getElementById('myChart');
var ct2 = document.getElementById('myOtherChart');
var commenti = {!! $reviews->toJson() !!};
var messaggi = {!! $messages->toJson() !!};
// console.log(commenti.length);
// console.log(messaggi.length);
var now = dayjs();
if (commenti[0]) {
  var primaDataCommento = commenti[0].created_at;
  var date1 = dayjs(primaDataCommento);
} else {
  var date1 = now;
}
const primaDataMessaggio = messaggi[0].created_at;
const date2 = dayjs(primaDataMessaggio);
var datex;
if (date2 < date1) {
  datex = date2;
} else {
  datex = date1;
}
var diff = now.diff(datex, 'month');
var diffRece = now.diff(date1, 'month');
var months = [];
var monthsRece = [];
var recensioniMese = [];
var messaggiMese = [];
var voto1 = [];
var voto2 = [];
var voto3 = [];
var voto4 = [];
var voto5 = [];
// prima tabella
var x = 1;
let i = 0;
if (datex.$M == 0) {
  diff++;
  i++;
  x--;
}
for (i; i <= diff; i++) {
  var numeroMese = datex.$M + i + x;
  months.push(numeroMese + '/2021');
  var countRec = 0;
  var countMes = 0;
  for (let j = 0; j < commenti.length; j++) {
    if (numeroMese == dayjs(commenti[j].added_on).$M + 1) {
      countRec++;
    }
  }
  for (let j = 0; j < messaggi.length; j++) {
    if (numeroMese == dayjs(messaggi[j].added_on).$M + 1) {
      countMes++;
   }
  }
  recensioniMese.push(countRec);
  messaggiMese.push(countMes);
}
// seconda tabella
x = 1;
i = 0;
if (date1.$M == 0) {
  diffRece++;
  i++;
  x--;
}
for (i; i <= diff; i++) {
  var numeroMeseRece = date1.$M + i + x;
  monthsRece.push(numeroMeseRece + '/2021');
  var countRece1 = 0;
  var countRece2 = 0;
  var countRece3 = 0;
  var countRece4 = 0;
  var countRece5 = 0;
  for (let j = 0; j < commenti.length; j++) {
    if (numeroMeseRece == dayjs(commenti[j].created_at).$M + 1) {
      switch (commenti[j].vote) {
        case 1:
          countRece1++;
          break;
        case 2:
          countRece2++;
          break;
        case 3:
          countRece3++;
          break;
        case 4:
          countRece4++;
          break;
        case 5:
          countRece5++;
          break;
        default:
          break;
      }
    }
  }
  voto1.push(countRece1);
  voto2.push(countRece2);
  voto3.push(countRece3);
  voto4.push(countRece4);
  voto5.push(countRece5);
}
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [
          {
            label: 'Numero di recensioni',
            data: recensioniMese,
            backgroundColor: [
                '#0000ff8c',
            ],
            borderColor: [
                '#0000ff',
            ],
            borderWidth: 1
        },
        {
            label: 'Numero di messaggi ricevuti',
            data: messaggiMese,
            backgroundColor: [
                '#ff00c88c',
            ],
            borderColor: [
                '#ff00c8',
            ],
            borderWidth: 1
        },
      ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                stepSize: 1
              }
            }
        }
    }
});
var myChart = new Chart(ct2, {
    type: 'bar',
    data: {
        labels: monthsRece,
        datasets: [
          {
            label: '1 Stella',
            data: voto1,
            backgroundColor: [
                '#ff00008c',
            ],
            borderColor: [
                'red',
            ],
            borderWidth: 1
        },
        {
            label: '2 Stelle',
            data: voto2,
            backgroundColor: [
                '#ffa6008c',
            ],
            borderColor: [
                'orange',
            ],
            borderWidth: 1
        },
        {
            label: '3 Stelle',
            data: voto3,
            backgroundColor: [
                '#ffff008c',
            ],
            borderColor: [
                'yellow',
            ],
            borderWidth: 1
        },
        {
            label: '4 Stelle',
            data: voto4,
            backgroundColor: [
                '#b7dd298c',
            ],
            borderColor: [
                '#b7dd29',
            ],
            borderWidth: 1
        },
        {
            label: '5 Stelle',
            data: voto5,
            backgroundColor: [
                '#57e32c8c',
            ],
            borderColor: [
                '#57e32c',
            ],
            borderWidth: 1
        },
      ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                stepSize: 1
              }
            }
        }
    }
});
</script>
    
@endpush


    
{{-- @endsection --}}
