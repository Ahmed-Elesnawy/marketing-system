
<a class="btn btn-warning" href="{{ route('dashboard.orders.edit',$id) }}">
    <i class="fa fa-edit"></i>
</a>





<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ 'delete-order-'. $id }}">
  <i class="fa fa-trash"></i>
</button>




<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{ 'show-order-'. $id }}">
  <i class="fa fa-eye"></i>
</button>
