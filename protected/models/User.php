
<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    //*********************************************Data Collection******************************************
    public function collectInfo() {
        $cmd_count = 0;
        //  $categories = array('1' => 'check-in', '2' => 'link', '3' => 'status','4'=>'photo', '5' => 'video', '6' => 'comment', '7' => 'others',);
        $categories = array('2' => 'link', '3' => 'status', '5' => 'video', '4' => 'photo');

        $facebook = $_SESSION['facebook'];

        //***************Set Times***********
        $all_friends = $facebook->api('/me/friends');
        $days_threshold = 3;

        ini_set('max_execution_time', 60 * 60);
        $start_time = mktime(0, 0, 0, date("m"), date("d") - $days_threshold, date("Y"));
        $end_time = time();
        $time_step = 4 * 60 * 60; //for when FB did not return the posts for a whole period of time and we had to make sub-queries
        //***************Set User Attributes & Save in DB****************
        $user = $facebook->getUser();

        if ($user) {
            $this->fbid = $user;
            $this->start_time = date("Y-m-d H:i:s", $start_time);
            $this->end_time = date("Y-m-d H:i:s", $end_time);
            $this->created_at = new CDbExpression('NOW()');

            if ($this->save()) {
                // Yii::log('success');
                // echo 'success';
            } else {
                print_r($this->getErrors());
            }
        } else {
            // echo 'cannot save user in DB!';
        }

        $cmd_count++;
        $i = 0;

        //****************Save All Friends' Basic information in DB*******************

        for ($f = 0; $f < sizeof($all_friends['data']); $f++) {

            $fbid = $all_friends['data'][$f]['id'];
            $friend = new Friend();
            $friend->fbid = $fbid;
            $friend->name = $all_friends['data'][$f]['name'];
            $friend->user = $this->id;
            if ($friend->save()) {
                //Yii::log('success');
                // echo 'success';
            } else {
                Yii::log($this->getErrors());
                print_r($this->getErrors());
            }
        }

        //*************************************Fetch News Feed (Shown Stories)*********************************
        //******Before, querying the whole time period did not retreive the NewsFeed Posts =>
        // I made it to time-slots using $time_step variable => 
        // but now, it does not work! and querying over the whole period works well! So, I came back to the first method!********
        // for ($ctime = $start_time; $ctime < $end_time; $ctime += $time_step) {
        //   $accesToken = Yii::app()->facebook->getAccessToken();
        //   $cmd = "me/home?fields=id,from,type,link,story,picture,source,name,description,message&limit=500&since=" . $ctime . "&until=" . ($ctime + $time_step);

        $cmd = "me/home?fields=id,from,type,link,story,picture,source,name,description,message,created_time&limit=500&since=" . $start_time . "&until=" . ($end_time);
        // $cmd = "me/home?fields=id,from,type,link,story,picture,source,name,description,message&limit=500";
        $me = $facebook->api($cmd);
        echo "cmd: " . $cmd . "<br>";
        echo "size of data: " . sizeof($me['data']) . '<br>';

        $cmd_count++;

        //************Save News Feed Stories at DB************
        $saved_shown_posts_count = 0;

        for ($j = 0; $j < sizeof($me['data']); $j++) {

            $postdata = new PostData();
            $postdata->user = $this->id;

            if (isset($me['data'][$j]['id'])) {
                $postdata->post_id = $me['data'][$j]['id'];
                // echo 'post_id(all): '. $postdata->post_id. '<br>';
            }


            if (isset($me['data'][$i]['from'])) {//Save post's authors' attributes
                if (isset($me['data'][$i]['from']['id'])) {
                    $postdata->from_id = $me['data'][$j]['from']['id']; // this is the author's Facebook ID.
                }
                if (isset($me['data'][$j]['from']['name'])) {
                    $postdata->from_name = $me['data'][$j]['from']['name'];
                }

                if (isset($postdata->from_id)) {
                    //   $friend_id = Friend::model()->find('fbid=:fbid AND user=:user', array(':fbid' => $postdata->from_id, ':user' => $this->id));
                    $friend_obj = Friend::model()->find(array(
                        'select' => 'id',
                        'condition' => 'fbid=:fbid AND user=:user',
                        'params' => array(':fbid' => $postdata->from_id, ':user' => $this->id),
                    ));
                    //echo $friend_id['id'] . '<br>';

                    if (isset($friend_obj['id'])) {
                        $postdata->friend = $friend_obj['id']; //this is the autor's Database ID and it needs to be saved!
                    }
                }
            }

            if (isset($me['data'][$j]['description'])) {
                $postdata->description = $me['data'][$j]['description'];
            }

            if (isset($me['data'][$j]['name'])) {
                $postdata->name = $me['data'][$j]['name'];
            }

            if (isset($me['data'][$j]['story'])) {
                $postdata->story = $me['data'][$j]['story'];
            }

            if (isset($me['data'][$j]['link'])) {
                $postdata->link = $me['data'][$j]['link'];
            }

            if (isset($me['data'][$j]['picture'])) {
                $postdata->picture = $me['data'][$j]['picture'];
            }

            if (isset($me['data'][$j]['message'])) {
                $postdata->message = $me['data'][$j]['message'];
            }

            if (isset($me['data'][$j]['source'])) {
                $postdata->source = $me['data'][$j]['source'];
            }

            if (isset($me['data'][$j]['created_time'])) {
                echo "time: " . $me['data'][$j]['created_time'] . '<br>';
                $timestamp = strtotime($me['data'][$j]['created_time']);
                $postdata->created_time = date($timestamp);
            }

            if (isset($me['data'][$j]['type'])) {
                $postdata->type = $me['data'][$j]['type'];
            }

            //*****Save postdata*****
            if ($postdata->save()) {
                
            } else {
                //Yii::log($postdata->getErrors());
                //echo 'cannot save this post since:<br>';
                //print_r($postdata->getErrors());
                return;
            }
        }
    }


    public function storyType() {//($startTime, $endTime) {
        $time_step = 24 * 60 * 60; //1 day
        $story_types = array();

        $ctime = 1;
        // for ($ctime = $startTime; $ctime < $endTime; $ctime += $time_step) {
        foreach ($this->postDatas as $dt) {
            // if ($dt->created_time == $ctime) {//shomehow you should just get the date not hours and see if ...

            switch ($dt->type) {
                case "photo":
                    if (!isset($story_types['photo'][$ctime])) {
                        $story_types['photo'][$ctime] = 0;
                    }
                    $story_types['photo'][$ctime] ++;
                    break;
                case "link":
                    if (!isset($story_types['link'][$ctime])) {
                        $story_types['link'][$ctime] = 0;
                    }
                    $story_types['link'][$ctime] ++;
                    break;
                case "video":
                    if (!isset($story_types['video'][$ctime])) {
                        $story_types['video'][$ctime] = 0;
                    }
                    $story_types['video'][$ctime] ++;
                    break;
                case "status":
                    if (!isset($story_types['status'][$ctime])) {
                        $story_types['status'][$ctime] = 0;
                    }
                    $story_types['status'][$ctime] ++;
                    break;
                default:
                    echo "This story has no type!";
            }

// }
        }
        //    }
        return $story_types;
    }

