<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use view;
use Validator;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Exception;
use App\Models\Registration;
use App\Models\HolidayType;
use App\Models\Holiday;
class FilemanagmentControler extends Controller
{
 public function fileManagmentList(){

    return View("filemanagment/file-manager-list", $data);
 }  
}
