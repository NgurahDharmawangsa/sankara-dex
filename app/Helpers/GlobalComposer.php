<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\View\View;

class GlobalComposer
{
    protected $router;
    protected $request;

    public function __construct(
        Router $router,
        Request $request
    )
    {
        $this->router = $router;
        $this->request = $request;
    }

    public function compose(View $view)
    {
        $data['breadcrumbs'] = Breadcrumb::get();

        $view->with($data);
    }
}
