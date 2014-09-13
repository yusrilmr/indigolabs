@include('header')
@include('dashboard/admin/menu_admin')
<section id="main-content">
        <section class="wrapper">
            

            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">

                        <header class="panel-heading">
                           Upload Files
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                        </header>

                        <div class="panel-body">
                            <div class="form-group">
                                {{ Form::open(array('url'=>'upload/insert','files'=>true)) }}
                                <label class="control-label col-md-3">Upload</label>
                                <div class="col-md-4">
                                    {{Form::file('berkas', array('class' => 'default'))}}
                                </div>
                                {{Form::submit('Submit', array('class' => 'btn btn-primary')) }}
                                {{ Form::close() }}
                            </div>
                            <div class="adv-table editable-table ">
                                <div class="clearfix">
                                    
                                </div>
                                <div class="space15"></div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama File</th>
                                                <th>Link</th>
                                            </tr>
                                         </thead>

                                        <tbody>
                                            <?php $i=0; ?>
                                                @foreach($items as $item)
                                                    <?php $pathpublic = asset('barangmu/'.$item->item_kode); ?>
                                                       <tr>
                                                        <?php $i++; ?>
                                                            <td>{{ $i }}</td>
                                                            <td>
                                                                {{ $item->item_nama }}
                                                            </td>
                                                            <td>
                                                                <a href="{{ $pathpublic }}">Download</a>
                                                            </td>
                                                        </tr>
                                                @endforeach
                                        
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            

                        </div>



                    </section>
                </div>
            </div>
            
                

        </section>
</section>

@include('footer')
{{ HTML::script('js/bootstrap-fileupload/bootstrap-fileupload.js') }}
{{ HTML::script('js/table-editable.js') }}
{{ HTML::script('js/iCheck/jquery.icheck.js') }}
{{ HTML::script('js/icheck-init.js') }}




<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
    });
</script>