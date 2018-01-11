@extends('admin.layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <p>Hello world, This is just sample admin menu view.</p>
        <h3>Work Flow</h3>
        <p>To understanding how this view rendered, read details below:</p>
        <table class="widefat wp_pluginner-table-scrollable">
            <thead>
                <tr>
                    <th class="row-title">No</th>
                    <th class="row-title">Description</th>
                </tr>
            </thead>
            <tbody>
                <tr class="alternate">
                    <td>1</td>
                    <td>
                        File: <strong>wp-property/admin/menu.php</strong>
                        <p>admin_menu action registered in this file through plugin admin factory (<strong>$this->plugin->admin()</strong>). In this file dashboard menu registered with controller (<strong>WpPluginner\Http\Controller\Admin\SampleController@dashboard</strong>), It's mean dashboard menu will controlled by function: <strong>dashboard</strong>, in class: <strong>WpPluginner\Http\Controller\Admin\SampleController</strong> </p>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        File: <strong>app/Http/Controller/Admin/SampleController.php</strong>
                        <p>Controller class will handle all logic. In this case function : <strong>dashboard</strong> only processing view: <strong>admin.dashboard</strong> with some variable called <strong>$this->attributes</strong></p>
                    </td>
                </tr>
                <tr class="alternate">
                    <td>3</td>
                    <td>
                        File: <strong>resource/view/admin/dashboard.blade.php</strong>
                        <p>Plugin view resource from called function before. In this file we put content to print.</p>
                        <p><strong>.blade.php</strong> extension means content will processing with blade template. However you can use <strong>.php</strong> extension without blade templating.</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
