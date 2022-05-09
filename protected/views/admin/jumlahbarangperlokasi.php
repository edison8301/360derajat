<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/vendors/fusioncharts/js/FusionCharts.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/vendors/fusioncharts/js/themes/FusionCharts.theme.fint.js"); ?>


<hr>

<script>

FusionCharts.ready(function(){
      var revenueChart = new FusionCharts({
        "type": "bar3d",
        "renderAt": "grafik-tahun",
        "width": "750",
        "height": "600",
        "dataFormat": "json",
        "dataSource": {
          "chart": {
              "caption" : "Grafik Barang Tahun 2015",
              "xAxisName": "Lokasi",
              "yAxisName": "Jumlah Barang",
              "theme": "fint"
           },
          "data":        
              [ <?php print Barang:: getdataChartByLokasi(); ?> ]
             
           
        }
    });

    revenueChart.render();
})
		
</script>
<div> &nbsp</div> 

<?php $box = $this->beginWidget('booster.widgets.TbPanel', array(
  'title'=>'STATISTIK Barang',
  'context' => 'info',
  'headerIcon'=>'signal' )
  );
?>  
<div id="grafik-tahun"> FusionChart XT will load here! </div>
<?php $this->endWidget(); ?>