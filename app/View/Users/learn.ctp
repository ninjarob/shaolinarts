<h1>Learn</h1>
Here are the manuals you currently have available for your current rank and interests.
<?php if (AuthComponent::user('KungFuRank')['id'] != null) { ?>
<p>Kung Fu Manual (Your Kung Fu rank is currently "<?php echo (AuthComponent::user('KungFuRank')['name']) ?>").</p>
<ul class="list-group">
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Train', '/users/train') ?>
    </li>
</ul>
<?php } ?>
<?php if (AuthComponent::user('TaiChiRank')['id'] != null) { ?>
Tai Chi Manual (Your Tai Chi rank is currently "<?php echo (AuthComponent::user('TaiChiRank')['name']) ?>").

<?php } ?>
</table>