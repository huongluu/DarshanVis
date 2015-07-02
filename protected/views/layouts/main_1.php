

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <?php
        Yii::app()->clientScript->registerScriptFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.livequery.min.js');
        Yii::app()->clientScript->registerCssFile('http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/js/bs/css/bootstrap.min.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bs/js/bootstrap.min.js');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/js/bs-editable/css/bootstrap-editable.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bs-editable/js/bootstrap-editable.min.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.slimscroll.min.js');
        //      Yii::app()->clientScript->registerScriptFile('http://code.highcharts.com/highcharts.js');
        //     Yii::app()->clientScript->registerScriptFile('http://code.highcharts.com/modules/exporting.js');

        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/main.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/form.css');
        ?>


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>


        <div class="container" id="page">


            <div>
                <div><?php //echo CHtml::encode(Yii::app()->name);                                   ?>
                    <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/banner.jpg'></img>
                </div>
            </div><!-- header -->

            <div class="row buttons" style="float: right; margin:2px;">

                <?php
                //*********************** LOGIN & LOGOUT ******************************

                /* //*****login with php sdk 2 or 3 using yii library******
                 * if (Yii::app()->facebook->isUserLogin())
                  echo CHtml::button('Logout', array('class' => 'btn', 'submit' => Yii::app()->facebook->getLogoutUrl(array('next' => Yii::app()->getBaseUrl(true) . '/index.php/user/welcome'))));
                  else
                  echo CHtml::button('Login with Facebook', array('class' => 'btn', 'submit' => Yii::app()->facebook->getLoginUrl(array('scope' => 'read_stream', 'redirect_uri' => Yii::app()->getBaseUrl(true) . '/index.php/user/welcome'))));
                 * 
                 */

                //*******login with php sdk 2 or 3 using facebook library directly*******
                /*  $fb = new Facebook(Yii::app()->params['Facebook']);
                  $user = $fb->getUser();
                  if ($user) {
                  echo CHtml::button('Logout', array('class' => 'btn', 'submit' => $fb->getLogoutUrl(array('next' => Yii::app()->getBaseUrl(true) . '/index.php/user/welcome'))));
                  } else {
                  echo CHtml::button('Login with Facebook', array('class' => 'btn', 'submit' => $fb->getLoginUrl(array('scope' => 'read_stream', 'redirect_uri' => Yii::app()->getBaseUrl(true) . '/index.php/user/welcome'))));
                  }
                 */
                ?>
            </div>

            <div id="mainmenu" class="navbar">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Home', 'url' => array('/user/intro')),
                        // array('label' => 'About', 'url' => array('/frontend/intro')),
                        array('label' => 'Contact', 'url' => array('/site/contact'), 'template' => '| {menu}'),
                    //    array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                    //    array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
