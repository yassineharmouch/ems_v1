@extends('offre.base')
@section( 'action-content')



<section id="offres" class="services">
<div class="container">
      <div class="row">
          <div class="col-md-12">
		  <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ajouter-->
			@if(session()->has('success'))
			<div class="alert alert-success">
		   {{ session()->get('success') }}

			</div>
		   @endif


		 <a  class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Nouveau offre </a>
		 <br>
		 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="exampleModalLabel">Ajouter Offre</h5>
				</div>
				<form method="POST"  action="{{ url('offres')}}" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					<div class="form-group  @if($errors->get('titre')) has-error @endif">
					  <label for="recipient-name" class="col-form-label">Titre :</label>
					<input style="margin: 0px" type="text" name='titre' class="form-control" placeholder="Entrer un titre de votre offre" value="{{ old ('titre') }}">
					 
					@if($errors->get('titre'))
						@foreach($errors->get('titre') as $message)
						<li class="alert alert-danger">{{ $message }}</li>
						@endforeach
				    @endif 
					</div>
					<div class="form-group  @if($errors->get('description')) has-error @endif">
					  <label for="message-text" class="col-form-label">Description :</label>
					  <textarea style="margin: 0px" type="text" name='description' class="form-control" value="{{ old ('description') }}" placeholder="entrer les informations de votre offre" ></textarea>

					  @if($errors->get('description'))
                        @foreach($errors->get('description') as $message)
                        <li class="alert alert-danger">{{ $message }}</li>
                        @endforeach
                    @endif 
					</div>
					<div class="form-group  @if($errors->get('photo')) has-error @endif">
					<label for="">Image :</label>
					  <input type="file"  name='photo' class="form-control" value="{{ old ('photo') }}" placeholder="entrer l\'image" >

					  @if($errors->get('photo'))
                        @foreach($errors->get('photo') as $message)
                        <li class="alert alert-danger">{{ $message }}</li>
                        @endforeach
                    @endif
					</div>
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  <button type="submit" class="btn btn-primary">Enregistrer</button>
				</div>
			  </form>
			  </div>
			</div>
		 </div>
		
  

<br />

  <div class="row" >

 
          
          <div class="row" >
					@foreach($offres as $offre)
				<div class="col-sm-6 col-md-4" >
					<div class="thumbnail"  >
			
			<img src="{{ asset('storage/images/'.$offre->photo) }}" alt="Bootstrap" class="img-thumbnail">
			<div class="caption">
				<h3>{{ $offre->titre }}</h3>
				<p align="center">....</p>
			
				<a href="{{ url('offres/'.$offre->id) }}" class="btn btn-primary" role="button">Plus</a>
				
				<button class="btn btn-success " data-toggle="modal" data-target="#exampleModal{{$offre->id}}" data-whatever="@mdo">editer</button>
				<div class="modal fade" id="exampleModal{{$offre->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editer Offre</h5>
						</div>
						<form method="POST"  action="{{ route('offres.update',['offre'=>$offre])}}" enctype="multipart/form-data">
						<div class="modal-body">
							@csrf
							@method('put')
							<div class="form-group">
							<label for="recipient-name" class="col-form-label">Titre :</label>
							<input style="margin: 0px" type="text" name='titre' class="form-control" value="{{$offre->titre}}">
							@if($errors->get('titre'))
							@foreach($errors->get('titre') as $message)
							<li class="alert alert-danger">{{ $message }}</li>
							@endforeach
						     @endif 
							</div>
							<div class="form-group">
							<label for="message-text" class="col-form-label">Description :</label>
							<textarea style="margin: 0px" type="text" name='description' class="form-control" >{{$offre->description}}</textarea>
							@if($errors->get('description'))
							@foreach($errors->get('description') as $message)
							<li class="alert alert-danger">{{ $message }}</li>
							@endforeach
							@endif 
							</div>
							<div class="form-group">
							<label for="">changer <a href="/storage/image/{{$offre->photo}}">l'image</a> :</label>
							<input type="file"  name='photo' class="form-control"  >
							</div>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Enregistrer</button>
						</div>
					</form>
					</div>
					</div>
				</div>

				
				<button type="submit" class="btn btn-danger offreDelete" role="button">supprimer</button>

				<form style="display: none" action="{{ route('offres.destroy', $offre->id) }}" method="post">

					@csrf
					@method('DELETE')

				</form>
			
				@cannot('update', $offre)
					<a href="{{url('/welcome')}}" class="btn btn-default"  title="Bootstrap 3 themes generator">reserver</a>
				@endcannot
				
			
				</p>
			</div>
			</div>
      </div>
    
  @endforeach
</div>
       
        </div>
    </div>
</div>  


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<script>
		$('.offreDelete').on("click",function(){
   var that=$(this)
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    that.next().submit()
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})
  })
	</script>
@endsection
