<?php

class UserController extends GxController {

    //*************Fiddler Controllers******************
    //
    //************************Loading User Information From Facebook*******************
    public function initialize() {
        ini_set('session.gc_maxlifetime', 8 * 60 * 60);
        ini_set('max_execution_time', 3600);
        ini_set("session.cookie_lifetime", 3600);

        session_set_cookie_params(8 * 60 * 60);
        date_default_timezone_set('America/Chicago');
        $this->setVar('user', NULL);
    }

    public function actionLoad() {
        $this->initialize();
        $user = new User;
        $user->collectInfo();
        $user->code = $this->randString(6);
        $user->save();
        $this->setVar('user', $user->id);
        /* $this->render('tracking_code', array(
          'user' => $user,
          ));

         */

        $this->render('startPage', array(//here should be changed to UI address
            'user' => $user,
        ));
    }

    public function actionColumn($userID) {//, $startTime, $endTime){
        $user = User::model()->findByPK($userID);


        $user_json = json_encode($user->storyType());
        $this->renderPartial('columns', array(
            'user_json' => $user_json,
        ));
    }

    //***************************************************

    public $layout = '//layouts/main';

    public function actionWelcome() {
        $this->render('welcome', array(
        ));
    }

    public function actionLogin() {
        $this->renderPartial('login', array(
        ));
    }

    public function actionLogout() {
        $this->render('logout', array(
        ));
    }

