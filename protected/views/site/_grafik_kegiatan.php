<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/vendors/fusioncharts/js/fusioncharts.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/vendors/fusioncharts/js/themes/fusioncharts.theme.fint.js"); ?>


<script>

FusionCharts.ready(function(){
      var revenueChart = new FusionCharts({
        "type": "Column3d",
        "renderAt": "grafik-jumlah",
        "width": "100%",
        "height": "350",
        "dataFormat": "json",
        "dataSource": {
          "chart": {
              "xAxisName": "Bulan",
              "yAxisName": "Jumlah Penerimaan",
              "formatNumberScale" : 0,
              "theme": "fint"
           },
          "data":        
                [ <?php print Kegiatan::getDataKegiatanPerBulan(); ?> ], 
        }
    });

    revenueChart.render();
})
    
</script>
<div> &nbsp</div> 

<?php $box = $this->beginWidget('booster.widgets.TbPanel', array(
      'title'=>'Grafik Jumlah Kegiatan Penilaian Per Bulan',
      'context' => 'primary',
      'headerIcon'=>'signal' 
)); ?>  
  <div id="grafik-jumlah" style="text-align:center">Grafik Penerimaan</div>

<?php $this->endWidget(); ?>