//***********************************************************Analysis*****************************************************
    public function SeentoAll() {

        ini_set('memory_limit', '-1');
        $users = User::model()->findAll();
        $content = "User Code, DB ID, Seen%\n";

        foreach ($users as $key => $user) {
            $count_seen = 0;
//  echo $user->id . "salam/n";
            foreach ($user->postDatas as $pd) {
                if ($pd->seen == 1) {
                    $count_seen ++;
                }
            }
            if (sizeof($user->postDatas) == 0) {
//   echo $user->id . "khaaaaaaaaar\n";
            } else {
                $percent_seen = $count_seen / sizeof($user->postDatas);
                $content .= $user->code . "," . $user->id . "," . $percent_seen . "\n";
            }
        }
        $proj_path = dirname(Yii::app()->getBasePath()) . '/protected/data/';
        $proj_path = str_replace('\\', '/', $proj_path);

        $file = $proj_path . 'SeentoAll.txt';
        file_put_contents($file, $content);
    }

    public function posts_change() {

        ini_set('memory_limit', '-1');
        $users = User::model()->findAll();
        $content = "User Code, DB ID, Original Seen#, Changed_Seen#, Original NotSeen#, Changed_NotSeen#, Changed_Seen%, Changed_NotSeen% \n";


        foreach ($users as $key => $user) {
            $seen_chosen = 0;
            $notseen_chosen = 0;
            $seen_to_notseen = 0;
            $notseen_to_seen = 0;
            $seen_to_notseen_percent = 0;
            $notseen_to_seen_percent = 0;

            foreach ($user->postDatas as $pd) {
                if ($pd->chosen == 1) {
                    if ($pd->seen == 0) {
                        $notseen_chosen ++;

                        if ($pd->changed == 1) {
                            $notseen_to_seen ++;
                        }
                    } else {
                        $seen_chosen ++;
                        if ($pd->changed == 1) {
                            $seen_to_notseen ++;
                        }
                    }
                }
            }

//$final_seen = $seen_chosen - $seen_to_notseen + $notseen_to_seen;
//$final_notseen = $notseen_chosen - $notseen_to_seen + $seen_to_notseen;
            if ($seen_chosen != 0) {
                $seen_to_notseen_percent = $seen_to_notseen / $seen_chosen;
            }

            if ($notseen_chosen != 0) {
                $notseen_to_seen_percent = $notseen_to_seen / $notseen_chosen;
            }
            $content .= $user->code . "," . $user->id . "," . $seen_chosen . "," . $seen_to_notseen . "," . $notseen_chosen . "," . $notseen_to_seen . "," . $seen_to_notseen_percent . "," . $notseen_to_seen_percent . "\n";


            $proj_path = dirname(Yii::app()->getBasePath()) . '/protected/data/';
            $proj_path = str_replace('\\', '/', $proj_path);

            $file = $proj_path . 'PostsChange.txt';
            file_put_contents($file, $content);
        }
    }

    public static function friends_change() {

        ini_set('memory_limit', '-1');
        $users = User::model()->findAll();
        $content = "User Code, DB ID, "
                . "Rare#, Rare_Sometimes#, Rare-Almost#, Change_from_Rare%,"
                . "Sometimes#, Sometimes_Rare#, Sometimes_Almost, Change_from_Sometimes%,"
                . "Almost#, Almost_Rare#, Almost_Sometimes#, Change_from_Almost,"
                . "Change_to_Less%, Change_to_More%, Total_Change% \n";

        $proj_path = dirname(Yii::app()->getBasePath()) . '/protected/data/';
        $proj_path = str_replace('\\', '/', $proj_path);

        foreach ($users as $key => $user) {

            $rare = 0;
            $rare_to_sometimes = 0;
            $rare_to_almost = 0;
            $change_from_rare = 0;

            $sometimes = 0;
            $sometimes_rare = 0;
            $sometimes_almost = 0;
            $change_from_sometimes = 0;

            $almost = 0;
            $almost_rare = 0;
            $almost_sometimes = 0;
            $change_from_almost = 0;

            $change_to_more = 0;
            $change_to_less = 0;

            $total_change = 0;

            foreach ($user->friends as $fr) {
                if ($fr->chosen == 1) {
                    if ($fr->initial == 0) {
                        $rare++;
                        if ($fr->changed == 1) {
                            $rare_to_sometimes ++;
                        } else if ($fr->changed == 2) {
                            $rare_to_almost ++;
                        }
                    } else if ($fr->initial == 1) {
                        $sometimes++;
                        if ($fr->changed != NULL) {
                            if ($fr->changed == 0) {
//echo "changed: " . $fr->changed . "<br>";
                                $sometimes_rare ++;
                            } else if ($fr->changed == 2) {
                                $sometimes_almost ++;
                            }
                        }
                    } else if ($fr->initial == 2) {
                        $almost++;
                        if ($fr->changed != NULL) {
                            if ($fr->changed == 0) {
                                $almost_rare ++;
                            } else if ($fr->changed == 1) {
                                $almost_sometimes ++;
                            }
                        }
                    }
                }
            }

            if ($rare != 0 & $sometimes != 0 & $almost != 0) {
                $change_from_rare = ($rare_to_sometimes + $rare_to_almost) / ($rare);
                $change_from_sometimes = ($sometimes_rare + $sometimes_almost) / ($sometimes);
                $change_from_almost = ($almost_sometimes + $almost_rare) / ($almost);

                $change_to_more = ($rare_to_sometimes + $rare_to_almost + $sometimes_almost) / ($rare + $sometimes);
                $change_to_less = ($almost_rare + $almost_sometimes + $sometimes_rare) / ($almost + $sometimes);

                $total_change = ($rare_to_sometimes + $rare_to_almost + $sometimes_rare + $sometimes_almost + $almost_rare + $almost_sometimes) / ($rare + $sometimes + $almost);
            }

            $content .= $user->code . "," . $user->id . "," . $rare . "," . $rare_to_sometimes . "," . $rare_to_almost . "," . $change_from_rare . "," .
                    $sometimes . "," . $sometimes_rare . "," . $sometimes_almost . "," . $change_from_sometimes . "," .
                    $almost . "," . $almost_rare . "," . $almost_sometimes . "," . $change_from_almost . "," .
                    $change_to_less . "," . $change_to_more . "," . $total_change . "\n";

            $file = $proj_path . 'FriendsChange.txt';
            file_put_contents($file, $content);
        }
    }

}
