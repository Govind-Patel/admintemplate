<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\EmployeeDataTable;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(EmployeeDataTable $dataTable)
    {
        return $dataTable->render('employee');

    }
}
