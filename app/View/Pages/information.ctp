<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    </head>
    <body>
        <?php echo $this->element('grey_nav'); ?>
        <div id="columnwrapper">
            <div id="c1">
                <div class="content">
                    <h2 class="topZero"><?php echo $this->Html->image('Chuan-Fa-char-with-English.jpg', array('alt'=>'chuan fa')) ?></h2>
                    <p><?php echo $this->Html->image('Chen-character-englishBlackGold.jpg', array('alt'=>'chen tai chi chuan')) ?></p>
                </div>
            </div>
            <div id="c2">
                <div class="content">
                    <h1>This page will direct you to the following topics:</h1>
                    <h1><?php echo $this->Html->link('About Shaolin Arts', '/pages/about-us') ?></h1>
                    <h1><?php echo $this->Html->link('Current Events', '/pages/events') ?></h1>
                    <h1><?php echo $this->Html->link('Class Information', '/pages/class-information') ?></h1>
                    <h1><?php echo $this->Html->link('School Locations', '/pages/locations') ?></h1>
                    <h1><?php echo $this->Html->link('FAQ, Frequently Asked Questions', '/pages/faq') ?></h1>
                    <h1><?php echo $this->Html->link('Contact Us', '/pages/contact_form') ?></h1>
                    <h1><?php echo $this->Html->link('History & Philosophy', '/pages/history') ?></h1>
                </div>
            </div>
        </div>
    </body>
</html>