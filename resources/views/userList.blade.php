@extends('layouts.app')

@section('title', "Cardcenter - Users List")
@section('content')
<h2>Users List</h2>
<br>
<div class="flex-container-cart">
	<div>
		<table id="info-card">
			<th>Username</th>
			<th>Name</th>
			<th class="type">Type</th>
			<th>Balance</th>
			<th>Location</th>
			<th>Number</th>
			<th>Status</th>
			<th>Options</th>
			@foreach($users as $user)
				<tr>
					<td class="centertable">{{$user->username}}</td>
					<td class="centertable">{{$user->name}} {{$user->Surname}}</td>
					<td class="centertable type">
						<span>{{$user->type}}</span><button class="btn" onclick="showEdit({{$user->id}})"><i class="fas fa-edit"></i></button>
						<div style="display:none;" id="{{'editDiv'.$user->id}}">
							<form action="{{url('api/user/'.$user->id)}}" method="post">
								{{ method_field('PUT') }}
								<label for="{{'type'.$user->id}}">Change Type</label>
								<select id="{{'type'.$user->id}}" name="type">
									@if ($user->type == "Admin")
										<option value="Basic">Basic</option>
										<option selected value="Admin">Admin</option>
									@else
										<option selected value="Basic">Basic</option>
										<option value="Admin">Admin</option>
									@endif
								</select>
								<input type="submit" name="submit">
							</form>
						</div>
					</td>
					<td class="centertable">{{$user->balance}}</td>
					<td class="centertable">{{$user->city}}, {{$user->country}}</td>
					<td class="centertable">{{$user->phone_number}}</td>
					@if ($user->deleted_at == null)
						<td class="centertable">Active</td>
					@else
						<td class="centertable">Deleted</td>
					@endif
					<td class="centertable">
						@if ($user->deleted_at == null)
							<a href="{{url('user/delete/'.$user->id)}}"><i class="fas fa-trash-alt"></i></a>
						@else
							<a href="{{url('api/user/restore/'.$user->id)}}"><i class="fas fa-trash-restore"></i></a>
						@endif
					</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@stop