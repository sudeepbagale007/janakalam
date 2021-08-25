@push('style')
  <style type="text/css">
  #chartdiv {
    width: 100%;
    height: 650px;
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
var chart = am4core.create("chartdiv", am4charts.PieChart);
chart.dataSource.url = baseurl+"/u-admin/categoryjson?startdate="+startdate+"&enddate="+enddate;
chart.dataSource.parser = new am4core.JSONParser();

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "totalpost";
pieSeries.dataFields.category = "title";

// Let's cut a hole in our Pie chart the size of 30% the radius
chart.innerRadius = am4core.percent(30);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
  // change the cursor on hover to make it apparent the object can be interacted with
  .cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ];

pieSeries.alignLabels = true;
pieSeries.labels.template.bent = false;
pieSeries.labels.template.radius = 8;
pieSeries.labels.template.padding(0,0,0,0);

pieSeries.ticks.template.disabled = false;

// Create a base filter effect (as if it's not there) for the hover to return to
var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
shadow.opacity = 0;

// Create hover state
var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
hoverShadow.opacity = 0.7;
hoverShadow.blur = 5;

// Add a legend
chart.legend = new am4charts.Legend();
chart.legend.position = "right";
</script>
@endpush