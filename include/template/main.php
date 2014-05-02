<div class="panel-group">

	<div class="panel panel-default" style="overflow:visible">
		<div id="search_panel" class="panel-collapse collapse in">
			<div class="panel-body">
<div class="row">


  <div class="col-xs-5">
    <div class="input-group">
      <div class="input-group-btn">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Equipment <span class="caret"></span></button>
        <ul class="dropdown-menu">
          <li><a href="#">Equipment</a></li>
          <li><a href="#">Software</a></li>
          <li><a href="#">Users</a></li>
          <li><a href="#">Purchases</a></li>
					<?php if ( $_SESSION['role'] > 1 ) : ?>
          	<li class="divider"></li>
          	<li><a href="#">Software</a></li>
					<?php endif; ?>
        </ul>
      </div><!-- /btn-group -->
      <input type="text" class="form-control" placeholder="Search">
			<span class="input-group-btn">
        <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
      </span>
    </div><!-- /input-group -->
<span class="help-block">Select type of search and enter keywords</span>
		<script>      
			$(".dropdown-menu>li>a").click(function(){
  			$(this).parents('.input-group-btn').find('.dropdown-toggle').html( $( this ).text() +' <span class="caret"></span>');
			});
		</script>

  </div><!-- /.col-lg-5 -->


</div><!-- /.row -->
<div class="row">
	<div class="col-xs-4"><br>
<h4>Additional search options:</h4>
	</div>
</div>

			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div id="filter_panel" class="panel-collapse collapse">
			<div class="panel-body">
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div id="report_panel" class="panel-collapse collapse">
			<div class="panel-body">
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


			</div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<div id="table_panel_head" class="row">
			</div>
	    </div>

	    <div id="table_panel" class="panel-collapse collapse">
			<div class="panel-body">

				<table id="results_table" class="tablesorter">
					<thead><tr></tr></thead>
					<tbody></tbody>
				</table>

			</div>

			<div id="pager" class="panel-footer pager" style="margin: 0px">
				<div class="row">
				<div class="col-xs-3">
					
				</div>

				<div class="col-xs-6">
				<div class="center-block">
					<div class="btn-group">
						<button class="btn btn-info first">
							<i class="fa fa-angle-double-left fa-lg"></i>
						</button>
						<button class="btn btn-info prev">
							<i class="fa fa-angle-left fa-lg"></i>
						</button>
						<button class="btn btn-info active pagedisplay">
						</button>
						<button class="btn btn-info next">
							<i class="fa fa-angle-right fa-lg"></i>
						</button>
						<button class="btn btn-info last">
							<i class="fa fa-angle-double-right fa-lg"></i>
						</button>
					</div>
				</div>
				</div>
				
<div class="col-xs-3"><div class="pull-right" style="margin-top: 10px">
Records per page
    <select class="pagesize">
      <option selected="selected" value="10">10</option>
      <option value="15">15</option>
      <option value="20">20</option>
      <option value="9999">All</option>
    </select>
</div></div>
			</div>

		</div>

	</div>

</div>
