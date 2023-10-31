@extends('filemanagment.include.include')
@section('content')
<div class="main-panel">
   {{-- <div class="mt-3" style="margin-top: 20px;">
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
            <a href="#">FileManagment View</a>
         </li>
      </ul>
   </div> --}}
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
                        <h4 class="card-title"><i class="fa fa-cog" aria-hidden="true" style="color:#10277f;"></i>&nbsp;Files</h4>
                        <div class="d-flex justify-content-between float-right mb-3">
                           <div>
                            <button type="button" class="btn btn-primary mx-1" title="Import Files" style="color: #fff;background-color: #0884af;border-color: #0884af;padding: 0px 8px;height: 32px;" data-toggle="modal" data-target="#exampleModal1">
                                Add File
                              </button>
                           </div>
                       </div>
                    </div>
                   
                    <div class="card-body">
                           
                        </div>
                    </div>
                </div>
                </div>
            </div>
        
      </div>
   </div>


   <!-- Modal -->
   <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form style='padding: 0px;' action="{{url('fileManagment/saveUpload')}}" method="post" enctype="multipart/form-data">
          @csrf
          
          <div class="modal-content">
            <div class="modal-body">
                <div id="validationMessage" style="border: 1px solid red; color:red"></div>
                <input type="hidden" name="empId" value="{{$data->emp_id}}">
                <input type="hidden" name="fileName" value="{{$data->file_name}}">
                <input type="hidden" name="orgId" value="{{$data->organization_id}}">
                <div class="form-group">
                  <label for="excel_file">Upload Files</label>
                  <input type="file" name="uploadFile[]" class="form-control" style='height: 40px;' id="fileInput" multiple required>
                </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" style="padding: 0px 8px;height: 32px;" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="validateButton" style="color: #fff;background-color: #0884af;border-color: #0884af;padding: 0px 8px;height: 32px;" onclick="hello()">Import</button>
            </div>
            {{-- <div id="validationMessage"></div> --}}
          </div>
      </form>
    </div>
  </div>
  <!-- END -->
  <script>
    function hello(){
        
            var fileInput = document.getElementById('fileInput');
            var validationMessage = document.getElementById('validationMessage');

            if (fileInput.files.length === 0) {
                validationMessage.innerHTML = 'No file selected.';
                return;
            }

            var file = fileInput.files[0];
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            var maxSizeInBytes = 5 * 1024 * 1024; // 5 MB

            var fileExtension = file.name.split('.').pop();

            if (allowedExtensions.indexOf(fileExtension.toLowerCase()) === -1) {
                validationMessage.innerHTML = 'Invalid file type. Allowed file types: ' + allowedExtensions.join(', ');
            } else if (file.size > maxSizeInBytes) {
                validationMessage.innerHTML = 'File is too large. Maximum size is 5 MB.';
            } else {
                validationMessage.innerHTML = 'File is valid.';
            }
    }
    $(document).ready(function () {
        $('#validateButton').on('click', function () {
            var fileInput = document.getElementById('fileInput');
            var validationMessage = document.getElementById('validationMessage');

            if (fileInput.files.length === 0) {
                validationMessage.innerHTML = 'No file selected.';
                return;
            }

            var file = fileInput.files[0];
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif','pdf','doc','txt'];
            var maxSizeInBytes = 5 * 1024 * 1024; // 5 MB

            var fileExtension = file.name.split('.').pop();

            if (allowedExtensions.indexOf(fileExtension.toLowerCase()) === -1) {
                validationMessage.innerHTML = 'Invalid file type. Allowed file types: ' + allowedExtensions.join(', ');
            } else if (file.size > maxSizeInBytes) {
                validationMessage.innerHTML = 'File is too large. Maximum size is 5 MB.';
            } else {
                validationMessage.innerHTML = 'File is valid.';
            }
        });
    });
</script>


   @endsection
    @section('js')

    @endsection
   