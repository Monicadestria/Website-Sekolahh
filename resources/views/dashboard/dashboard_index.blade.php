@extends('partials.main')

@section('css')
<style>
    .hover-effect:hover {
        transform: scale(1.05);
        transition: transform 0.2s ease-in-out;
    }
</style>
@endsection

@section('content')
    <div class="h3 mt-2 ms-3 ms-md-2 text-bawah-burger-menu">Dashboard</div>

    <div class="row m-0 mt-4">
        <div class="col-auto">
            <select class="form-select" aria-label="" id="select_data">
                {{-- @foreach ($datas as $data) --}}
                <option value="Berita">Berita</option>
                <option value="Unduh">Unduh</option>
                {{-- @endforeach --}}
            </select>
        </div>
        <div class="col col-md-auto">
            <select class="form-select" aria-label="" id="select_diagram">
                <option value="polarArea">Polar Area Diagram</option>
                <option value="bar">Bar Diagram</option>
                <option value="doughnut">Doughnut Diagram</option>
                <option value="pie">Pie Diagram</option>
                <option value="line">Line Diagram</option>
                <option value="radar">Radar Diagram</option>
            </select>
        </div>
    </div>
    <div class="row m-0 justify-content-center align-items-center py-5">
        <div class="col-md-6">
        {{-- @if (!isset($polar['labels']))
            <div class="text-center">
                Belum ada data
            </div>
        @else --}}
            <canvas id="polarAreaChart"></canvas>
            <div class="text-center d-none" id="no-data">
                Belum ada data
            </div>
        {{-- @endif --}}
        </div>

        <div class="col-md-6">
            <div class="d-flex align-items-center">
            <div class="row m-0 justify-content-around align-items-center">
            @foreach ($datas as $data)                
                <a class="col-5 {{ $data['class'] }} rounded-3 text-light py-3 mb-3 hover-effect" href="{{ route($data['route']) }}">
                    <div class="row m-0 justify-content-between">
                        <div class="col">
                            <p class="text-start h5">{{ $data['title'] }}</p>
                        </div>
                        <div class="col-4 text-center">
                            <div class="rounded-3" style="background: rgba(255, 255, 255, 0.2)">
                                <i class="bi bi-ui-radios fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="">
                            <p class="fs-2" >{{ $data['total'] }}</p>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="m-0">
                            <p class="m-0">
                                *Diperbarui dari total data {{ $data['title'] }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
            </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    let dataDiagram = `<?= json_encode($data_diagram); ?>`;
    let polar = {};
    let myChart;
    let label = 'Berita';
    let diagramType = 'polarArea';
    dataDiagram = JSON.parse(dataDiagram);

    try{
        polar = {
            'labels' : dataDiagram['Berita']['labels'],
            'data' : dataDiagram['Berita']['datas'],
        };
    } catch (error) {
        polar = {
            'labels' : null,
            'data' : null,
        };
    }

    diagram();
        
    $(document).on('input', '#select_data', function () {
        try {
            polar = {
                'labels' : dataDiagram[$(this).val()]['labels'],
                'data' : dataDiagram[$(this).val()]['datas'],
            };

            label = $(this).val();
    
            $('#no-data').addClass('d-none');
            $('#polarAreaChart').removeClass('d-none');
            myChart.destroy();
            diagram();
        } catch (error) {
            myChart.destroy();    
            $('#no-data').removeClass('d-none');
            $('#polarAreaChart').addClass('d-none');
        }
    })

    $(document).on('input', '#select_diagram', function () {
        diagramType = $(this).val();

        myChart.destroy();
        diagram();
    })

    function diagram() {
        let canvasDiagram = $('#polarAreaChart').get(0);
        let ctx = canvasDiagram.getContext('2d');

        if(polar['labels'] == null) {
            $('#no-data').removeClass('d-none');
            $('#polarAreaChart').addClass('d-none');
        }

        myChart = new Chart(ctx, {
            type: diagramType,
            data: {
                labels: polar.labels,
                datasets: [{
                    label: label,
                    data: polar.data,
                    borderWidth: 1
                }]
            },
        });
    }
</script>
@endsection