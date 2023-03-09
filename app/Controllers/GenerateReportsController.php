<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GenerateReportsController extends BaseController
{

    public function __construct()
    {
        helper(['form']);
    }
    public function index()
    {
        return view('admin/reports/generate-reports');
    }

    /**
     * Show daily transaction page
     */
    public function dailyReports()
    {
        $db = db_connect();

        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('room_name, unique_id,payment_deposit, name, checkin, checkout, total_bill');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('transaction_date = curdate()');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['daily_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS daily_revenue');
        $builder->where('transaction_date = curdate()');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['daily_revenue'] = $builder->get()->getRow();

    
        return view('admin/reports/daily-reports', $data);
    }

    /**
     * Show weekly transaction page
     */
    public function weeklyReports()
    {
        $db = db_connect();

        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('room_name, unique_id,payment_deposit, name, checkin, checkout, total_bill');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('week(transaction_date) = week(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['weekly_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS weekly_revenue');
        $builder->where('week(transaction_date) = week(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['weekly_revenue'] = $builder->get()->getRow();

    
        return view('admin/reports/weekly-reports', $data);
    }

    /**
     * Show monthly transaction page
     */
    public function monthlyReports()
    {
        $db = db_connect();

        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('room_name, unique_id,payment_deposit, name, checkin, checkout, total_bill');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('month(transaction_date) = month(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['monthly_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS monthly_revenue');
        $builder->where('month(transaction_date) = month(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['monthly_revenue'] = $builder->get()->getRow();

    
        return view('admin/reports/monthly-reports', $data);
    }

    /**
     * Show yearly transaction page
     */
    public function yearlyReports()
    {
        $db = db_connect();

        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('room_name, unique_id,payment_deposit, name, checkin, checkout, total_bill');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->where('year(transaction_date) = year(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['yearly_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS yearly_revenue');
        $builder->where('year(transaction_date) = year(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['yearly_revenue'] = $builder->get()->getRow();

    
        return view('admin/reports/yearly-reports', $data);
    }

    /**
     * Show custom reports page
     */
    public function customReports()
    {
        return view('admin/reports/custom-reports');
    }

    /**
     * Return the result of custom date fulter
     */
    public function showCustomReports()
    {

        $start = filter_var($_GET['start'], FILTER_SANITIZE_NUMBER_INT);
        $end = filter_var($_GET['end'], FILTER_SANITIZE_NUMBER_INT);

        $db = db_connect();

        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('room_name, unique_id,payment_deposit, name, checkin, checkout, total_bill');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $where = "transaction_date BETWEEN '".$start."' AND '".$end."' ";
        $builder->where($where);
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['custom_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS custom_revenue');
        $where = "transaction_date BETWEEN '".$start."' AND '".$end."' ";
        $builder->where($where);
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['custom_revenue'] = $builder->get()->getRow();

        return view('admin/reports/custom-reports', $data);
    }

    public function completedRoom()
    {

        $db = db_connect();

        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('unique_id,room_name,room_number,name,checkin,checkout,total_bill');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->join('tbl_room_number', 'tbl_room_number.room_number_id = tbl_room_reservation_transactions.assigned_room_number', 'inner');
        $builder->where('transaction_status', 'completed');
        $builder->orderBy('transaction_date', 'asc');
        $data['completed'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS total_revenue');
        $builder->where('transaction_status', 'completed');
        $data['total_revenue'] = $builder->get()->getRow();

        return view('admin/reports/completed-room-reservation', $data);
    }

    public function cancelledRoom()
    {

        $db = db_connect();

        $builder = $db->table('tbl_room_reservation_transactions');
        $builder->select('unique_id,room_name,room_number,name,checkin,checkout,payment_deposit,total_bill');
        $builder->join('tbl_rooms', 'tbl_rooms.id = tbl_room_reservation_transactions.room_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_room_reservation_transactions.customer_id', 'inner');
        $builder->join('tbl_room_number', 'tbl_room_number.room_number_id = tbl_room_reservation_transactions.assigned_room_number', 'inner');
        $builder->where('transaction_status', 'cancelled');
        $builder->orderBy('transaction_date', 'asc');
        $data['cancelled'] = $builder->get()->getResult();

        $builder->select('sum(payment_deposit) AS total_revenue');
        $builder->where('transaction_status', 'cancelled');
        $data['total_revenue'] = $builder->get()->getRow();

        return view('admin/reports/cancelled-room-reservation', $data);
    }

    public function eventsCustomReports()
    {
        return view('admin/reports/events/custom');
    }

    public function showEventsCustomReports()
    {
        $start = filter_var($_GET['start'], FILTER_SANITIZE_NUMBER_INT);
        $end = filter_var($_GET['end'], FILTER_SANITIZE_NUMBER_INT);

        $db = db_connect();

        $builder = $db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $where = "transaction_date BETWEEN '".$start."' AND '".$end."' ";
        $builder->where($where);
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['custom_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS custom_revenue');
        $where = "transaction_date BETWEEN '".$start."' AND '".$end."' ";
        $builder->where($where);
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['custom_revenue'] = $builder->get()->getRow();

        return view('admin/reports/events/custom',$data);
    }

    public function eventsDaily()
    {

        $db = db_connect();

        $builder = $db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->where('transaction_date = curdate()');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['daily_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS daily_revenue');
        $builder->where('transaction_date = curdate()');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['daily_revenue'] = $builder->get()->getRow();

        return view('admin/reports/events/daily', $data);
    }

    public function eventsWeekly()
    {

        $db = db_connect();

        $builder = $db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->where('week(transaction_date) = week(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['weekly_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS weekly_revenue');
        $builder->where('week(transaction_date) = week(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['weekly_revenue'] = $builder->get()->getRow();

        return view('admin/reports/events/weekly',$data);
    }

    public function eventsMonthly()
    {

        $db = db_connect();

        $builder = $db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->where('month(transaction_date) = month(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['monthly_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS monthly_revenue');
        $builder->where('month(transaction_date) = month(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['monthly_revenue'] = $builder->get()->getRow();
        return view('admin/reports/events/monthly',$data);
    }

    public function eventsYearly()
    {

        $db = db_connect();

        $builder = $db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->join('tbl_events_places', 'tbl_events_places.id = tbl_events_transaction.event_place_id', 'inner');
        $builder->join('tbl_customers', 'tbl_customers.id = tbl_events_transaction.customer_id', 'inner');
        $builder->where('year(transaction_date) = year(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['yearly_reports'] = $builder->get()->getResult();

        $builder->select('sum(total_bill) AS yearly_revenue');
        $builder->where('year(transaction_date) = year(now())');
        $builder->where('transaction_status !=', 'cancelled');
        $builder->where('transaction_status !=', 'pending');
        $data['yearly_revenue'] = $builder->get()->getRow();
        return view('admin/reports/events/yearly',$data);
    }
}
