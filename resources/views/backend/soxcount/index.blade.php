<div class="col-xl-5 col-lg-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ __('backend/index.server-sox-count') }}
            </h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                     aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">
                        {{ __('backend/index.filter.degree') }}
                    </div>
                    @for($i = 1; $i < 13; $i++)
                        <div class="dropdown-item" id="degreeFilter-{{ $i }}" data-id="{{ $i }}">
                            {{ __('backend/index.filter.name', ['degree' => $i]) }}
                        </div>
                    @endfor
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item" id="degreeFilter-0" data-id="0">
                        {{ __('backend/index.filter.show-all') }}
                    </div>
                    <a class="dropdown-item" href="#">

                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="soxPieChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color: #ff79f5;"></i>
                        {{ __('backend/index.seal-of-star') }}
                </span>
                <span class="mr-2">
                      <i class="fas fa-circle" style="color: #62cadf;"></i>
                    {{ __('backend/index.seal-of-moon') }}
                </span>
                <span class="mr-2">
                      <i class="fas fa-circle" style="color: #dfce38"></i>
                    {{ __('backend/index.seal-of-sun') }}
                </span>
            </div>
        </div>
    </div>
</div>

@push('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            const filterButton = $('[id^="degreeFilter-"]');
            filterButton.click({data: filterButton}, send);

            let data = [
                @foreach($soxCount as $count)
                {{ $count }},
                @endforeach
            ];

            let ctx = document.getElementById("soxPieChart");
            let soxPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [
                        "{{ __('backend/index.seal-of-star') }}",
                        "{{ __('backend/index.seal-of-moon') }}",
                        "{{ __('backend/index.seal-of-sun') }}"
                    ],
                    datasets: [{
                        data: data,
                        backgroundColor: ['#ff79f5', '#62cadf', '#ecda3b'],
                        hoverBackgroundColor: ['#ff9cf7', '#67d4ea', '#dfce38'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });

            function send(event) {
                let degreeFilter = $(event.currentTarget).data('id');
                $.get({
                    url: '{{ route('sox-count-filter-backend') }}/' + degreeFilter,
                }).done(function (d) {
                    if (d.success) {
                        soxPieChart.data.datasets[0].data = Object.values(d.counts);
                        soxPieChart.update();
                    }
                });
            }
        });
    </script>
@endpush
