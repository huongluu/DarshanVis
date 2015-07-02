
<div class="hero-unit">
    <?php
    $facebook = new Facebook(array(
        'appId' => '549567871741754', // needed for JS SDK, Social Plugins and PHP SDK
        'secret' => 'c15a20dec1d41b78e9ef267814ac4c0f'
    ));

    //get user from facebook object
    $user = $facebook->getUser();

    if ($user) { //check for existing user id
        try {
            // Proceed knowing you have a logged in user who's authenticated.
            
            $logoutUrl = $facebook->getLogoutUrl(array("next" => Yii::app()->getBaseUrl(true) . '/index.php/user/logout'));
            echo CHtml::button('Logout', array('class' => 'btn fix-btn', 'submit' => $logoutUrl));
            $_SESSION['facebook'] = $facebook;
            
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
        }
    } else { //user doesn't exist
        $loginUrl = $facebook->getLoginUrl(array(
            'diplay' => 'popup',
            'scope' => 'user_friends, read_stream',
            'redirect_uri' => Yii::app()->getBaseUrl(true) . '/index.php/user/welcome'
        ));
        echo CHtml::button('Login', array('class' => 'btn fix-btn', 'submit' => $loginUrl));
    }

    //***************OLD version************
    /*
      if (Yii::app()->facebook->isUserLogin()) {
      echo CHtml::button('Logout', array('class' => 'btn', 'submit' => Yii::app()->facebook->getLogoutUrl(array('next' => Yii::app()->getBaseUrl(true) . '/index.php/user/logout'))));
      } else {
      echo CHtml::button('Login with Facebook', array('class' => 'btn', 'submit' => Yii::app()->facebook->getLoginUrl(array('scope' => 'read_stream', 'redirect_uri' => Yii::app()->getBaseUrl(true) . '/index.php/user/welcome'))));
      }
     */
    /* $fbID = Yii::app()->facebook->getUser();

      //
      //  echo "fbID" . $fbID . '<br>';

      if ($fbID) {
      echo CHtml::button('Start', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/load')));
      }
     * 
     */
    ?>



    <h2>Welcome to FeedVis</h2>
    <!--
    <p>
        FeedVis is an application over Facebook which extracts your News Feed as well as your friends' public stories  to generate a series of alternate views of the user’s familiar News Feed. 
        Each of these alternate views disclosed some effects of the News Feed curation algorithm; the consequences the algorithm caused by filtering a story from a user’s News Feed that would not exist in the absence of the algorithm. <br>
    </p>
    
    <h3>How to Use FeedVis?</h3>
    <p>
        First logout from your Facebook in the browser and then login with FeedVis by clicking on <i>login with Facebook </i> button on this page. <br>
        Then, click the <i>Start</i> button and wait around 15 minutes till the application redirects you to a new page.

    </p>
    -->
    <p>
        We need a text here! <br>
        <?php
        if ($user) { //check for existing user id
            try {
                // Proceed knowing you have a logged in user who's authenticated.
              //  $user_profile = $facebook->api('/me');
              //  print_r($user_profile);
                echo CHtml::button('Start', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/load')));
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }
        ?>

    </p>
</div>