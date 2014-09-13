@include('header')
@include('dashboard/admin/menu_admin')
<section id="main-content">
        <section class="wrapper">
		<div class="form-group">
			<?php $item_nama =  DB::table('tb_item')->where('item_id', $item_ids)->where('item_status', 1)->pluck('item_nama');     
                   $pathpublic = asset('barangmu/'.$item_nama);                      ?>
			<a href="{{ $pathpublic }}">Link</a>
        </div>
        </section>
</section>

@include('footer')