<div class="hero-unit">
    <h2>Welcome Back!</h2>
    <p>
        <?php echo CHtml::beginForm(); ?>

    <div>Please enter your code to continue </div><br>
    Your Code: <?php echo CHtml::textField('code'); ?>


    <?php
    if (isset($error_msg))
        echo $error_msg;
    ?>
    </p>
    <div class="row">
        <?php echo CHtml::submitButton('Continue', array('class' => 'btn btn-primary btn-large')); ?>
    </div>
    <?php echo CHtml::endForm(); ?>

</div>

<div>

