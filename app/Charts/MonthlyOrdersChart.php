<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyOrdersChart 
{
    protected $chart;

    public function __construct()
    {
        $this->chart = new LarapexChart();
    } 
   
    public function build($chartTitle, $orders, $months)
    {
        return $this->chart->lineChart()
            ->setTitle($chartTitle)
            ->setSubtitle('Monthly orders.')
            ->addData('Orders',$orders)
            ->setXAxis($months);
    }
}