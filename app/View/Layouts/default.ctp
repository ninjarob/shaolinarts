<?php
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Keywords" content="Kung Fu, Tai Chi, Tai Chi Chuan, self defense, karate, fitness, sandy, Utah, Arizona, Marital Arts">
        <meta name="Description" content="Shaolin Arts is a family system of martial arts over 3,000 years old. Common western terms used to describe it would be Kung Fu, Tai Chi Chuan, Karate, Self Defense, Wushu, Animal Styles, Mixed Martial Arts, Chi Qi Gung or grappling. ">
        <title>Shaolin Arts</title>
        <?php
            echo $this->Html->css('persistant');
            echo $this->Html->css('datepicker');
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <?php
            echo $this->Html->script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js');
            echo $this->Html->script('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js');
        ?>
        <![endif]-->
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-48710106-1']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
    <body>
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Session->flash(); ?>
        <div class="container">
            <div class="row header">
                <?php echo $this->fetch('content'); ?>
                <div class="row footer">
                    <div class="col-md-12">
                        <footer>
                            <p>
                            (623) 581-2000 Glendale, AZ &bull; (801) 566-6364 Sandy, UT &bull; (801) 967-2300 Taylorsville, UT<br />
                            <small>&copy; Copyright 2010 - 2013 Shaolin Arts, LLC. All Rights Reserved.</small>
                            </p>
                        </footer>
                    </div>
                </div>
            </div>
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script src="js/jquery.fastLiveFilter.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="js/bootstrap.min.js"></script>
            <script src="js/bootstrap-datepicker.js"></script>
            <script type="text/javascript">
            $(function() {
            $('#search_input').fastLiveFilter('#search_list');
            });
            </script>
            <?php echo $this->element('sql_dump'); ?>
        </div>
    </body>
</html>