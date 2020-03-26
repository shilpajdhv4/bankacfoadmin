<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class MonthlyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date('Y-m-d');
        $nameOfDay = ltrim(date('d', strtotime($date)),"0");
        $month = date('m',strtotime($date));
        $year = date('Y',strtotime($date));
        $result = DB::table('tbl_services_subscribed as tbl1')
                ->select('tbl1.user_id','tbl1.subscription_id','tbl1.service_date','tbl2.field_title','tbl2.is_office_only','tbl2.id','tbl2.recurring_reminder_day')
                ->leftjoin('tbl_subscription_fields as tbl2','tbl2.subscription_id','tbl1.subscription_id')
                ->where(['tbl1.is_active'=>0,'tbl2.is_recurring'=>1,'tbl2.recurring_frequency'=>'Monthly','tbl2.recurring_reminder_day'=>$nameOfDay])
                ->get();
         //   echo "<pre>";print_r($result);exit;
        foreach($result as $row){
            $month_exist = date('m',strtotime($row->service_date));
            $year_exist = date('Y',strtotime($row->service_date));
            if($month != $month_exist && $year != $year_exist){
                $sub_client_field['subscription_id'] = $row->subscription_id;
                $sub_client_field['field_id'] = $row->id;
                $sub_client_field['rec_month'] = $month;
                $sub_client_field['rec_year'] = $year;
                $arr = array($row->field_title => '');
                $sub_client_field['field_input'] = json_encode($arr);
                $sub_client_field['is_complete'] = 'No';
                $sub_client_field['client_id'] = $row->user_id;
                $sub_client_field['is_office_only'] = $row->is_office_only;
                \App\SubscriptionsubclientField::create($sub_client_field);
            }
        }
    }
}
