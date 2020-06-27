
<div class="d-flex justify-content-between">
<a class="" href="{{ route('dashboard.users.edit',$id) }}">
    <i class="fa fa-edit  text-warning"></i>
</a>


{{ Form::open(['route' => ['dashboard.users.destroy',$id]]) }}
@method('DELETE')
<a class="confirm" href="#">
    <i class="fa fa-trash  text-danger"></i>
</a>
{!! Form::close() !!}
</div>

