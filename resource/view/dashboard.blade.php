@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-md-8">
        <file-upload></file-upload>
    </div>
    <div class="col-md-4">
        {{ $menu_slug }}
        <?php print_r($plugin->option()->get('done','wkwkwkwk')); ?>
    </div>

</div>
@endsection
