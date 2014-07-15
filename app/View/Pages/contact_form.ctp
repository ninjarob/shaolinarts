<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    </head>
    <body>
        <?php echo $this->element('grey_nav_large_only'); ?>
        <div id="columnwrapper">
            <div id="c2" class="solo">
                <div class="content">
                    <h1>Contact</h1>

                    <p>If you have questions about our programs and how they can benefit you, use the phone numbers at the bottom of the page to contact the studio closest to you, or fill in the form below and we will contact you to answer any questions you have.</p>

                    <p>We do need to stay focused on individuals willing to travel to our studios,or interested in scheduling our clinics and workshops we give throughout North America.</p>

                    <p>Our main contact number in Utah is 801-566-6364, and in Arizona call 623-581-2000.</p>
                </div>
                <div id="entryform" class="contactform">
                    <?php
                        echo $this->Form->create('Contact', array('action'=>'sendContactMessage'));
                        echo $this->Form->inputs(array('fieldset'=>false));
                        echo $this->Form->end('Send');
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>