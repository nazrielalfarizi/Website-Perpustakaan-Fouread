@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>
    @can('siswa')
    <section class="mt-5 container" id="kategori"><h4 class="text-secondary text-center text-thin mt-5 mb-4">Pilih subjek yang menarik bagi Anda</h4> 
    <ul class="topic d-flex flex-wrap justify-content-center px-0"><li class="d-flex justify-content-center align-items-center m-2">
        <a id="kategori-btn" data-id="" class="d-flex flex-column"><img src="{{ asset('assets/8-books.png') }}" width="80" class="mb-3 mx-auto">Kesusastraan</a>
            </li><li class="d-flex justify-content-center align-items-center m-2">
        <a id="kategori-btn" data-id="" class="d-flex flex-column"><img src="{{ asset('assets/0-chemical.png') }}" width="80" class="mb-3 mx-auto">
        Ilmu-ilmu Sosial            </a></li> <li class="d-flex justify-content-center align-items-center m-2">
        <a id="kategori-btn" data-id="" class="d-flex flex-column"><img src="{{ asset('assets/1-memory.png') }}" width="80" class="mb-3 mx-auto">
    Ilmu-ilmu Terapan            </a></li> <li class="d-flex justify-content-center align-items-center m-2">
        <a id="kategori-btn" data-id="" class="d-flex flex-column"><img src="{{ asset('assets/7-quill.png') }}" width="80" class="mb-3 mx-auto">
    Kesenian, Hiburan, dan Olahraga            </a></li> <li class="d-flex justify-content-center align-items-center m-2">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="d-flex flex-column"><img src="{{ asset('assets/grid_icon.png') }}" width="80" class="mb-3 mx-auto">
        lihat lainnya..            </a></li></ul></section>
    @endcan 
</br>
    @can('admin')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div id="chart"></div>
            </div>
        </div>
    </div>
    @endcan
    <br>
    <div class="section-body">
        <div class="row">
            <div class="col-12" id="test">
                <h4>Buku Terbaru</h4>
                @if ($bukus->count())
                    <div class="owl-carousel owl-theme slider" id="myCarousel">
                        @foreach ($bukus as $buku)
                            <a style="color: black; text-decoration: none;" href="/buku/{{ $buku->id }}">
                                <div class="card">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <div class="flex-shrink-0">
                                            @if ($buku->cover)
                                                <img src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul }}"
                                                    class="img-fluid rounded" style="width: 9rem;">
                                            @else
                                                <img src="{{ asset('assets/default.png') }}" alt="{{ $buku->judul }}"
                                                    class="img-fluid rounded" style="width: 9rem;">
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 ml-3">
                                            <h5 class="align-items-start">{{ $buku->judul }}</h5>
                                            {{ $buku->excerpt }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center mb-5 mt-5">
                        <p class="fs-4">Tidak ada data buku yang ditemukan.</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h4>E-Book Terbaru</h4>
                @if ($ebooks->count())
                    <div class="owl-carousel owl-theme slider" id="myCarousel-2">
                        @foreach ($ebooks as $ebook)
                            <a style="color: black; text-decoration: none;" href="/detailEbook/{{ $ebook->id }}">
                                <div class="card">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <div class="flex-shrink-0">
                                            <img style="width: 9rem;" class="img-fluid rounded"
                                                src="{{ asset('storage/' . $ebook->cover) }}" alt="{{ $ebook->judul }}">
                                        </div>
                                        <div class="flex-grow-1 ml-3">
                                            <h5 class="align-items-start">{{ $ebook->judul }}</h5>
                                            {{ $ebook->excerpt }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center mb-5 mt-5">
                        <p class="fs-4">Tidak ada data e-book yang ditemukan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
    var options = {
        series: [{
            name: 'Net Pr',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
            name: 'Revenue',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
            name: 'Free Cash Flow',
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    
    </script>
    @can('admin')
    <script>
        var options = {
          series: [{
          name: 'Net Profit',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Revenue',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'Free Cash Flow',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @endcan

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


  <!-- Vertically centered modal -->
<div class="modal-dialog modal-dialog-centered">
    ...
  </div>
  
  <!-- Vertically centered scrollable modal -->
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    ...
  </div>
@endsection

{{-- 
const btns = document.querySelectorAll('#kategori-btn');
        btns.forEach(btn => {
            $(btn).on('click', function(){
            $.ajax([
                'url' : '127.0.0.1:8000', 
                'type' : 'GET',
                response: function(data) {
                    $('#categori').html('');
                    $('#test').html('');
    
                    let rows = '';
                    rows += '<h1>asd</h1>'
    
    
                    $('#test').append(rows);
                }
            ])
        })
        }); --}}