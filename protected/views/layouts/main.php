<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <script src="<?php print Yii::app()->request->baseUrl; ?>/css/material-design/dist/js/material.min.js" type="text/javascript"></script>
    <script src="<?php print Yii::app()->request->baseUrl; ?>/css/material-design/dist/js/ripples.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/material-design/dist/css/bootstrap-material-design.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/material-design/dist/css/ripples.min.css" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
    <?php 
        $baseUrl = Yii::app()->baseUrl; 
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($baseUrl.'/css/clipboard.min.js');
    ?>
</head>

<body>

<div id="page">

<div id="header">
	<div id="logo">
		<?php print CHtml::image(Yii::app()->baseUrl."/images/logo.png"); ?>
	</div>
</div>

<div id="mainnav">

<?php if(User::isAdmin() || User::isSuperAdmin()) { ?>

    <?php $this->widget('booster.widgets.TbNavbar',array(
            'brand' => '',
            'fixed' => false,
        	'fluid' => true,
            'items' => array(
                array(
                    'class' => 'booster.widgets.TbMenu',
                	'type' => 'navbar',
                    'items' => array(
                        array('label' =>'Beranda', 'url' => array('site/index'), 'icon'=>'home'),
    					array('label'=>'Kegiatan','icon'=>'file','url'=>array('/kegiatanInduk/admin')),
    					array('label'=>'Bank Kompetensi','icon'=>'list','url'=>array('/kompetensiJenis/admin')),
                        /*array('label' => 'Kompetensi','icon'=>'list', 'items'=> array(
                            array('label'=>'Bank Kompetensi','icon'=>'list','url'=>array('/kompetensi/admin')),
                            array('label'=>'Bank Kompetensi','icon'=>'list','url'=>array('/kompetensi/admin')),
                            )),*/
    					array('label'=>'Pegawai','icon'=>'user','url'=>array('/pegawai/admin')),
                        array('label'=>'Lembaga','icon'=>'home','url'=>array('/lembaga/admin')),
    					array('label'=>'User','icon'=>'user','url'=>array('/user/admin')),
                    )
                ),
                array(
                    'class' => 'booster.widgets.TbMenu',
                    'htmlOptions'=>array('class'=>'pull-right navbar-right'),
                    'type' => 'navbar',
                    'items' => array(                    
                        array('label' => 'Ganti Password', 'url' => array('user/gantiPassword'), 'icon'=>'lock','linkOptions'=>array('class'=>'pull-right')),
                        array('label' => 'Logout ('.Yii::app()->user->id.')', 'url' => array('site/logout'), 'icon'=>'off','linkOptions'=>array('class'=>'pull-right')),
                    )
                )
            )
        )
    ); ?>

<?php } if(User::isPegawai()) { ?>


    <?php $this->widget('booster.widgets.TbNavbar',array(
            'brand' => '',
            'fixed' => false,
            'fluid' => true,
            'items' => array(
                array(
                    'class' => 'booster.widgets.TbMenu',
                    'type' => 'navbar',
                    'items' => array(
                        array('label' =>'Beranda', 'url' => array('site/index'), 'icon'=>'home'),
                        array('label' =>'Profil', 'url' => array('site/profil'), 'icon'=>'user'),
                    )
                ),
                array(
                    'class' => 'booster.widgets.TbMenu',
                    'htmlOptions'=>array('class'=>'pull-right navbar-right'),
                    'type' => 'navbar',
                    'items' => array(                
                        array('label' => 'Ganti Password', 'url' => array('pegawai/changePassword'), 'icon'=>'lock','linkOptions'=>array('class'=>'pull-right')),    
                        array('label' => 'Logout ('.Yii::app()->user->id.')', 'url' => array('site/logout'), 'icon'=>'off','linkOptions'=>array('class'=>'pull-right')),
                    )
                )
            )
        )
    ); ?>

<?php } ?>




</div>

<div id="breadcrumb" class="container">
	<div class="row">
		<div class="col-sm-12">
        	<?php if(isset($this->breadcrumbs)) {
                    $this->breadcrumbs = array_merge(array('<i class="glyphicon glyphicon-home"></i> Beranda'=>Yii::app()->homeUrl), $this->breadcrumbs);
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links'=>$this->breadcrumbs,
                            'homeLink'=>false,
                            'encodeLabel'=>false,
                            'htmlOptions'=>array ('class'=>'breadcrumb')
                    ));
        	} ?>
		</div>
	</div>
</div>

<div id="content" class="container">
	<div class="row">
		<div class="col-sm-12">


        <?php foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-' . $key . '" style="margin-top:20px">';
                echo '<button type="button" class="close" data-dismiss="alert">x</button>';
                print $message;
                print "</div>\n";
        } ?>

			<?php print $content; ?>
		</div>
	</div>
</div>

	
<div id="footer">	

</div><!-- footer -->
	
</div><!--page-->



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

  })();

</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/noUiSlider/6.2.0/jquery.nouislider.min.js"></script>

<script>
  $(function () {
        $.material.init();
  });
</script>

</body>
</html>
