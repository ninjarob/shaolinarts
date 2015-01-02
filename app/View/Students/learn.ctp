<div class="manuals index">
    <h3 style="clear:none;margin-top:0px;">Learn</h3>
    <div style="float:right;">
        <?php echo $this->Html->link( "Back Home", array('controller'=>'users', 'action'=>'user_home'),array('escape' => false) ); ?>
    </div>

    <table cellpadding="0" cellspacing="0" id="pattern-style-b">
        <?php foreach ($manuals as $manual): ?>
        <tr>
            <td><div style="width:180px"><?php echo $this->Html->link(h($manual['Manual']['name']), array('controller'=>'manuals', 'action' => 'show', $manual['Manual']['id']), array('target'=>'_blank')); ?>&nbsp;</div></td>
            <td><div style="width:250px"><?php echo h($manual['Manual']['description']); ?>&nbsp;</div></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>