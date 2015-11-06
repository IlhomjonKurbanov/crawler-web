@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Mall lists</div>

				<div class="panel-body">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<td>#</td>
								<td>Mall name</td>
								<td>GPS Latitude</td>
								<td>GPS Longitude</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
						@foreach ($venues as $venue)
							<tr>
								<td>{{ $venue->id }}</td>
								<td>{{ $venue->name }}</td>
								<td>{{ $venue->gps_latitude }}</td>
								<td>{{ $venue->gps_longitude }}</td>
								<td></td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
