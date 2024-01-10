<form id="add-team-member-form" method="post">
    <table class="form-table">
        <tr>
            <th scope="row"><label for="member_name">Name</label></th>
            <td><input type="text" name="member_name" id="member_name" required></td>
        </tr>
        <tr>
            <th scope="row"><label for="member_position">Designation</label></th>
            <td><input type="text" name="member_position" id="member_position" required></td>
        </tr>
        <tr>
            <th scope="row"><label for="member_id">ID</label></th>
            <td><input type="text" name="member_id" id="member_id" required></td>
        </tr>
        <tr>
            <th scope="row"><label for="member_email">Email</label></th>
            <td><input type="email" name="member_email" id="member_email" required></td>
        </tr>
    </table>

    <?php wp_nonce_field('add_team_member_nonce', 'add_team_member_nonce'); ?>

    <input type="submit" name="submit" value="Add Team Member">
</form>
