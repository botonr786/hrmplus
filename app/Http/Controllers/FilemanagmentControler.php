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
use App\Models\fileManager;
use App\Models\Employee;
use App\Models\UserModel;
use App\Models\fileDivision;
use App\Models\filesUpload;
use Carbon\Carbon;
use File;
class FilemanagmentControler extends Controller
{
 public function fileManagmentList(){
  $data['file_details']=fileManager::get();
    return View("filemanagment/file-manager-list",$data);
 }  
 public function getalldatafilemanagment($organizationId){
  $data=fileManager::where('organization_id',$organizationId)->get();
  echo json_encode($data);
 }
 public function fileManagmentView(){
   $email = Session::get('emp_email');
   $data["emp_record"]=UserModel::where("email",$email)->first();
   $empid= $data["emp_record"]->employee_id;
   $data["emp_details"]=Employee::where("emid",$empid)->first();
   $data["emp_detail"]=Employee::where("emid",$empid)->get();
   $data['file_division']=fileDivision::get();
   return View("filemanagment/add-fileManagment",$data);
 }
 public function savefilemanagment(Request $request){
   // dd($request->all());
   $email = Session::get('emp_email');
   // $date=carbon::now()->toDateString();
   // dd($date);
   if(!empty($email)){
      $arryValue=array(
         "division"=>$request->division,
         "file_name"=>$request->file_name,
         "emp_id"=>$request->emp_id,
         "organization_id"=>$request->organization_id,
         "status"=>$request->status,
         "remarks"=>$request->remarks,
      );
      fileManager::insert($arryValue);
      $folderName = $request->file_name; // Replace with your desired folder name
      $path = public_path().'FileManagment/' . $folderName;
      // $path = public_path('FileManagment',$folderName);

      if (!is_dir($path)) {
         File::makeDirectory($path, $mode = 0777, true, true);
         // mkdir($path, 0777, true);
      }

      return redirect("fileManagment/fileManagmentList");
      Session::flash('message', 'File Manager Successfully Save.');
   }else{
      return redirect("");
   }
 }
 public function fileManagmentViewedit($id){
   $data['file_details']=fileManager::where("id",$id)->first();
   return View("filemanagment/edit-fileManagment",$data);
 }
 public function savefilemanagmentupdate(Request $request){
   $date=carbon::now()->toDateString();
   $arryValue=array(
      "file_name"=>$request->file_name,
      "emp_id"=>$request->emp_id,
      "organization_id"=>$request->organization_id,
      "status"=>$request->status,
      "remarks"=>$request->remarks,
      "update_at"=>$date,
     
   );
   DB::table('file_managers')->where('id',$request->id)->update($arryValue);
   return redirect("fileManagment/fileManagmentList");
   Session::flash('message', 'File Manager Successfully Update.');
 }

 public function filedivisionlist(){
   $data['file_details']= fileDivision::get();
   return view("fileManagment/file-devision-list",$data);
 }
 public function filedivisionView(){
   $email = Session::get('emp_email');
   $data["emp_record"]=UserModel::where("email",$email)->first();
   $empid= $data["emp_record"]->employee_id;
   $data["emp_details"]=Employee::where("emid",$empid)->first();
   $data["file_details"]=fileManager::get();
  
   return view("fileManagment/file-devision-Add",$data);
 }
 public function filedivisionadd(Request $request){
   $date=carbon::now()->toDateString();
   $email = Session::get('emp_email');
   if(!empty($email)){
      $arryValue=array(
         "name"=>$request->name,
         "organization_id"=>$request->organization_id,
         "emp_id"=>$request->emp_id,
         "sort_name"=>$request->sort_name,
         "status"=>$request->status,
         "created_at"=>$date,
         "updated_at"=>$date,
         "deleted_at"=>$date,
      );
      fileDivision::insert($arryValue);
      return redirect("fileManagment/file-devision-list");
      Session::flash('message', 'File Division Successfully Insert.');
      
   }else{
      return redirect("");
   }
 }
 public function filedivisionViewedit($id){
  $data['file_details']= fileDivision::where("id",$id)->first();
  return view("fileManagment/file-devision-edit",$data);
 }
 public function filedivisionViewupdate(Request $request){
   $email = Session::get('emp_email');
   $date=carbon::now()->toDateString();
   if(!empty($email)){
      $arryValue=array(
         "name"=>$request->name,
         "organization_id"=>$request->organization_id,
         "emp_id"=>$request->emp_id,
         "status"=>$request->status,
         "updated_at"=>$date,
      );
      DB::table('file_devisions')->where('id',$request->id)->update($arryValue);
      return redirect("fileManagment/file-devision-list");
      Session::flash('message', 'File Division Successfully Update.');
   }else{
      Session::flash('message', 'File Division Tecnical Issue');
   }
 }
 public function fileAdd(Request $request, $id){
  $data['data']= fileManager::find($id);
//   dd($data['data']);
 return view('fileManagment/file-view',$data);
 }
 public function saveFileUpload(Request $request){
   $date=carbon::now()->toDateString();
  if ($request->hasFile("uploadFile")) {
   $documents = $request->file("uploadFile");
   $empId=$request->input('empId');
   $fileName=$request->input('fileName');
   $orgId=$request->input('orgId');
   foreach ($documents as $key => $document) {
       $documentName =
           time() . "_" . $document->getClientOriginalName();
            $document->move(("FileManagment".'/'.$fileName), $documentName);
            DB::table('files_upload')->insert([
               'empId'=>$empId,
               'fileName'=>$fileName,
               'orgId'=>$orgId,
               'uploadFile'=>$documentName
            ]);
   } 
   Session::flash('message', 'Files Upload success');
   return redirect('fileManagment/fileManagmentList');
}else{
   return redirect()->back()->with('error','Something goes wrong while uploading file!');
   // Session::flash('message', 'Files Upload Issue');
   // return redirect('fileManagment/fileManagmentList');
}
 }
}
