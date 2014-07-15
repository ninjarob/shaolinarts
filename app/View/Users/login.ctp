<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<?php echo $this->element('grey_nav_large_only'); ?>
<div id="columnwrapper">
    <div id="c1">
        <div class="content">
            <h2 class="topZero"><?php echo $this->Html->image('Chuan-Fa-char-with-English.jpg', array('alt' => 'chuan fa')) ?></h2>

            <p><?php echo $this->Html->image('Chen-character-englishBlackGold.jpg', array('alt' => 'chen tai chi chuan')) ?></p>
        </div>
    </div>
    <div id="c2">
        <div class="content">
            <h2>Log in</h2>
            <div id="entryform" class="loginform">
                <div class="instructions">
                    Please enter your username and password
                </div>
                <?php
                echo $this->Form->create('User', array('name'=>'form1'));
                echo $this->Form->input('username');
                echo $this->Form->input('password');
                ?>
                <!--<div class="instructions">
                    <a href="http://shaolinarts.com/passwordManagement.php" ajax="false">Did you forget your user name or password?</a>
                </div>
                <div class="instructions">
                    <a href="http://shaolinarts.com/newMember.php" ajax="false">Is this the first time at the website?</a>
                </div>-->
                <?php
                echo $this->Form->end("Login");
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>