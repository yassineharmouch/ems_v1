@extends('offre.base')
@section( 'action-content')
<div class="jumbotron text-center">
	<div align="right">
		<a href="{{ url('offres') }} " class="btn btn-default">Back</a>
	</div>
	<br />
   
  <div class="container">
    <div class="row">
       
    

      <h3>{{ $offre->titre }} </h3>
      <br>
      <div class="col-md-4">
         <img src="{{ asset('storage/images/'.$offre->photo) }}" alt="Bootstrap" class="img-thumbnail">
      </div>
       
       
       <div class="caption">
        
        
    
        </div>
      <div class="col-md-8">
     
        <i class="fas fa-suitcase-rolling    ">les informations néssicaire sur l'offre:</i>  <br>
          {{ $offre->description }}

       
      </div>
    </div>
  </div>
 

@endsection
