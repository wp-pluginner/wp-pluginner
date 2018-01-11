@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(is_array($message))
                <div class="alert alert-{{$message['status']}}" role="alert">
                    {{$message['text']}}
                </div>
            @endif

            <div class="float-right">
                <button class="btn btn-info" data-toggle="modal" data-target="#createModel">Add New</button>
            </div>
            <p>Hello world, This is just sample admin menu to show model data.</p>
            <table class="widefat wp_pluginner-table-scrollable" style="margin-top:25px">
                <thead>
                    <tr>
                        <th class="row-title">id</th>
                        <th class="row-title">key</th>
                        <th class="row-title">value</th>
                        <th class="row-title">delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($model as $data)
                        <tr @if($loop->index % 2 == 0) class="alternate" @endif>
                            <td>{!! $data->id !!}</td>
                            <td>{!! $data->key !!}</td>
                            <td>{!! $data->value !!}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('delete-model-{{$data->id}}').submit();">Delete</button>

                                <form id="delete-model-{{$data->id}}" action="" method="POST" style="display: none;">
                                    <input type="hidden" name="_action" value="delete">
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="createModel" class="modal fade" data-backdrop="static" role="dialog" style="overflow-y:visible;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal form-bordered" action="" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Example Model</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label" for="defaultData-key">Key</label>
                            <input type="text" id="defaultData-key" class="form-control" required name="key">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="defaultData-key">Value</label>
                            <input type="text" id="defaultData-key" class="form-control" required name="value">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="_action" value="create">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
