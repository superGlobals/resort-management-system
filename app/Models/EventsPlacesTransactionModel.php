<?php

namespace App\Models;

use CodeIgniter\Model;

class EventsPlacesTransactionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_events_transaction';
    protected $primaryKey       = 'transaction_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['unique_id', 'customer_id', 'event_place_id',
     'date_book', 'time_arrival', 'payment_status', 'total_bill', 'payment_deposit', 
     'total_person', 'gcash_reference_number', 'transaction_status', 'cancellation_message', 'transaction_date'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
