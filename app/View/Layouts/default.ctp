<?php
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Shaolin Arts</title>
    <?php
    echo $this->Html->css('shaolinarts');
    echo $this->Html->script('jquery-1.9.1.min');
    ?>
    <meta name="Keywords" content="Kung Fu, Tai Chi, Tai Chi Chuan, self defense, karate, fitness, sandy, Utah, Arizona, Marital Arts">
    <meta name="Description" content="Shaolin Arts is a family system of martial arts over 3,000 years old. Common western terms used to describe it would be Kung Fu, Tai Chi Chuan, Karate, Self Defense, Wushu, Animal Styles, Mixed Martial Arts, Chi Qi Gung or grappling. ">
</head>
<body>
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Session->flash(); ?>

    <?php echo $this->fetch('content'); ?>
    <div id="footer">
        <div id="footercontent">
            <p class="footphone">(623) 581-2000 Glendale, AZ • (801) 566-6364 Sandy, UT • (801) 967-2300 Taylorsville,
                UT<br>
            </p>

            <p>© Copyright 2010 Shaolin Arts, LLC. All Rights Reserved.</p>
        </div>
    </div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
