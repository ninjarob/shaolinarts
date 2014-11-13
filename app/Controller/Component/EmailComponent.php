 <?php
App::import('Vendor', 'PhpMailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));
/*
    Depends on "unhtml"
*/

class EmailComponent extends PHPMailer
{
    // phpmailer
    var $Mailer = 'sendmail'; // choose 'sendmail', 'mail', 'smtp'
    var $unhtml_bin = '/usr/bin/unhtml';

    // component
    var $controller;

    function startup( &$controller )
    {
        $this->controller = &$controller;
    }

    function renderBody($view)
    {
        // render the view and use its output to set the body text of the email
        $this->Body = $this->controller->render('emails/' . $view, 'email');

        // reset the output of the controller
        $this->controller->output = '';

        // create plain text version of the email
        //
        // create temporary files
        $htmlfile = tempnam(TMP, 'htmlfile');
        $textfile = tempnam(TMP, 'textfile');

        // write html to temporary file
        file_put_contents($htmlfile, $this->Body);

        // convert the html file to plain text
        $cmd = "cat $htmlfile | $this->unhtml_bin > $textfile";
        system($cmd);

        // set the plain text body of the email
        $this->AltBody = file_get_contents($textfile);

        // remove temporary files
        unlink($htmlfile);
        unlink($textfile);
    }

    function initialize(){}
    function beforeRedirect(){}
    function beforeRender(){}
    function shutdown(){}
}

?>