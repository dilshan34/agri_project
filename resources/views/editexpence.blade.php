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
       <x-navbar />
    </header>

    <div class="container-fluid" style="min-height:550px">


    <div class="row" style="min-height: 550px;">

<div class="col-md-3 col-lg-2" style="background-color: #26391f;">
<div class="col-sm-10 pt-5" style="font-weight: bold;">
<div class="row pt-3" ><a href="/crops" class="text-decoration-none text-light"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
  <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
</svg><span class="pl-2"> Daily Harvest<span></a></div>
<div class="row pt-3"><a href="/income" class="text-decoration-none text-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
</svg><span class="pl-2">   Daily Income<span></a></div>
<div class="row pt-3"style="background-color:#79797985 ;"><a href="expence" class="text-decoration-none text-light"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 11.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-1 0v2.6l-3.613-4.417a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61L13.445 11H10.5a.5.5 0 0 0-.5.5z"/>
</svg><span class="pl-2"> Daily Expences<span></a></div>
</div>
</div>
<div class="col-md-9 col-lg-10">
<div class="text-muted pt-2">Add Daily Expences</div>
<div class="row pt-3">
<div class="col-sm-5">
<form action="/updateexpence" method="post" class="mb-5">
 @csrf 
 <input type="hidden" name="id" value="{{$expence['id']}}"  >
 <div class="form-group">
    <label>Category*</label> <span class="font-weight-bold text-danger" style="font-family:revert; font-size:77%">@error('category'){{$message}}@enderror</span>
    <select name="category" value="{{$expence['category']}}" class="form-control">
          <option value="" disabled>Select Product Category</option>
          @foreach($crops as $crop)
          <option {{$crop['name'] == $expence['category']?'selected':''}}>{{$crop['name']}}</option>
          @endforeach
          <option {{"other" == $expence['category']?'selected':''}}>other</option>
         </select>
    
    </div>

    <div class="form-group"> <label>Description*</label><span  class="font-weight-bold text-danger" style="font-family:revert; font-size:77%">@error('description'){{$message}}@enderror</span>
    <input name="description" value="{{$expence['description']}}" type="text" class="form-control" placeholder="Source of expence"> 
    
    </div>

    <div class="form-group"> <label>Amount*</label><span  class="font-weight-bold text-danger" style="font-family:revert; font-size:77%">@error('amount'){{$message}}@enderror</span>
    <input name="amount" value="{{$expence['amount']}}" type="text" class="form-control" placeholder="Outflowed amount(Rs)"> 
    
    </div>
    <input type="submit" class="btn pt-2 btn-block " value="INSERT RECORD">

</form>
</div>


<div class="col-md-7">
@foreach($crops as $crop)
<div class="text-muted text-capitalize pb-3">{{$crop['name']}}</div>
@foreach($expences as $expence)
@if($expence->category==$crop->name)

<div class="row p-2 mb-2" style="background-color:#7979792b;">
<div class="col-6">{{$expence['description']}}</div>
<div class="col-4">Rs. {{$expence['amount']}}</div>
<div class="col-2">
<a href={{"editexpence/".$expence['id']}}><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#407082" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>

<a onclick="return confirm('Are you sure you want to delete record {{$expence->description}}?' )" href={{"deleteexpence/".$expence['id']}}> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#7d2828" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
</div>
</div>
@endif
@endforeach
@endforeach
<div class="text-muted text-capitalize pb-3">other</div>
@foreach($expences as $expence)

@if($expence->category=='other')

<div class="row p-2 mb-2" style="background-color:#7979792b;">
<div class="col-6">{{$expence['description']}}</div>
<div class="col-4">Rs. {{$expence['amount']}}</div>
<div class="col-2">
<a href={{"editexpence/".$expence['id']}}><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#407082" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>

<a onclick="return confirm('Are you sure you want to delete record {{$expence->description}}?' )" href={{"deleteexpence/".$expence['id']}}> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#7d2828" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></a>
</div>
</div>
@endif
@endforeach

</div>



</div>



</div>

    </div>


   </div>
<x-footer />
</body>

<html>


