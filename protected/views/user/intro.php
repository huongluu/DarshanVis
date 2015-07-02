<div class="hero-unit">
    <h2>Visualizing Your Facebook News Feed</h2>
    
        <?php
        if ((Yii::app()->facebook->isUserLogin())) {
            
            echo CHtml::button('Start', array('class' => 'btn btn-primary btn-large', 'submit' => array('user/load')));
        }
        ?>



    </p>
</div>
