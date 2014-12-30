<h1>Manual Management</h1>
<table id="pattern-style-b">
    <thead>
    <tr>
        <th>Manual Name</th>
        <th>Description</th>
        <th>Role Type</th>
    </tr>
    </thead>
    <tbody>
    <?php $count=0; ?>
    <?php foreach($manuals as $manual): ?>
    <?php $count ++;?>
    <?php if($count % 2): echo '<tr>'; else: echo '
    <tr class="zebra">' ?>
        <?php endif; ?>
        <td>
            <?php echo $this->Form->input('UserInfo.fname', array('label'=>'', 'maxLength' => 32, 'title' => 'First Name')); ?>
            <div style="width:80px">
            <?php echo $manual['Manual']['name']; ?></div>
        </td>
        <td><div style="width:80px"><?php echo $manual['Manual']['description']; ?></div></td>
        <td>

        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>