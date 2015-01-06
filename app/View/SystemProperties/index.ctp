<div class="systemProperties index">
    <h3 style="clear:none;margin-top:0px;"><?php echo __('System Properties'); ?></h3>
    <div style="float:right;">
        <?php echo $this->Html->link("Back to Admin", array('controller'=>'admin_pages', 'action'=>'admin_home'),array('escape' => false) ); ?>
    </div>
    <?php echo $this->Html->link("Add A New Property", array('action'=>'add'),array('escape' => false) ); ?>

    <table cellpadding="0" cellspacing="0" id="pattern-style-b">
        <tr>
            <th>Name</th>
            <th>Value</th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($systemProperties as $systemProperty): ?>
        <tr>
            <td><?php echo h($systemProperty['SystemProperty']['name']); ?>&nbsp;</td>
            <td><?php echo h($systemProperty['SystemProperty']['value']); ?>&nbsp;</td>
            <td class="actions" style="font-size:8px;">
                <div style="width:90px">
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $systemProperty['SystemProperty']['id'])); ?>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>