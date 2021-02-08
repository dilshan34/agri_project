<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" >

</head>
<body id="admin">

<header>
     <x-navbar/> 
</header>

@if($success)
    <div class="alert alert-dismissible" role="alert" style="background-color:#516b48;color:white">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Congratulations!</strong> Employee inserted successfully.
</div>
@endif

<div class="container-fluid" style="min-height:550px">

<div class="row">

<div class="col-md-5" style="padding-top:100px"> 

<form action="/employees" method="post">
                                @csrf 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"> <label>Name*</label><input name="name" type="text" class="form-control" placeholder="Enter Employee Name"> 
                                            <span  class="font-weight-bold text-danger" style="font-family:revert; font-size:77%">@error('name'){{$message}}@enderror</span>
                                        </div></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gender*</label> <select name="gender" class="form-control">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                                <span class="font-weight-bold text-danger" style="font-family:revert; font-size:77%">@error('gender'){{$message}}@enderror</span>
                                            </div>
                                     </div>  
                                    </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div  class="form-group"> <label>Contact No.</label> <input name="number" type="number" class="form-control" placeholder="Enter Contact Number"> </div>
                                            </div>
                                        <div class="col-md-6">
                                            <div  class="form-group"> <label>NIC</label> <input name="nic" class="form-control" placeholder="Enter NIC Number"> </div>
                                        </div> 
                                    </div>

                             
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"> <label >Address</label> <textarea name="address" class="form-control" placeholder="Enter Employee Address" rows="3"></textarea> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> <label>Special Notes</label> <textarea name="notes" class="form-control" placeholder="Special Notes About Employee" rows="3"></textarea> </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-12"> <input type="submit" class="btn pt-2 btn-block " value="ADD EMPLOYEE"> </div>
                                        </div>
                            </form>


</div>

<div class="col-md-7">


<div class="btn-group" role="group" >
  <a href="employees"><button type="button" class="route" >All</button></a>
  <a href="male"><button type="button" class="route" >Male</button></a>
  <a href="female"><button type="button" class="route" >Female</button></a>
</div>

<div class="row" style="background-color:#26391f; margin: 2px;border-radius: 5px;color:white" >
<div class="col-4 text-capitalize">
<label>NAME</label>
</div>

<div class="col-4 text-capitalize">
<label>GENDER</label>
</div>
</div>

@foreach($employees as $emp)


<div class="row emp">

<div class="col-4 text-capitalize">
<span>{{$emp['name']}}</span>
</div>

<div class="col-4 text-capitalize">
<span>{{$emp['gender']}}</span>
</div>

<div class="col-2" id="show_{{$emp['id']}}">
 <a onclick="showcontent('{{$emp->id}}', true);">  <label>show</label>
 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
  <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
</svg></a>
</div>

<div class="col-1">
<a href={{"/edit/".$emp['id']}}><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#407082" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>
</div>

<div class="col-1">
<a onclick="return confirm('Are you sure you want to delete employee {{$emp->name}}?' )" href={{"delete/".$emp['id']}}> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#7d2828" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
</div>

<div class="col-6" style="display:none" id="content_{{$emp['id']}}">
<div>NIC: {{$emp['nic']}}</div>
<div>Contact No: {{$emp['number']}}</div>
<div>Address: {{$emp['address']}}</div>
<div>Special Notes: {{$emp['notes']}}</div>
</div>
<div class="col-6 " style="color:#478e19;display:none" id="content2_{{$emp['id']}}">
<div>Created Date: {{$emp['created_at']}}</div>
<div>Last Update: {{$emp['updated_at']}}</div>
<a onclick="hidecontent('{{$emp->id}}',true);" > <div >
   <label style="color:black">hide</label>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
  <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg>
</div></a>
</div>


</div>
@endforeach
</div>
  
</div> <!--row -->
</div>
<script>
function showcontent(id, isclicked){
    var show = 'show_' + id;
    var content = 'content_' +id;
    var content2 = 'content2_'+id;
    if(isclicked){
        $('#'+content).show();
        $('#'+content2).show();
        $('#'+show).hide();
    }
}
function hidecontent(id, isclicked){
    var show = 'show_' + id;
    var content = 'content_' +id;
    var content2 = 'content2_'+id;
    if(isclicked){
        $('#'+content).hide();
        $('#'+content2).hide();
        $('#'+show).show();
    }
}

</script>
<x-footer />

</body>

<html>