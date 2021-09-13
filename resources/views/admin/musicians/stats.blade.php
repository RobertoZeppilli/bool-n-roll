@extends('layouts.app')

@section('title')
    <title>Bool 'n' Roll - Statistiche {{ $musician->stagename }}</title>
@endsection

@section('content')
<div class="container py-5">
  <div class="py-3">
    
    @if (count($messages) == 0 && count($reviews) == 0)
    <div class="main-height d-flex align-items-center justify-content-center">
      <div class="card text-center d-flex align-items-center justify-content-center p-5 card_review shadow p-3 mb-2 bg-body rounded">
          <div class="check_container d-flex align-items-center justify-content-center">
              <i class="far fa-frown title-orange fa-4x animate__animated animate__bounceIn"></i>
          </div>
          
          <div>
              <h1 class="my-5">Non hai abbastanza dati a disposizione!</h1>
              <p>Sponsorizza il tuo profilo, per renderti più visibile!</p>
          </div>
          <div class="w-100 d-flex justify-content-between">
              <a class="btn btn-yellow text-white" href="{{ route('admin.welcome') }}">
                  Indietro
                </a>
              <a class="btn btn-orange text-white" href="{{ route('admin.musicians.sponsor', Auth::user()->musician->slug) }}">Sponsorizza</a>

          </div>
        </div>

  </div>
    @else
    <h1 class="stat_title pb-5">Le tue statistiche</h1>
    <div class="chart_1 mb-5">
      <h4>Numero di messaggi e recensioni ricevute ogni mese</h4>
      <canvas id="myChart"></canvas>
    </div>
    <div class="chart_1">
      <h4>Voti ricevuti ogni mese</h4>
      <canvas id="myOtherChart"></canvas>
    </div>
    <div class="pt-5">
      <a class="btn btn-yellow text-white" href="{{ route('admin.welcome') }}">
        {{-- <i class="far fa-hand-point-left text-white"></i> --}}
        Indietro
      </a>

    </div>
    @endif

  </div>
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

if(!messaggi[0]) {
   var date2 = now
} 
var primaDataMessaggio = messaggi[0].created_at;

var date2 = dayjs(primaDataMessaggio);

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
            label: 'Recensioni',
            data: recensioniMese,
            backgroundColor: [
                '#08a38f',
            ],
            borderColor: [
                '#08a37f',
            ],
            borderWidth: 1
        },
        {
            label: 'Messaggi',
            data: messaggiMese,
            backgroundColor: [
                '#f7af1a',
            ],
            borderColor: [
                '#f7af1c',
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
        },
        plugins: {
          legend: {
            position: 'right',
            align: 'start',
            labels: {
              color: '#191919',
              font: {
                  size: 14,
                  // weight: 'bold'
              }
            }
          },
          deferred: {           // enabled by default
            xOffset: 150,     // defer until 150px of the canvas width are inside the viewport
            yOffset: '50%',   // defer until 50% of the canvas height are inside the viewport
            delay: 500        // delay of 500 ms after the canvas is considered inside the viewport
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
                '#f08799',
            ],
            borderColor: [
                '#f08798',
            ],
            borderWidth: 1
        },
        {
            label: '2 Stelle',
            data: voto2,
            backgroundColor: [
                '#671649',
            ],
            borderColor: [
               '#671649',
            ],
            borderWidth: 1
        },
        {
            label: '3 Stelle',
            data: voto3,
            backgroundColor: [
                '#ec5e25',
            ],
            borderColor: [
                '#ec5e25',
                
            ],
            borderWidth: 1
        },
        {
            label: '4 Stelle',
            data: voto4,
            backgroundColor: [
                '#301a47',
            ],
            borderColor: [
                '#301a47',
            ],
            borderWidth: 1
        },
        {
            label: '5 Stelle',
            data: voto5,
            backgroundColor: [
                '#68ba93',
            ],
            borderColor: [
                '#68ba93',
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
        },
        plugins: {
          legend: {
            position: 'right',
            align: 'start',
            labels: {
              color: '#191919',
              font: {
                  size: 14,
                  // weight: 'bold'
              }
            }
          },
          deferred: {           // enabled by default
            xOffset: 150,     // defer until 150px of the canvas width are inside the viewport
            yOffset: '50%',   // defer until 50% of the canvas height are inside the viewport
            delay: 900        // delay of 500 ms after the canvas is considered inside the viewport
        }
          
        },

    }
});
</script>
    
@endpush


    
{{-- @endsection --}}
