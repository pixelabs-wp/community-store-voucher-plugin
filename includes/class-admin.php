<?php

class CSVP_Admin
{

    //Method to render transaction history
    public function render_community_management()
    {
        CSVP_View_Manager::load_view('community-management');
    }

    public function render_store_management()
    {
        CSVP_View_Manager::load_view('store-management');
    }

    public function render_store_commisions()
    {
        CSVP_View_Manager::load_view('store-commision');
    }

    public function render_community_commisions()
    {
        CSVP_View_Manager::load_view('community-commision');
    }

    public function render_messages()
    {
        CSVP_View_Manager::load_view('messages');
    }
  
}
