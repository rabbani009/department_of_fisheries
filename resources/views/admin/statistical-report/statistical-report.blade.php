@extends('admin.admin')
@section('content')
    <div class="row justify-content-center" style="margin: 20px 0px 0px 0px;">
        <div class="col-8" style="border:1px solid #ccc; background:#fff;">
            <button class="btn btn-danger" onclick="numberOfFishermen()"> <i
                    class="typcn typcn-printer mr-2"></i>Print</button>
            <div id="numberOfFishermen" style="width: 800px; height: 500px;"></div>
        </div>

        <div class="col-8" style="border:1px solid #ccc; background:#fff; margin: 20px 0px 0px 0px;">
            <button class="btn btn-danger" onclick="annualLoanAndSavings()"> <i
                    class="typcn typcn-printer mr-2"></i>Print</button>
            <div id="annualLoanAndSavings" style="width: 800px; height: 500px;"></div>
        </div>
        <div class="col-8" style="border:1px solid #ccc; background:#fff; margin: 20px 0px 0px 0px;">
            <button class="btn btn-danger" onclick="pieChartDeficiencyPeriod()"> <i
                    class="typcn typcn-printer mr-2"></i>Print</button>
            <div id="pieChartDeficiencyPeriod" style="width: 800px; height: 500px;"></div>
        </div>
        <div class="col-8" style="border:1px solid #ccc; background:#fff; margin: 20px 0px 0px 0px;">
            <button class="btn btn-danger" onclick="differentTypesOfFish()"> <i
                    class="typcn typcn-printer mr-2"></i>Print</button>
            <div id="differentTypesOfFish" style="width: 1000px;"></div>
        </div>
        <div class="col-8" style="border:1px solid #ccc; background:#fff; margin: 20px 0px 0px 0px;">
            <button class="btn btn-danger" onclick="salePlaceOfFishData()"> <i
                    class="typcn typcn-printer mr-2"></i>Print</button>
            <div id="salePlaceOfFishData" style="width: 1000px; height: 500px;"></div>
        </div>
    </div>
    @push('js')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    <?php echo $arr; ?>
                ]);

                var options = {
                    title: 'এলাকা ভিত্তিক জেলেদের সংখ্যা'
                };

                var chart = new google.visualization.PieChart(document.getElementById('numberOfFishermen'));

                chart.draw(data, options);
            }
        </script>

        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['  ', 'বার্ষিক সঞ্চয়', 'বার্ষিক ঋণ'],
                    <?php echo $yearlySavingDataa; ?>
                ]);

                var options = {
                    title: 'বার্ষিক ঋণ এবং সঞ্চয়ের ভিত্তিতে জেলেদের সংখ্যা',
                    vAxis: {
                        format: 'decimal'
                    },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("annualLoanAndSavings"));

                chart.draw(data, google.charts.Bar.convertOptions(options));

            }
        </script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    <?php echo $pieChartDeficiencyPeriod; ?>
                ]);

                var options = {
                    title: 'জীবিকার আপদকাল ভিত্তিক জেলেদের সংখ্যা'
                };

                var chart = new google.visualization.PieChart(document.getElementById('pieChartDeficiencyPeriod'));

                chart.draw(data, options);
            }
        </script>
        <script type="text/javascript">
            google.charts.load("current", {
                packages: ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Element", "Density", {
                        role: "style"
                    }],
                    <?php echo $typeOfFishDataChart; ?>
                ]);

                var view = new google.visualization.DataView(data);

                var options = {
                    title: "বিভিন্ন ধরনের মাছ আহরনে নিয়োজিত জেলেদের সংখ্যা",
                    width: 800,
                    height: 400,
                    // bar: {
                    //     groupWidth: "95%"
                    // },
                    legend: {
                        position: "none"
                    },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("differentTypesOfFish"));
                // chart.draw(view, options);
                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
        <script type="text/javascript">
            google.charts.load("current", {
                packages: ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ["Element", "Density", {
                        role: "style"
                    }],
                    <?php echo $salePlaceOfFishDataChart; ?>
                ]);

                var view = new google.visualization.DataView(data);

                var options = {
                    title: "মৎস্য আহরণস্থলের ভিত্তিতে জেলেদের সংখ্যা",
                    width: 800,
                    height: 400,
                    // bar: {
                    //     groupWidth: "95%"
                    // },
                    legend: {
                        position: "none"
                    },
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("salePlaceOfFishData"));
                // chart.draw(view, options);
                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
        <script>
            function numberOfFishermen() {
                const printContents = document.getElementById('numberOfFishermen').innerHTML;
                const originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

            function annualLoanAndSavings() {
                const printContents = document.getElementById('annualLoanAndSavings').innerHTML;
                const originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

            function pieChartDeficiencyPeriod() {
                const printContents = document.getElementById('pieChartDeficiencyPeriod').innerHTML;
                const originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

            function differentTypesOfFish() {
                const printContents = document.getElementById('differentTypesOfFish').innerHTML;
                const originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

            function salePlaceOfFishData() {
                const printContents = document.getElementById('salePlaceOfFishData').innerHTML;
                const originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    @endpush
@endsection
