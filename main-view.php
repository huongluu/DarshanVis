
<?php /* @var $this Controller */ ?>
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
                <div><?php //echo CHtml::encode(Yii::app()->name);                                ?>
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

                /*  //*******login with php sdk 2 or 3 using facebook library directly*******
                  $fb = new Facebook(Yii::app()->params['Facebook']);
                  $user = $fb->getUser();
                  if ($user) {
                  echo CHtml::button('Logout', array('class' => 'btn', 'submit' => $fb->getLogoutUrl(array('next' => Yii::app()->getBaseUrl(true) . '/index.php/user/welcome'))));
                  } else {
                  echo CHtml::button('Login with Facebook', array('class' => 'btn', 'submit' => $fb->getLoginUrl(array('scope' => 'read_stream', 'redirect_uri' => Yii::app()->getBaseUrl(true) . '/index.php/user/welcome'))));
                  }
                 * 
                 */

                //*****login with php sdk v4 using Facebook library directly******
                // Define the root directoy.                 
                define('FACEBOOK_SDK_V4_SRC_DIR', Yii::getPathOfAlias('webroot') . '/protected/components/Facebook-sdk4/src/Facebook/');

                // Autoload the required files
                require Yii::getPathOfAlias('webroot') . '/protected/components/Facebook-sdk4/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;

$redirect_url = Yii::app()->getBaseUrl(true) . '/index.php/user/welcome';

                $permissions = array(
                    'read_stream'
                        //'user_actions.books'
                        //  'manage_pages'
                        //'user_likes'
                        //'user_about_me',
                );

                // Initialize the Facebook SDK.
                FacebookSession::setDefaultApplication(Yii::app()->params['app_id'], Yii::app()->params['app_secret']);

                // login helper with redirect_uri
                $helper = new FacebookRedirectLoginHelper($redirect_url);

                // Authorize the user.
                try {
                    if (isset($_SESSION['access_token'])) {
                        // Check if an access token has already been set.
                        $fb_session = new FacebookSession($_SESSION['access_token']);
                    } else {
                        // Get access token from the code parameter in the URL.
                        $fb_session = $helper->getSessionFromRedirect();
                    }
                } catch (FacebookRequestException $ex) {

                    // When Facebook returns an error.
                    print_r($ex);
                } catch (Exception $ex) {

                    // When validation fails or other local issues.
                    print_r($ex);
                }

                if (isset($fb_session)) {

                    // Retrieve & store the access token in a session.
                    $_SESSION['access_token'] = $fb_session->getToken();

                    $logoutURL = $helper->getLogoutUrl($fb_session, Yii::app()->getBaseUrl(true) . '/index.php/user/logout');

                    // Logged in
                    echo CHtml::button('Logout', array('class' => 'btn', 'submit' => $logoutURL));
                    //echo 'Successfully logged in! <a href="' . $logoutURL . '">Logout</a>';
                } else {

                    // Generate the login URL for Facebook authentication.
                    $loginUrl = $helper->getLoginUrl($permissions);

                    echo CHtml::button('Login', array('class' => 'btn', 'submit' => $loginUrl));
                    //   echo CHtml::button('Login', array('class' => 'btn', 'submit' => array($loginUrl, array('fb_session'=>$redirect_url))));
                }

                if (isset($fb_session)) {
                    // graph api request for user data
                    $request = new FacebookRequest($fb_session, 'GET', '/me');
                    $response = $request->execute();
                    // get response
                    $graphObject = $response->getGraphObject();

                    // print data
                    echo print_r($graphObject, 1);
                }
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
