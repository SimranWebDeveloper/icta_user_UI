@extends('itd-leader.layouts.app')
@section('content')
    <div class="row mb-4">
        <div class="col-md-12 mb-4">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Struktur</h3>
                    </div>
                </div>
                <div class="card-body" style="overflow: auto!important;">
                    <div id="chart_div"></div>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('js')
    <script>

        var personInfo = @json($cleanedDepartmentsArray);
        var cleanedArray = personInfo.map(function(item) {
            if (typeof item === 'string') {
                return JSON.parse(item.replace(/&quot;/g, ''));
            } else {
                return item;
            }
        });

        console.log(cleanedArray);

        google.charts.load("current", { packages: ["orgchart"] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn("string", "Id");
            data.addColumn("string", "Manager");

            data.addRows([
                ...cleanedArray.map((i) => [
                    {
                        v: `${i.name}`,
                        f: `<button class='btn btn-lg btn-primary' style="height: 60px; padding: 10px;">${i.name}</button>`,
                    },
                    `${i.institution_id ? i.institution_id : ""}`,
                ]),
            ]);


            var chart = new google.visualization.OrgChart(
                document.getElementById("chart_div")
            );

            chart.draw(data, {
                allowHtml: true,
                nodeClass: "personItem",
                selectNodeClass: "selected",
            });
        }

    </script>
@endsection
