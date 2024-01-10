<div class="wrap">
    <h1 class="wp-heading-inline">Team Members</h1>

<?php
    $list_table = new Team_Member_List_Table();
    $list_table->prepare_items();
    $list_table->display();
    ?>
</div>
