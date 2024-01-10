<?php
class RUL_Teams {
    private $table_name;

    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'rul_teams';

        add_action('admin_menu', array($this, 'add_menu'));
        add_action('wp_ajax_delete_team_member', array($this, 'ajax_delete_team_member'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function add_menu() {
        add_menu_page('RUL Teams', 'RUL Teams', 'manage_options', 'rul-teams', array($this, 'team_member_list_page'));
    }

    public function team_member_list_page() {
        include plugin_dir_path(__FILE__) . 'templates/team-member-list.php';
    }

    public function ajax_delete_team_member() {
        if (isset($_POST['member_id'])) {
            $member_id = intval($_POST['member_id']);
            $this->delete_team_member($member_id);
            echo json_encode(array('success' => true));
        }

        die();
    }

    private function delete_team_member($member_id) {
        global $wpdb;
        $wpdb->delete($this->table_name, array('id' => $member_id));
    }

    public function enqueue_scripts() {
        wp_enqueue_style('rul-teams-style', plugin_dir_url(__FILE__) . 'css/style.css');
        wp_enqueue_script('rul-teams-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), '', true);
        wp_localize_script('rul-teams-script', 'rul_teams_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }

    public function team_member_list_page() {
        if (isset($_POST['submit'])) {
            $this->add_team_member();
        }
    
        include plugin_dir_path(__FILE__) . 'templates/team-member-list.php';
    }
    
    private function add_team_member() {
        if (
            isset($_POST['submit'])
            && wp_verify_nonce($_POST['add_team_member_nonce'], 'add_team_member_nonce')
        ) {
            $name = sanitize_text_field($_POST['member_name']);
            $email = sanitize_email($_POST['member_email']);
            $position = sanitize_text_field($_POST['member_position']);
    
            global $wpdb;
            $wpdb->insert(
                $this->table_name,
                array(
                    'name' => $name,
                    'email' => $email,
                    'position' => $position,
                ),
                array('%s', '%s', '%s')
            );
    
            
        }
    }
    
}
