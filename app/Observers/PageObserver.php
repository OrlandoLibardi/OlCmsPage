<?php

namespace OrlandoLibardi\PageBuildCms\app\Http\Obervers;

use OrlandoLibardi\PageBuildCms\app\Page;
use OrlandoLibardi\PageBuildCms\app\ServicePage as ServicePage;

class PageObserver
{
    
    public function creating($page)
    {
        $page->alias = ServicePage::checkAlias(str_slug($page->name, '-'), 0);        
        $page->meta_image = " ";
        ServicePage::createRoutePage($page->alias);
    }

    public function updating( $page )
    {
        $page->meta_image = " ";
    }

    public function deleting( $page )
    {
        ServicePage::deleteTemplate($page->alias);
        ServicePage::deleteRoute($page->alias);
    }
}

