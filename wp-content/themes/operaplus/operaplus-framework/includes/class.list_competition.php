<?php
namespace OperaPlus;

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}


class List_Competition extends \WP_List_Table {

    function __construct(){
        global $status, $page;

        parent::__construct( array(
            'singular'  => 'operaplus_competition',     //singular name of the listed records
            'plural'    => 'operaplus_competition',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );

    }


    function column_default($item, $column_name){
        switch($column_name){
            default:
                return $item->$column_name;
        }
    }


    function column_title($item){

        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>',$_REQUEST['page'],'edit',$item['ID']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>',$_REQUEST['page'],'delete',$item['ID']),
        );

        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['title'],
            /*$2%s*/ $item['ID'],
            /*$3%s*/ $this->row_actions($actions)
        );
    }


    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item->id                //The value of the checkbox should be the record's id
        );
    }


    function get_columns(){
        $columns = array(
            'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'jmeno'    => 'Jméno',
            'email'       => 'Email',
            'adresa'    => 'Adresa',
            'odpoved'    => 'Odpověď',
            'poznamka' =>'Poznámka',
            'post_id' =>'Post ID',

        );
        return $columns;
    }



    function get_sortable_columns() {
        $sortable_columns = array(
            'title'     => array('title',false),     //true means it's already sorted
            'rating'    => array('rating',false),
            'director'  => array('director',false)
        );
        return $sortable_columns;
    }


    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action() {

        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            wp_die('Items deleted (or they would be if we had items to delete)!');
        }

    }



    function prepare_items() {
        global $wpdb;

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = 10000;



        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);


        $this->process_bulk_action();
        $current_page = $this->get_pagenum();
        $args = [
            'number' => $per_page,
            'offset' => ($current_page - 1) * $per_page
        ];


        $join = '';
        $count = 1;
        $select = [];
        $where = '';
        foreach ($this->get_columns() as $key => $field) {
            if ($key != 'cb') {
                $join .= " LEFT JOIN {$wpdb->prefix}cf7dbplugin_submits db{$count} ON db.submit_time = db{$count}.submit_time AND db{$count}.field_name = '{$key}'";
                $select[] = "db{$count}.field_value as {$key}";
                $count++;
            }
        }

        $select = implode(',',$select);

        if (isset($_POST['competition_id']) && $_POST['competition_id'] != '') {
            $post_id = (int)$_POST['competition_id'];
            $join .= " LEFT JOIN {$wpdb->prefix}cf7dbplugin_submits db{$count} ON db.submit_time = db{$count}.submit_time AND db{$count}.field_name = 'post_id'";
            $where .= " AND db{$count}.field_value = {$post_id}";
            $select .= ", db{$count}.field_value";
        }


        $query = "SELECT db.submit_time, {$select}  FROM {$wpdb->prefix}cf7dbplugin_submits db
    {$join}
WHERE db.form_name = 'odpoved' {$where}
GROUP BY db.submit_time";

        
        //die(var_dump($query));

        $data = $wpdb->get_results($query);


        
        $total_items = count($data);


        /**
         * REQUIRED. Now we can add our *sorted* data to the items property, where
         * it can be used by the rest of the class.
         */
        $this->items = $data;


        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


}





add_action('admin_menu', '\OperaPlus\admin_page_competitions');
function admin_page_competitions(){
    add_submenu_page ( 'edit.php?post_type=soutez', 'Odpovědi', 'Odpovědi', 'activate_plugins', 'operaplus-competitions-list', '\OperaPlus\render_competitions_list_page' );
}



function render_competitions_list_page(){

    //Create an instance of our package class...
    $testListTable = new List_Competition();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();



    ?>
    <div class="wrap">

        <div id="icon-users" class="icon32"><br/></div>
        <h2>Credits Log</h2>
        <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
        <form action="<?php echo $actual_link;?>" method="post">
            <h3>Filtr</h3>
            <label for="value">Soutěž</label>
            <select name="competition_id" id="competition_id">
                <option value="">Vyberte soutěž</option>
                <?php foreach (get_posts(['post_type' => 'soutez']) as $competition) { ?>
                    <option value="<?php echo $competition->ID; ?>" <?php echo isset($_POST['competition_id']) && $_POST['competition_id'] == $competition->ID ? 'selected="selected"' : '';?>><?php echo $competition->post_title;?></option>
                <?php } ?>
            </select>
            <input class="button" type="submit" value="Filtrovat"/>

        </form>

        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="movies-filter" method="get">

            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTable->display() ?>
        </form>

    </div>
    <?php
}