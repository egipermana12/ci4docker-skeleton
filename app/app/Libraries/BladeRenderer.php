<?php

namespace App\Libraries;

use Philo\Blade\Blade;

class BladeRenderer
{
    protected $blade;

    public function __construct()
    {
        // Path ke folder views
        $views = APPPATH . 'Views';
        // Path ke folder cache Blade (buat folder ini)
        $cache = WRITEPATH . 'cache/blade';

        // Inisialisasi Blade
        $this->blade = new Blade($views, $cache);
    }

    public function render($view, $data = [])
    {
        return $this->blade->view()->make($view, $data)->render();
    }
}
