<style>
    ul .home_links {
        width: 500px;
        height: 500px;
    }
    .home_links li {
        float:left;
        list-style-type: none;
        width: 200px;
        height: 200px;
        background-color: white;
        moz-border-radius: 15px;
        -webkit-border-radius: 15px;
        border-radius: 15px;
        border: 5px solid black;
        padding: 5px;
        margin:15px;
    }
    .home_links li:hover {
        opacity: 0.6;
    }
    .home_links A:link {color: blue; text-decoration:none}
    .home_links A:visited {color: blue; text-decoration:none}
    .home_links A:hover {text-decoration:underline; opacity: 0.6; }

    h3 {font-family: "fs-rome"}
</style>

<h3 style="margin:0 50px 0 50px;">"Don't only practise your art, but force your way into its secrets; art deserves that, for it and knowledge can raise man to the Divine."<span style="font-size:10px;">~Ludwig van Beethoven</span></h3>

<ul class='home_links'>
    <?php if ($this->User->isStudent(AuthComponent::user('id'))) {  ?>
    <li>
        <div style="height:190px;">
            <?php echo $this->Html->link($this->Html->image('userImages/train.png', array('alt' => 'Train', 'border' => '0', 'height'=>'170', 'style'=>'border:none;')), '/students/train', array('escape' => false)) ?>
        </div>
        <p style="text-align:center; font-weight:bold; bottom:5px;">Train</p>
    </li>
    <li>
        <div style="height:190px;">
            <?php echo $this->Html->link($this->Html->image('userImages/record.png', array('alt' => 'Record', 'border' => '0', 'width' => '225', 'style'=>'border:none;')), '/students/record', array('escape' => false)) ?>
        </div>
        <p style="text-align:center; font-weight:bold; bottom:5px;">Record</p>
    </li>
    <li>
        <div style="height:190px;">
            <?php echo $this->Html->link($this->Html->image('userImages/learn.png', array('alt' => 'Learn', 'border' => '0', 'width' => '225', 'style'=>'border:none;')), '/students/learn', array('escape' => false)) ?>
        </div>
        <p style="text-align:center; font-weight:bold; bottom:5px;">Learn</p>
    </li>
    <li>
        <div style="height:190px;">
            <?php echo $this->Html->link($this->Html->image('userImages/play.png', array('alt' => 'Play', 'border' => '0', 'width' => '225', 'style'=>'border:none;')), '/students/play', array('escape' => false)) ?>
        </div>
        <p style="text-align:center; font-weight:bold; bottom:5px;">Play</p>
    </li>
    <?php } ?>
    <li>
        <div style="height:190px;">
            <?php echo $this->Html->link($this->Html->image('userImages/extra.png', array('alt' => 'Extra Goodies', 'border' => '0', 'height' => '170', 'style'=>'border:none; margin-top:auto; margin-left:20px;')), '/users/extra', array('escape' => false)) ?>
        </div>
        <p style="text-align:center; font-weight:bold;">Extra Goodies</p>
    </li>
    <li>
        <div style="height:190px;">
            <?php echo $this->Html->link($this->Html->image('userImages/account.png', array('alt' => 'Account', 'border' => '0', 'width' => '225', 'style'=>'border:none;')), '/users/account', array('escape' => false)) ?>
        </div>
        <p style="text-align:center; font-weight:bold;">Account</p>
    </li>
    <?php if ($this->User->isAdmin(AuthComponent::user('id'))) {  ?>
    <li>
        <div style="height:190px;">
            <?php echo $this->Html->link($this->Html->image('userImages/admin.png', array('alt' => 'Account', 'border' => '0', 'width' => '225', 'style'=>'border:none;')), '/admin_pages/admin_home', array('escape' => false)) ?>
        </div>
        <p style="text-align:center; font-weight:bold;">Admin</p>
    </li>
    <?php } ?>
</ul>
<div style="width: 20px; height 500px;">&nbsp;</div>