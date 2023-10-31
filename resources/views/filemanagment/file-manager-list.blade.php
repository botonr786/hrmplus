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
            <a href="#">FileManagment Report</a>
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
               </div>
            </div>
         </div>
       
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fa fa-cog" aria-hidden="true" style="color:#10277f;"></i>&nbsp;FileManagment Report</h4>
                        <div class="d-flex justify-content-between float-right mb-3">
                           <div>
                              <a href="{{url('fileManagment/fileManagment-add')}}"><button class="btn btn-info">Add</button></a>
                           </div>
                       </div>
                    </div>
                   
                    <div class="card-body">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead style="text-align:center;vertical-align:middle;">
                                    <tr>
                                        <th style="width:6%;">Sl.No.</th>
                                        <th style="width:6%;">File Name</th>
                                        <th style="width:6%;">Emp Code</th>
                                        <th style="width:6%;">Organization Id</th>
                                        <th style="width:6%;">Status</th>
                                        <th style="width:6%;">Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach($file_details as $item)
                                  
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>{{$item->file_name}}</td>
                                    <td>{{$item->emp_id}}</td>
                                    <td>{{$item->organization_id}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                       <?php if($item->status==="pending") {?>
                                          <a href='{{url("fileManagment/edit-fileManager/$item->id")}}'><i class="fas fa-edit"></i></a>
                                          <?php }else{ ?>
                                             <button class="btn btn-info">
                                                <a href='{{url("fileManagment/file-add/$item->id")}}'><i class="fas fa-plus"  style="color: #fff"></i></a>
                                                </button>
                                           <?php } ?>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
      </div>
   </div>

   @endsection
    @section('js')

    @endsection
   