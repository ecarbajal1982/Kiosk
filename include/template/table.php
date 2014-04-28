<?php
printf( "
<div class='panel panel-default'>
	<div class='panel-heading'>
		<div class='form-inline'>
			<input class='form-control search' type='text' placeholder='Filter Results' data-column='all'>
			<button id='searchOptionsBtn' class='btn btn-info' style='margin-left: 5px'>
				<i class='fa fa-search'></i>&nbsp;Options
			</button>
			<button id='printReportBtn' class='btn btn-info' style='margin-left: 5px'>
				<i class='fa fa-file-o'></i>&nbsp;CreateReport
			</button>
		</div>
	</div>
	<div class='panel-body'>
		<table id='results_table' class='tablesorter'>
			<thead>
				<tr>
					<th scope='col' id='select_all' class='unchecked' style='padding-left:6px;'>
						<i class='fa fa-square-o'></i>
					</th>
					<th scope='col' style='padding-left:6px;'>
						<i id='edit_selected' class='fa fa-cog'></i>
					</th>
					<th scope='col' style='padding-left:6px;'>
						<i id='delete_selected' class='fa fa-trash-o'></i>
					</th>
" );

if ( $_POST['headers'] )
{
	foreach( $_POST['headers'] as $header )
	{
		printf( "<th scope='col'>%s</th>", $header );		
	}
}

printf( "
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<div class='panel-footer'>
		<div class='pager pagination center-block' id='pager' style='margin: 0px'>
			<div class='btn-group'>
				<button class='btn btn-info first'>
					<i class='fa fa-angle-double-left fa-lg'></i>
				</button>
				<button class='btn btn-info prev'>
					<i class='fa fa-angle-left fa-lg'></i>
				</button>
				<button class='btn btn-info active pagedisplay'>
				</button>
				<button class='btn btn-info next'>
					<i class='fa fa-angle-right fa-lg'></i>
				</button>
				<button class='btn btn-info last'>
					<i class='fa fa-angle-double-right fa-lg'></i>
				</button>
			</div>
		</div>
	</div>
</div>
" );
