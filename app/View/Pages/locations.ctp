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
                    <h1>Locations</h1>
                    <p>Shaolin Arts studios are located in Utah and Arizona. Below are maps and addresses of our current locations.</p>
                    <h2>The Shaolin Arts Sandy Studio is located at: </h2>
                    <p>8536 South 1300 East, Sandy, Utah 84094 801-566-6364</p>
                    <p>
                        <?php echo $this->Html->image('sandymap.gif', array('alt'=>'sandy map')) ?>
                    </p>
                    <p>&nbsp;</p>
                    <h2>The Shaolin Arts Taylorsville Studio is located at: </h2>
                    <p>2312 West 5400 South, Taylorsville, Utah 801-967-2300</p>
                    <h2>
                        <?php echo $this->Html->image('tmap.gif', array('alt'=>'taylorsville map')) ?>
                    </h2>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <h2>The Shaolin Arts Phoenix Studio is located at: </h2>
                    <p>4330 West Union Hills Drive, Suite B 8, Glendale, AZ 85308 623-581-2000</p>
                    <p>
                        <?php echo $this->Html->image('AZmap.gif', array('alt'=>'phoenix map')) ?>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>