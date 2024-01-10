jQuery(document).ready(function ($) {
    
    $('.delete-team-member').on('click', function (e) {
        e.preventDefault();
        var memberID = $(this).data('member-id');
        if (confirm('Are you sure you want to delete this team member?')) {
            $.ajax({
                type: 'POST',
                url: rul_teams_vars.ajax_url,
                data: {
                    action: 'delete_team_member',
                    member_id: memberID,
                },
                success: function (response) {
                    
                    console.log(response);
                },
                error: function (error) {
                    
                    console.log(error);
                },
            });
        }
    });
});
