<html>
<head>
    <title><?php echo $manualName ?></title>
</head>
<iframe height='456' src='<?php echo $this->Html->url(array("controller" => "manuals","action" => "manual", $manualId));?>' style="width:100%; height: 100%;">
    <?php
        print $file['Manual']['data'];
    ?>
</iframe>
</html>