<?php

    // Loads the view with the header and footer wrapper.
    function load_view($view_path, $local_variables, $controller) {
        $controller->load->view('layouts/header', $local_variables);
        $controller->load->view($view_path, $local_variables);
        $controller->load->view('layouts/footer', $local_variables);
    }

    // Adds the active class, if the page name matches the current one.
    // This function should only be used in side a view.
    function get_active($page_name, $_page) {
        return $_page == $page_name ? "active" : "";
    }
