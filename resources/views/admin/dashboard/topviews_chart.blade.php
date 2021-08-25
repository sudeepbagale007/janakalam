@push('style')
  <style type="text/css">
  #chartdiv {
    width: 100%;
    height: 600px;
    max-width: 100%;
  }
  </style>
@endpush

<div class="box-header with-border">
    <h3 class="box-title">{{ $page_header }} Chart</h3>
    <div class="box-tools pull-right">
        <form>
            <div class="col-md-4">
                {{-- <label for="startdate">Start Date</label> --}}
                <input type="text" name="startdate" class="form-control datepicker" autocomplete="off" id="startdate" value="{{ $startdate }}">
            </div>
            <div class="col-md-4">
                {{-- <label for="enddate">End Date</label> --}}
                <input type="text" name="enddate" class="form-control datepicker" autocomplete="off" id="enddate" value="{{ $enddate }}">
            </div>
            <div class="col-md-4">
                {{-- <label class="vi-hidden"></label> --}}
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div>
<div class="box-body">
    <div id="chartdiv"></div>
</div>


@push('script')
@include('admin.dashboard.amcharts')
<script type="text/javascript">
  var baseurl = "{{ url('/') }}";
  var startdate = $("#startdate").val();
  var enddate = $("#enddate").val();

  // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.dataSource.url = baseurl+"/u-admin/topviewsjson?startdate="+startdate+"&enddate="+enddate;
    chart.dataSource.parser = new am4core.JSONParser();


    // Create axes

    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "id";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "viewcount";
    series.dataFields.categoryX = "id";
    series.name = "Visits";
    series.columns.template.tooltipText = "{title}: [bold]{valueY}[/],({published_date})";
    series.columns.template.fillOpacity = .8;

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;

</script>
@endpush