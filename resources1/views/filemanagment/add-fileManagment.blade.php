@extends('filemanagment.include.include')
@section('content')
<div class="main-panel">
   <div class="page-header">
      <!-- <h4 class="page-title">Attendance Management</h4> -->
      <ul class="breadcrumbs">
         <li class="nav-home">
            <a href="#">
            Home
            </a>
         </li>
         <li class="separator">
            /
         </li>
         <li class="nav-item active">
            <a href="#">Add File Managment</a>
         </li>
      </ul>
   </div>
   <div class="content">
      <div class="page-inner">
         <div class="row">
            <div class="col-md-12">
               <div class="card custom-card">
                  @if(Session::has('message'))										
                  <div class="alert alert-success" style="text-align:center;"><span class="glyphicon glyphicon-ok" ></span><em > {{ Session::get('message') }}</em></div>
                  @endif
                  <div class="card-body">
                    <form  method="post" action="{{url('fileManagment/fileManagment-save')}}" enctype="multipart/form-data" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Division</label>
                                  <select class="form-control" id="divi" name="division">
                                    <option>Select</option>
                                    @foreach($file_division as $item)
                                    <option value="{{$item->name}}"> {{$item->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Employee Name</label>
                                   
                                     <select class="form-control" name="division" id="emp" onchange="filenamechange()">
                                       <option>Select</option>
                                       @foreach($emp_detail as $item)
                                       <option value="{{$item->emp_fname}}"> {{$item->emp_fname}}</option>
                                       @endforeach
                                     </select>
                                 </div>
                                 </div>
                              
                            <div class="col-md-4">
                            <div class="form-group">
                               <label>File Name</label>
                               <input type="text" class="form-control" name="file_name" id="file" readonly>
                            </div>
                            </div>
                          
                                <input type="hidden" class="form-control" name="emp_id" value="<?php print_r($emp_details->emid) ?>" readonly>
                            
                         
                                <input type="hidden" class="form-control" name="organization_id" id="orgId" value="<?php print_r($emp_details->emp_code) ?>" readonly>
                            
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                <option>Status</option>
                                <option value="active">Active</option>
                                <option value="inActive">InActive</option>
                            </select>
                            </div>
                         </div>
                         
                         
                        </div>
                        <div class="row form-group">
                            
                           <div class="col-md-3">
                              <a href="#">	
                              <button class="btn btn-default" type="submit" style="background-color: #1572E8!important; color: #fff!important;">Go</button></a>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   @endsection
   @section('js')
{{-- @include('payroll.partials.scripts') --}}
<script>
	function filenamechange(){
      $divistion=$("#divi").val();
      $emp=$("#emp").val();
     
      $first=$divistion.charAt(0);
      $seco=$divistion.charAt(1);
      $seco1=$divistion.charAt(2);
      $finaltwochar=$first+""+$seco+""+$seco1;

      $empfirst=$emp.charAt(0);
      $empseco=$emp.charAt(1);
      $finalemp=$empfirst+""+$empseco

      $currentMonth = (new Date).getMonth() + 1;
      $currentYear = (new Date).getFullYear();
      
      $monthyear=$currentMonth+"-"+$currentYear;

      $lastdigit="01";
      $changedigit="02";
     
       var allvaluconvcat1=$finaltwochar+"-"+$monthyear+"-"+$finalemp+"-"+$lastdigit;
       $orgId=$("#orgId").val();
       //  console.log("$orgId",$orgId)
       $.ajax({
             url:"{{url('fileManagment/get-id')}}"+'/'+$orgId,
            dataType: 'json',
            success: function(response) {
            $countValue=response.length+1;
            console.log($countValue);
            $allvaluconvcat=$finaltwochar+"-"+$monthyear+"-"+$finalemp+"-"+$countValue;
            $("#file").val($allvaluconvcat);

            // response.forEach(function(item){
            //    console.log(item.id)
            //    if(item.file_name==allvaluconvcat1){
            //       $allvaluconvcat=$finaltwochar+"-"+$monthyear+"-"+$finalemp+"-"+$lastdigit;
            //      $("#file").val($allvaluconvcat);
            //    }else{
            //       $allvaluconvcat=$finaltwochar+"-"+$monthyear+"-"+$finalemp+"-"+$changedigit;
            //      $("#file").val($allvaluconvcat);
            //    }
            // })
         }
         }); 
      // $("#file").val($allvaluconvcat);

   }
</script>
@endsection
   