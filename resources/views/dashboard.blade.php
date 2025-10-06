@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard DUK Dinkes Kampar</h2>

    {{-- Ringkasan Card --}}
    <div class="row mb-4">
        @php
            $cards = [
                ['title' => 'Total Pegawai', 'value' => $totalPegawai, 'bg' => 'primary'],
                ['title' => 'PNS', 'value' => $totalPNS, 'bg' => 'success'],
                ['title' => 'PPPK', 'value' => $totalPPPK, 'bg' => 'warning'],
                ['title' => 'Unit Kerja', 'value' => $totalTempatTugas, 'bg' => 'info'],
            ];
        @endphp
        @foreach ($cards as $card)
        <div class="col-md-3">
            <div class="card text-bg-{{ $card['bg'] }} mb-3 text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ $card['title'] }}</h5>
                    <h2>{{ $card['value'] }}</h2>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Grafik dan Diagram --}}
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Pegawai per Status Kepegawaian</div>
                <div class="card-body">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">Pegawai per Tempat Tugas</div>
                <div class="card-body" style="overflow-y: auto; max-height: 600px;">
                    <canvas id="unitChart" style="height: {{ count($tugasCounts) * 25 }}px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart Status Kepegawaian
    const ctxStatus = document.getElementById('statusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($statusCounts)) !!},
            datasets: [{
                label: 'Jumlah',
                data: {!! json_encode(array_values($statusCounts)) !!},
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(75, 192, 192, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Bar Chart Pegawai per Unit Kerja
    const ctxUnit = document.getElementById('unitChart').getContext('2d');
    new Chart(ctxUnit, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($tugasCounts)) !!},
            datasets: [{
                label: 'Jumlah Pegawai',
                data: {!! json_encode(array_values($tugasCounts)) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.8)'
            }]
        },
        options: {
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} pegawai`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    }
                }
            }
        }
    });
</script>
@endsection
