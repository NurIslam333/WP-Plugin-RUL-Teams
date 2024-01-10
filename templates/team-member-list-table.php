<?php
class Team_Member_List_Table extends WP_List_Table {
    public function __construct() {
        parent::__construct(array(
            'singular' => 'team_member',
            'plural'   => 'team_members',
            'ajax'     => false,
        ));
    }

    public function get_columns() {
        return array(
            'cb'        => '<input type="checkbox" />',
            'name'      => 'Name',
            'email'     => 'Email',
            'position'  => 'Position',
            'actions'   => 'Actions',
        );
    }

    public function prepare_items() {
        
        $data = $this->get_team_members_data();

        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->items = $data;
    }

    public function column_default($item, $column_name) {
        return $item[$column_name];
    }

    public function column_cb($item) {
        return sprintf('<input type="checkbox" name="team_member[]" value="%s" />', $item['id']);
    }

    public function column_actions($item) {
        $actions = array(
            'edit'   => sprintf('<a href="?page=rul-teams&action=edit&id=%s">Edit</a>', $item['id']),
            'delete' => sprintf(
                '<a href="#" class="delete-team-member" data-member-id="%s">Delete</a>',
                $item['id']
            ),
        );

        return sprintf('%1$s %2$s', $item['actions'], $this->row_actions($actions));
    }

    private function get_team_members_data() {
        
        global $wpdb;
        $data = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}rul_teams", ARRAY_A);
        return $data;
    }

    public function get_sortable_columns() {
        return array(
            'name'     => array('name', false),
            'email'    => array('email', false),
            'position' => array('position', false),
        );
    }
}