    public function randString($length, $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }
        return $str;
    }

    public function actionInterview() {
        //**************For Retrieving a User's Information From DB by Having the Assigned Random Code of the User**********
        if (isset($_POST['code'])) {
            $user = User::model()->find('code=:code', array(':code' => $_POST['code']));
            if (isset($user)) {
                $this->setVar('user', $user->id);
                $this->render('startPage', array('user' => $user));
                //$this->render('initlist', array('user' => $user));
            } else {
                $this->render('welcome_interview', array('error_msg' => '<div style="color:red">The entered code is incorrect, please try again.</div>'));
            }
        } else {
            $this->render('welcome_interview', array());
        }
    }

    //***************************1st Visualization: Showing All vs. Seen Posts***************************
    public function actionPosts() {

        if ($this->getVar('user') != NULL) {
            //$this->setVar('user', 13);
            $user = User::model()->findByPK($this->getVar('user'));
            $postMe = array();
            foreach ($user->postDatas as $dt) {
                if ($dt->seen == 1) {
                    $postMe[] = $dt;
                }
            }
            //echo $user->id;
            $allPosts = new CActiveDataProvider('PostData', array('data' => $user->postDatas));
            $seenPosts = new CActiveDataProvider('PostData', array('data' => $postMe));
            $this->render('posts', array(
                'user' => $user,
                'allPosts' => $allPosts,
                'seenPosts' => $seenPosts,
            ));
        }
    }

    //******************2nd Visualization: Showing the 3-part lists of friends (rarely seen, sometimes seen and almost seen)****************

    public function actionInitList() {

        $this->clearVar('friends_list');
        $this->clearVar('names');
        $this->clearVar('seen_final');
        $this->clearVar('not_seen_final');
        $this->setVar('creation_step', 0);

        if ($this->getVar('user') != NULL) {

            $user = User::model()->findByPK($this->getVar('user'));

            $query = Yii::app()->db->createCommand()
                    ->select('f.id, f.fbid, f.name, p.seen, p.not_seen, (p.seen / (p.seen + p.not_seen)) percent')
                    ->from('friend f, post p, user u')
                    ->where('u.id=f.user and f.id=p.friend and p.category=8 and u.id=:userid', array(':userid' => $user->id))
                    ->order('percent desc');
            $data = $query->queryAll();
            // echo 'size data (query result):' . count($data) . '<br>';
            //$text = $query->text;
            //echo $text . '<br>';
        } else {
            //    echo 'The user is not set <br>';
            return;
        }

        $friends_list = array();
        $classes_num = 3; // # of clasess of friends we want to discuss: 0-10% (low), 45-55% (medium), 90-100% (high)
        $this->setVar('classes_num', $classes_num);

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['percent'] < 0.1 && $data[$i]['not_seen'] > 0) { // to avoid the friends who didn't post anything.
                $friends_list[0][] = $data[$i];
            } elseif ($data[$i]['percent'] > 0.45 && $data[$i]['percent'] < 0.55) {
                $friends_list[1][] = $data[$i];
            } elseif ($data[$i]['percent'] > 0.9 && $data[$i]['percent'] <= 1) {
                $friends_list[2][] = $data[$i];
            }
        }

        // echo '<br>size of low: ' . count($friends_list[0]);
        // echo '<br>size of med: ' . count($friends_list[1]);
        if (isset($friends_list[2]))
        //   echo '<br>size of high: ' . count($friends_list[2]) . '<br>';
            for ($c = 0; $c < $classes_num; $c++) { // [chosen] => 0: not chosen / 1: old chosen /  2: new chosen
                if (isset($friends_list[$c])) {
                    for ($j = 0; $j < count($friends_list[$c]); $j++) {
                        //   echo 'j: ' . $j . '<br>';
                        $friends_list[$c][$j]['chosen'] = 0;
                    }
                }
            }

        $this->setVar('friends_list', $friends_list);

        $this->createList();

        $this->render('threeGroups', array(
            //$this->render('finish', array(
            'user' => $user,
            'friends_list' => $this->getVar('friends_list'),
            'classes_num' => $this->getVar('classes_num'),
            'names' => $this->getVar('names'),
            'seen_final' => $this->getVar('seen_final'),
            'not_seen_final' => $this->getVar('not_seen_final'),
        ));
    }

    public function createList() {

        //  echo 'in creatList function <br>';
        //**********Choosing 3 ($friends_num) people randomly from each Class **********
        $const_friend_num = 3;
        $classes_num = $this->getVar('classes_num');
        $friends_list = $this->getVar('friends_list');
        $creation_step = $this->getVar('creation_step');

        $colors[0][0] = "#F5370C"; // Group 1: Seen
        $colors[0][1] = "#F08A73"; // Group 1: not_Seen
        $colors[1][0] = "#0CBBF5";
        $colors[1][1] = "#AAE0F2";
        $colors[2][0] = "#63BF63";
        $colors[2][1] = "#A8F0A8";

        //*****Set New chosens to Old chosens*****
        for ($c = 0; $c < $classes_num; $c++) { // [chosen] => 0: not chosen / 1: old chosen /  2: new chosen
            if (isset($friends_list[$c])) {

                for ($j = 0; $j < count($friends_list[$c]); $j++) {
                    if ($friends_list[$c][$j]['chosen'] == 2) {
                        $friends_list[$c][$j]['chosen'] = 1;
                    }
                }
            }
        }

        for ($c = 0; $c < $classes_num; $c++) {

            //  echo 'class: ' . $c . '<br>';

            if (isset($friends_list[$c])) {

                //echo '<br> class ' . $c;
                // echo "frines_num: ". $friends_num. '<br>';
                /* if(count($friends_list[$c]) < 3){
                  echo 'friend_list size: '. count($friends_list[$c]).'<br>';
                  return;
                  } */
                $friends_num = $const_friend_num;

                if (count($friends_list[$c]) == 0) {
                    //    echo "zero size";
                    $names[$c][] = '"' . 'No Friend' . '"';

                    // $seen_final[] = "" . $friends_list[$c][$rand_keys[$c][$f]]['seen'] . "";
                    $seen_final[] = "{y: " . 0 . ", color: '" . $colors[$c][0] . "'}";

                    // $not_seen_final[] = "" . (-1 * $friends_list[$c][$rand_keys[$c][$f]]['not_seen']) . "";
                    $not_seen_final[] = "{y: " . 0 . ", color: '" . $colors[$c][1] . "'}";

                    continue;
                } else {

                    if (count($friends_list[$c]) < $friends_num) {
                        $friends_num = count($friends_list[$c]);
                        //     echo "size of friend list less than 3: " . $friends_num . '<br>';
                    }

                    //***********For the Referesh buttom************
                    if ($creation_step > 0) {

                        //Count that the number of remaining friends in a class to make sure it's not less than 3!
                        $not_chosen = 0;
                        for ($j = 0; $j < count($friends_list[$c]); $j++) {
                            if ($friends_list[$c][$j]['chosen'] == 0) {
                                // echo 'j: ' . $j . '<br>';
                                $not_chosen++;
                            } else {
                                // echo 'chosen field: ' . $friends_list[$c][$j]['chosen'] . '<br>';
                            }
                        }

                        if ($not_chosen < $friends_num) {
                            //*****if the number of remaining friends in this class is less than the friends_num, show the previous ones.
                            //      echo 'in not chosen loop -> not chosen : ' . $not_chosen . '<br>';
                            return;
                            continue;
                        }
                    }
                    //*******************************************
                    //  echo "size of friend list: " . $friends_num . '<br>';

                    if ($friends_num == 1) {
                        $rand_keys[$c] = array(0 => 0);
                    } else {
                        $rand_keys[$c] = array_rand($friends_list[$c], $friends_num);
                    }

                    if ($c == 1) {
                        //   print_r($rand_keys);

                        /*  echo 'rand keys: ' . $rand_keys[1][0] . '<br>';

                          echo 'chosen: ' . $friends_list[0][$rand_keys[0][0]]['chosen'] . '<br>';

                          echo 'rand keys: ' . $rand_keys[1][1] . '<br>';
                          echo 'chosen: ' . $friends_list[0][$rand_keys[0][1]]['chosen'] . '<br>';

                          echo 'rand keys: ' . $rand_keys[1][2] . '<br>';
                          echo 'chosen: ' . $friends_list[0][$rand_keys[0][2]]['chosen'] . '<br>';
                          return; */
                    }
                    for ($f = 0; $f < $friends_num; $f++) {

                        //Check to not choose previously chosen friends
                        while ($friends_list[$c][$rand_keys[$c][$f]]['chosen'] == 1 || $friends_list[$c][$rand_keys[$c][$f]]['chosen'] == 2) {
                            $rand_keys[$c][$f] = array_rand($friends_list[$c]);
                        }

                        //echo '<br> chosen friend ID: ' . $rand_keys[$c][$f];
                        $friends_list[$c][$rand_keys[$c][$f]]['chosen'] = 2;

                        //*********Set the Variables for evalute_list page***********

                        $names[$c][] = '"' . $friends_list[$c][$rand_keys[$c][$f]]['name'] . '"';

                        // $seen_final[] = "" . $friends_list[$c][$rand_keys[$c][$f]]['seen'] . "";
                        $seen_final[] = "{y: " . $friends_list[$c][$rand_keys[$c][$f]]['seen'] . ", color: '" . $colors[$c][0] . "'}";

                        // $not_seen_final[] = "" . (-1 * $friends_list[$c][$rand_keys[$c][$f]]['not_seen']) . "";
                        $not_seen_final[] = "{y: " . (-1 * $friends_list[$c][$rand_keys[$c][$f]]['not_seen']) . ", color: '" . $colors[$c][1] . "'}";
                    }
                }
            }
        }


        /* for ($c = 0; $c < $classes_num; $c++) {
          if (isset($friends_list[$c])) {

          for ($f = 0; $f < $friends_num; $f++) {
          $names[$c][] = '"' . $friends_list[$c][$rand_keys[$c][$f]]['name'] . '"';

          // $seen_final[] = "" . $friends_list[$c][$rand_keys[$c][$f]]['seen'] . "";
          $seen_final[] = "{y: " . $friends_list[$c][$rand_keys[$c][$f]]['seen'] . ", color: '" . $colors[$c][0] . "'}";

          // $not_seen_final[] = "" . (-1 * $friends_list[$c][$rand_keys[$c][$f]]['not_seen']) . "";
          $not_seen_final[] = "{y: " . (-1 * $friends_list[$c][$rand_keys[$c][$f]]['not_seen']) . ", color: '" . $colors[$c][1] . "'}";
          }
          }
          } */

        /* echo implode(",", $seen_final);
          echo '<br>';
          echo implode(",", $not_seen_final); */

        $this->setVar('creation_step', $creation_step + 1);
        $this->setVar('friends_list', $friends_list);
        $this->setVar('names', $names);
        $this->setVar('seen_final', $seen_final);
        $this->setVar('not_seen_final', $not_seen_final);

        //***ToDo: Check if the number of remained not chosen entries less than 3, say somethig and return!
    }

    public function actionRefreshList() {

        //****************When refresh button is pressed**************** 

        if ($this->getVar('user') != NULL) {
            $user = User::model()->findByPK($this->getVar('user'));
            $this->createList();

            $this->render('threeGroups', array(
                'user' => $user,
                'friends_list' => $this->getVar('friends_list'),
                'classes_num' => $this->getVar('classes_num'),
                'names' => $this->getVar('names'),
                'seen_final' => $this->getVar('seen_final'),
                'not_seen_final' => $this->getVar('not_seen_final'),
            ));
        } else {
            //  echo 'The user is not set <br>';
            return;
        }
    }

    //***************************3rd Visualization: Evaluating the Created Lists in Previous Stage by User**********************
    public function actionEvaluateList() {

        if ($this->getVar('user') != NULL) {
            $user = User::model()->findByPK($this->getVar('user'));

            $classes_num = $this->getVar('classes_num');
            $friends_list = $this->getVar('friends_list');

            //Save  friend_list of chosen !=0 in DB
            //chosen: 1=> this friend is in the list for evaluation
            //initial: 0, 1 or 2 => the class of the friend( 0 = rarely seen, 1 = sometimes seen, 2 = almost seen)
            //changed: 0, 1 or 2 => the new class changed by the user

            for ($c = 0; $c < $classes_num; $c++) {
                for ($k = 0; $k < count($friends_list[$c]); $k++) {
                    if ($friends_list[$c][$k]['chosen'] != 0) {
                        $friend_obj = Friend::model()->findByPK($friends_list[$c][$k]['id']);
                        $friend_obj->chosen = 1;
                        $friend_obj->initial = $c;
                        $friend_obj->save();
                    }
                }
            }

            $this->render('evaluate_list', array(
                'user' => $user,
                'friends_list' => $friends_list,
                'classes_num' => $classes_num
            ));
        } else {
            //  echo 'The user is not set <br>';
            return;
        }
    }

    public function actionUpdateList($fid, $value) {

        $friend_obj = Friend::model()->findByPK($fid);
        $friend_obj->changed = $value;
        $friend_obj->save();
        // echo "salamsalam";
    }

    //***********************4th Visualization: Evaluating 10 Random Seen & Not Seen Posts by User****************************

    public function actionEvaluatePosts() {
        if ($this->getVar('user') != NULL) {
            //$this->setVar('user', 13);
            $friends_count = 10; // TODO: shouldn't be this one posts_count?!
            $user = User::model()->findByPK($this->getVar('user'));
            $seenPosts = array();
            $notSeenPosts = array();
            foreach ($user->postDatas as $dt) {
                if ($dt->seen == 1) {
                    $seenPosts[] = $dt;
                } else {
                    $notSeenPosts[] = $dt;
                }
            }
            $randSeenPosts = array_rand($seenPosts, $friends_count);
            $randNotSeenPosts = array_rand($seenPosts, $friends_count);

            $randSeenPostsObj = array();
            $randNotSeenPostsObj = array();

            for ($i = 0; $i < $friends_count; $i++) {

                $seen_obj = $seenPosts[$randSeenPosts[$i]];
                $seen_obj->chosen = 1;
                $seen_obj->save();
                $randSeenPostsObj[] = $seen_obj;

                $notseen_obj = $notSeenPosts[$randNotSeenPosts[$i]];
                $notseen_obj->chosen = 1;
                $notseen_obj->save();
                $randNotSeenPostsObj[] = $notseen_obj;
            }
            //echo $user->id;

            $seenPostsAP = new CActiveDataProvider('PostData', array('data' => $randSeenPostsObj));
            $notSeenPostsAP = new CActiveDataProvider('PostData', array('data' => $randNotSeenPostsObj));
            $this->render('evaluate_posts', array(
                'user' => $user,
                'seenPosts' => $seenPostsAP,
                'notSeenPosts' => $notSeenPostsAP,
            ));
        }
    }

    public function actionUpdatePosts($pid, $value) {
        $post_obj = PostData::model()->findByPK($pid);
        if (!isset($post_obj->changed)) {
            $post_obj->changed = $value;
        } else if ($post_obj->changed == 0) {
            $post_obj->changed = 1;
        } else {
            $post_obj->changed = 0;
        }
        $post_obj->save();
    }

    public function actionFinish() {
        $this->render('finish', array());
    }

    //******************************Basic Actions****************************************

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'User'),
        ));
    }

    public function actionCreate() {
        $model = new User;


        if (isset($_POST['User'])) {
            $model->setAttributes($_POST['User']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'User');


        if (isset($_POST['User'])) {
            $model->setAttributes($_POST['User']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'User')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex($id) {
        echo $id;
        //$this->setVar('user', 13);
        $user = User::model()->findByPK($id);
        //echo $user->id;
        $favFilterList = Filter::model()->findAll('_type=:type and user=:user', array(':type' => 1, ':user' => $user->id));
//        Yii::log($favFilterList);
        $recentFilterList = Filter::model()->findAll('_type=:type and user=:user', array(':type' => 2, ':user' => $user->id));

        $otherFilterList = Filter::model()->findAll('_type=:type and user=:user', array(':type' => 0, ':user' => $user->id));
        $allPosts = new CActiveDataProvider('PostData', array('data' => $user->postDatas));
        $favFilter = new CActiveDataProvider('Filter', array('data' => $favFilterList));
//        Yii::log(sizeof($favFilter));
        $recentFilter = new CActiveDataProvider('Filter', array('data' => $recentFilterList));
        $otherFilter = new CActiveDataProvider('Filter', array('data' => $otherFilterList));


        $this->render('index', array(
            'allPosts' => $allPosts,
            'favFilter' => $favFilter,
            'recentFilter' => $recentFilter,
            'otherFilter' => $otherFilter,
        ));
    }
    
    public function actionAdd($id) {
        echo $id;
        //$this->setVar('user', 13);
        $user = User::model()->findByPK($id);
        //echo $user->id;
        $favFilterList = Filter::model()->findAll('_type=:type and user=:user', array(':type' => 1, ':user' => $user->id));
//        Yii::log($favFilterList);
        $recentFilterList = Filter::model()->findAll('_type=:type and user=:user', array(':type' => 2, ':user' => $user->id));

        $otherFilterList = Filter::model()->findAll('_type=:type and user=:user', array(':type' => 0, ':user' => $user->id));
        $allPosts = new CActiveDataProvider('PostData', array('data' => $user->postDatas));
        $favFilter = new CActiveDataProvider('Filter', array('data' => $favFilterList));
//        Yii::log(sizeof($favFilter));
        $recentFilter = new CActiveDataProvider('Filter', array('data' => $recentFilterList));
        $otherFilter = new CActiveDataProvider('Filter', array('data' => $otherFilterList));


        $this->render('add', array(
            'allPosts' => $allPosts,
            'favFilter' => $favFilter,
            'recentFilter' => $recentFilter,
            'otherFilter' => $otherFilter,
        ));
    }

    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();

        if (isset($_GET['User']))
            $model->setAttributes($_GET['User']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    //***********************Working with Session Variable*************************
    public function getVar($key) {
        $session = Yii::app()->session;
        return $session->itemAt($key);
    }

    public function setVar($key, $val) {
        $session = Yii::app()->session;
        $session->add($key, $val);
    }

    public function clearVar($key) {
        $session = Yii::app()->session;
        $session->add($key, null);
    }

    //*************************OLD Functions***************************

    public function actionStart() {
        if ($this->getVar('user') != NULL) {
            $user = User::model()->findByPK($this->getVar('user'));
            $this->render('chart', array(
                'user' => $user,
            ));
        }
    }

    public function actionStat() {
        if ($this->getVar('user') != NULL) {
            $user = User::model()->findByPK($this->getVar('user'));
            $this->render('stat', array(
                'user' => $user,
            ));
        }
    }

    public function actionFriends_posts() {
        if ($this->getVar('user') != NULL) {
            $user = User::model()->findByPK($this->getVar('user'));
            $this->render('friends_posts', array(
                'user' => $user,
            ));
        }
    }

    public function actionIntro() {
        $this->render('intro', array(
        ));
    }

}
