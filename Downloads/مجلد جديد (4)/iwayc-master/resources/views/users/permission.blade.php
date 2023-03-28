
 <div class="row">
	<div class="col-md-12">
		<br>
		<br>
		<br>
    	<form method="post" action="/CMS/User/permission/{{$item->id}}" class="form-horizontal">
        {{csrf_field()}}
				<div id="treeview_container" class="hummingbird-treeview">
				<ul id="treeview" class="hummingbird-base">
        		<?php
					$links = DB::table("links")->where("parent_id",0)->where("isdelete",0)->where("active",1)->get();
					$i=0;
				?>
				@foreach($links as $link)
				<?php
					$hasPermission=DB::table("user_link")->where("user_id",$id)->where("link_id",$link->id)->count()>0;
					$sublinks = DB::table("links")->where("parent_id",$link->id)->where("isdelete",0)->where("active",1)->get();
				?>
					<li>


						<label>
							<input id="node-{{$i++}}" data-id="custom-{{$i++}}" value="{{$link->id}}" type="hidden" name="permission[]" />
							<b>{{$link->title}}</b>
						</label>
						@if(count($sublinks)>0)
							<ul>
							<?php $m=0; ?>
                            <div class="row"><br>
							@foreach($sublinks as $sublink)
                    		<?php
								$hasPermission2=DB::table("user_link")->where("user_id",$id)->where("link_id",$sublink->id)->count()>0;
							?>

                          <div class="col-4">
									<label>
										<input id="node-{{$i}}-{{$m++}}" data-id="custom-{{$i}}-{{$m++}}" {{$hasPermission2?"checked":""}} value="{{$sublink->id}}" type="checkbox" name="permission[]" />
										{{$sublink->title}}
									</label>
							  </div>


							@endforeach()
                              </div><br>
							</ul>
						@endif()

					</li>
					@endforeach()
				</ul>
			</div>
			<hr>
			<div class="col text-center">
				<div class="col">
					<button type="submit" class="btn btn-primary">حفظ الصلاحيات</button>
				</div>
			</div>
		</form>
    </div>
</div>


		<!-- col -->


