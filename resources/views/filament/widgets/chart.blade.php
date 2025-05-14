<div>
    <canvas id="pengendalianChart"></canvas>
</div>

@push('scripts')
    <script>
        const ctx = document.getElementById('pengendalianChart').getContext('2d');
        const chartData = @json($data); // Mendapatkan data dari widget

        const chart = new Chart(ctx, {
            type: 'bar', // Jenis grafik, bisa diubah sesuai kebutuhan
            data: {
                labels: chartData.labels, // Label untuk sumbu X
                datasets: chartData.datasets, // Dataset untuk grafik
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top', // Posisi legenda
                    },
                },
            },
        });
    </script>
@endpush
