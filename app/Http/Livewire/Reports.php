<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;

class Reports extends Component
{
    public $from_date;
    public $to_date;
    public $sell_bills;
    public $buy_bills;

    public function get_sell_bills()
    {
        if ($this->from_date && $this->to_date)
        {
            $dateS = new Carbon($this->from_date);
            $dateE = new Carbon($this->to_date);
            $this->sell_bills = \App\Models\SellBill::whereBetween('created_at',
                [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])
                ->get();
        }
    }

    public function get_buy_bills()
    {
        if ($this->from_date && $this->to_date)
        {
            $dateS = new Carbon($this->from_date);
            $dateE = new Carbon($this->to_date);
            $this->buy_bills = \App\Models\BuyBill::whereBetween('created_at',
                [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])
                ->get();
        }
    }


    public function render()
    {
        return view('livewire.reports');
    }
}
