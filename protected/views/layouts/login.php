<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/login.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <script src="<?php print Yii::app()->request->baseUrl; ?>/css/material-design/dist/js/material.min.js" type="text/javascript"></script>
    <script src="<?php print Yii::app()->request->baseUrl; ?>/css/material-design/dist/js/ripples.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/material-design/dist/css/bootstrap-material-design.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/material-design/dist/css/ripples.min.css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
</head>

<body background="<?php echo Yii::app()->baseUrl; ?>/images/login.jpg">

<div id="content">
	<div class="container">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-' . $key . '" style="margin-top:20px">';
                echo '<button type="button" class="close" data-dismiss="alert">x</button>';
                print $message;
                print "</div>\n";
        } ?>
      </div>
    </div>
		<div class="row" style="margin-left:auto;margin-right:auto;margin-top:70px">
	        <?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
	                echo '<div class="alert alert-' . $key . '">';
	                echo '<button type="button" class="close" data-dismiss="alert">x</button>';
	                print $message;
	                print "</div>\n";
	        } ?>
			<div class="col-sm-8">
				<div class="keterangan">

					<div>Self Assessment Sikap dan Perilaku</div>
					<div>Peserta Pelatihan Kepemimpinan</div>
					<div class="sub-tittle">Lembaga Administrasi Negara</div>


					<img src="<?php echo Yii::app()->baseUrl; ?>/images/360.png" width="600px">
				</div>
			</div>
			<div class="col-sm-4">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
</div>

<script>
  (function () {

    var $button = $("<div id='source-button' class='btn btn-primary btn-xs'>&lt; &gt;</div>").click(function () {
      var index = $('.bs-component').index($(this).parent());
      $.get(window.location.href, function (data) {
        var html = $(data).find('.bs-component').eq(index).html();
        html = cleanSource(html);
        $("#source-modal pre").text(html);
        $("#source-modal").modal();
      })

    });

    $('.bs-component [data-toggle="popover"]').popover();
    $('.bs-component [data-toggle="tooltip"]').tooltip();

    $(".bs-component").hover(function () {
      $(this).append($button);
      $button.show();
    }, function () {
      $button.hide();
    });

    function cleanSource(html) {
      var lines = html.split(/\n/);

      lines.shift();
      lines.splice(-1, 1);

      var indentSize = lines[0].length - lines[0].trim().length,
          re = new RegExp(" {" + indentSize + "}");

      lines = lines.map(function (line) {
        if (line.match(re)) {
          line = line.substring(indentSize);
        }

        return line;
      });

      lines = lines.join("\n");

      return lines;
    }

    $(".icons-material .icon").each(function () {
      $(this).after("<br><br><code>" + $(this).attr("class").replace("icon ", "") + "</code>");
    });

  });

</script>



<script>
  $(function () {
    $.material.init();
    $(".shor").noUiSlider({
      start: 40,
      connect: "lower",
      range: {
        min: 0,
        max: 100
      }
    });

    $(".svert").noUiSlider({
      orientation: "vertical",
      start: 40,
      connect: "lower",
      range: {
        min: 0,
        max: 100
      }
    });
  });
</script>


</body>
</html>
