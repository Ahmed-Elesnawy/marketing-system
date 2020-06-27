
<div class="d-flex justify-content-between w-40">
<a class="" href="{{ route('dashboard.categories.edit',$id) }}">
    <i class="fa fa-edit  text-warning"></i>
</a>


{{ Form::open(['route' => ['dashboard.categories.destroy',$id]]) }}
@method('DELETE')
<a class="confirm" href="#">
    <i class="fa fa-trash  text-danger"></i>
</a>
{!! Form::close() !!}
</div>

