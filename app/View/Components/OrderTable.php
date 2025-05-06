<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Order;

class OrderTable extends Component
{
    public $orders;

    public function __construct()
    {
        // Ambil data pesanan dari database
        $this->orders = Order::all();
    }

    public function render()
    {
        return view('components.order-table');
    }
}
