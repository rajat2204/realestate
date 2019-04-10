<?php

namespace App\Http\Controllers\Admin;

use App\Models\Make_Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Validations\Validate as Validations;

class ChequeController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
}
