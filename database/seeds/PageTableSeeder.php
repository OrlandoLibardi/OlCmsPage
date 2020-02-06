<?php

use Illuminate\Database\Seeder;
use OrlandoLibardi\PageBuildCms\app\Page;
use OrlandoLibardi\OlCms\AdminCms\app\Admin;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Page::create([
            'name' => 'Home', 
            'alias' => 'home', 
            'content' => 'home', 
            'status' => 1, 
            'meta_title' => 'Página de demonstração', 
            'meta_description' => 'Página de demonstração', 
            'meta_image' => ''
        ]);

        Admin::create([
            'name' => 'Páginas',
            'route' => 'pages.index',
            'icon' => 'fa fa-file-text-o',
            'parent_id' => 0,
            'minimun_can' => 'list',
            'order_at' => 2
        ]);

    }
}
