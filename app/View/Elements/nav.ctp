<ul>
    <li id="nav_home" class="li_current_mark">
        <?php echo $this->Html->link('Home', '/pages/home', array('class' => 'text-shadow: none!important;')); ?>
    </li>
    <li id="nav_info">
        <?php echo $this->Html->link('Class Information', '/pages/class-information') ?>
    </li>
    <li id="nav_locations">
        <?php echo $this->Html->link('Locations', '/pages/locations') ?>
    </li>
    <li id="nav_faq">
        <?php echo $this->Html->link('FAQ', '/pages/faq') ?>
    </li>
    <li id="nav_events">
        <?php echo $this->Html->link('Current Events', '/pages/events') ?>
    </li>
    <li id="nav_study">
        <?php echo $this->Html->link('Areas of Study', '/pages/areas-of-study') ?>
        <ul>
            <li>
                <?php echo $this->Html->link('Kung Fu', '/pages/kung-fu') ?>
            </li>
            <li>
                <?php echo $this->Html->link('Tai Chi', '/pages/tai-chi') ?>
            </li>
            <li>
                <?php echo $this->Html->link('Self Defense', '/pages/self-defense') ?>
            </li>
            <li>
                <?php echo $this->Html->link('Mixed Martial Arts', '/pages/mma') ?>
            </li>
            <li>
                <?php echo $this->Html->link('Fitness', '/pages/fitness') ?>
            </li>
        </ul>
    </li>
    <li id="nav_more_info">
        <?php echo $this->Html->link('More Information', '/pages/information') ?>
        <ul>
            <li>
                <?php echo $this->Html->link('About Shaolin Arts', '/pages/about-us') ?>
            </li>
            <li>
                <?php echo $this->Html->link('Current Events', '/pages/events') ?>
            </li>
            <li>
                <?php echo $this->Html->link('Class Information', '/pages/class-information') ?>
            </li>
            <li>
                <?php echo $this->Html->link('Locations', '/pages/locations') ?>
            </li>
            <li>
                <?php echo $this->Html->link('FAQ', '/pages/faq') ?>
            </li>
            <li>
                <?php echo $this->Html->link('Contact Us', '/pages/contact_form') ?>
            </li>
            <li>
                <?php echo $this->Html->link('History & Philosophy', '/pages/history') ?>
            </li>
        </ul>
    </li>
    <?php if (!$authUser) { ?>
    <li>
        <?php echo $this->Html->link('Student/Instructor Login', '/users/login') ?>
    </li>
    <?php } else { ?>
    <li>
        <?php echo $this->Html->link('Extra', '/users/extra') ?>

        <ul>
            <?php if($acl->check(array('User' => $authUser), 'ContentAdmin')) { ?>
                <li>
                    <?php echo $this->Html->link('Edit Content', '/contentAdmins/index') ?>
                </li>
            <?php } ?>
            <?php if($acl->check(array('User' => $authUser), 'UserAdmin')) { ?>
            <li>
                <?php echo $this->Html->link('User Admin', '/users/index') ?>
            </li>
            <?php } ?>
            <?php if($acl->check(array('User' => $authUser), 'ViewAdvancedMaterials')) { ?>
                <li>
                    <?php echo $this->Html->link('Advanced Material', '/advancedStudents/index') ?>
                </li>
            <?php } ?>
            <?php if($acl->check(array('User' => $authUser), 'ViewNoviceMaterials')) { ?>
                <li>
                    <?php echo $this->Html->link('Novice Material', '/noviceStudents/index') ?>
                </li>
            <?php } ?>
        </ul>
    </li>
    <li>
        <?php echo $this->Html->link('Logout', '/users/logout', array('style'=>'width:85px;')) ?>
    </li>
    <?php } ?>
</ul>