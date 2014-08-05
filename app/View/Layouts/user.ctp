<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords"
          content="Kung Fu, Tai Chi, Tai Chi Chuan, self defense, karate, fitness, sandy, Utah, Arizona, Marital Arts">
    <meta name="Description"
          content="Shaolin Arts is a family system of martial arts over 3,000 years old. Common western terms used to describe it would be Kung Fu, Tai Chi Chuan, Karate, Self Defense, Wushu, Animal Styles, Mixed Martial Arts, Chi Qi Gung or grappling. ">
    <title>Shaolin Arts</title>
    <?php
        echo $this->Html->css('persistant');
        echo $this->Html->css('datepicker');
        echo $this->Html->css('shaolinarts');
        echo $this->Html->css('tables');
        echo $this->Html->script('jquery-1.11.1.min.js');
        echo $this->Html->script('jquery.fastLiveFilter.js');
        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->script('bootstrap-datepicker.js');
    ?>
</head>
<body>
<div class="container">
    <div class="row header">

        <?php echo $this->element('banner'); ?>
        <?php echo $this->element('navigation'); ?>

        <div class="row corpus">
            <div class="col-md-3 asideColumn hidden-xs hidden-sm">
                <aside class="contentCol">
                    <?php echo $this->element('admin_pages_column'); ?>
                </aside>
            </div>
            <div class="col-md-9 sectionContent">
                <?php echo $this->Session->flash('auth'); ?>
                <?php echo $this->Session->flash(); ?>
                <section class="contentCol">
                <?php echo $this->fetch('content'); ?>
                </section>
            </div>
        </div>

        <div class="row footer">
            <div class="col-md-12">
                <footer>
                    <p>
                        (623) 581-2000 Glendale, AZ &bull; (801) 566-6364 Sandy, UT &bull; (801) 967-2300 Taylorsville,
                        UT<br/>
                        <small>&copy; Copyright 2010 - 2013 Shaolin Arts, LLC. All Rights Reserved.</small>
                    </p>
                </footer>
            </div>
        </div>
    </div>
    <?php echo $this->element('sql_dump'); ?>
</div>
</body>
</html>