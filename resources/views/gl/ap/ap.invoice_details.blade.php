@extends('base')

@section('content')
	<nav aria-label="breadcrumb" style="margin-left:30px;">
		<ol class="breadcrumb" style="background-color:#ecf0f5;">
			<li class="breadcrumb-item">Accounts Payables</li>
			<li class="breadcrumb-item active" aria-current="page">Vendors</li>
		</ol>
	</nav>
<!--modal for printing vendor parameters-->
<div id="debtor_statement" class="modal fade" role="dialog">
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="printlabel"></h4>

      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="statement_form_all">
          {{ csrf_field() }}

          <div class="form-group">
            <label for="as_at_date" class="col-md-3 control-label required">As at Date</label>
              <div class="col-md-4">
                <input type="hidden" id="today" name="today" value="{{$today}}">
                <input type="hidden" id="dr_cr_print" name="dr_cr_print" >
                <input id="as_at_date" type="date" class="form-control" name="as_at_date">
              </div>
          </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="print_btn">Print</button>
      </div>
    </div>
  </div>
</div>
<!--end of vendor statements parameters-->

<!-- ageing generation status modal-->
<div class="modal fade" id="ageing_status_all" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="generatelabel">Generate Vendor Statement</h4>
      </div>
      <div class="modal-body">
          <p id="status_all"></p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--end of ageing generation status modal-->
	<section class="invoice">
		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-md-3">
						<a href="{{ route('getvendorform')}}" class="btn btn-default btn-block text-left btn-black"><span class="glyphicon glyphicon-edit"></span> Add Vendor</a>
					</div>

					<div class="col-xs-4">
          <a id="statement">
          <button class="btn btn-default btn-block text-left btn-black">
            <span class="fa fa-edit"></span>Vendors Statement(Sum all vendors)</button>
          </a>
          </div>
				</div>
				<hr>

				<div class="table-responsive">
					<table class="table  table-black table-borderless" width="100%" id='vendors_table'>
						<thead>
							<tr>
								<th>VENDOR ID</th>
								<th>VENDOR NAME</th>
								<th>EMAIL</th>
								<th>PHONE NUMBER</th>
								<th>ADDRESS 1</th>
								<th>ADDRESS 2</th>
								<th>ADDRESS 3</th>
								<th>DATE CREATED</th>
								<!-- <th>Action</th> -->
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</section>

	<div class="clearfix"></div>
@endsection

@push('script')
<script type="text/javascript">
  	$('#vendors_table').dataTable({
		processing: true,
		bAutowidth: true,
		order: [[ 7, 'desc' ]],
		ajax:"{{ route('getvendors') }}",
		columns: [
			{ data: 'vendor_id'},
			{ data: 'vendor_name'},
			{ data: 'email'},
			{ data: 'phone_no_1' },
			{ data: 'address_1'},
			{ data: 'address_2' },
			{ data: 'address_3'},
			{ data: 'date_created', 'visible':false},
			// { data: 'action', name: 'action', orderable: false, searchable: false},
		],

	});

	// $('#vendors_table').on('click','#btn-view',function(){
	// 	var class_id = $(this).attr('data-class_id')
	// 	var url = "{{ route('vendordetails','id')}}"
	// 	url=url.replace('id',class_id)

	// 	window.location.href = url
	// });

	$('#vendors_table').on('click','tbody td',function(){
		let vendor = $(this).closest('tr').find('td:eq(0)').text();
		let url = "{{ route('vendordetails','id')}}"
		url = url.replace('id',vendor)

		window.location.href = url
	})


//enter debtors statement date
$('#statement').on('click',function(){

dr_cr_statement('dr')
});

//enter creditors statement date
$('#cr_statement').on('click',function(){
	  dr_cr_statement('cr')
});

function dr_cr_statement(dr_cr) {
DR_CR=dr_cr;

 //check if user is allowed to run debtors/creditor
 $.ajax({
  url:"/ap/vendor_checkrundebtors",
  dataType:"json",
  type:"get",
  success:function(resprun){
	if(resprun.status == "Y"){
	  var today = $('#today').val();
	  var date = moment(today).format('YYYY-MM-DD');
	  $('#as_at_date').val(date);
	  $('#dr_cr_print').val(DR_CR);
	  if(dr_cr=="dr"){
		$('#printlabel').text('Print Summary Statement for All Vendors');
		$('#generatelabel').text('Generate Vendor Statement');

	  }else{
		$('#printlabel').text('Print Summary Creditors Statement');
		$('#generatelabel').text('Generate Creditors Statement');
	  }

	  $('#debtor_statement').modal({backdrop: 'static', keyboard: false});
	  $('#debtor_statement').modal('show');
	}
	else{
	  $('#error_message').modal({backdrop: 'static', keyboard: false});
	  $('#message').html('Not Allowed to Run Debtors');
	  $('#message').css("color", "red");
	  $('#error_message').modal('show');
	}
  }
});
}


//print statement
$('#print_btn').on('click',function(){
var date = $('#as_at_date').val();
  $.ajax({
	url:"/ap/vendor_generateageingall",
	data:$('#statement_form_all').serialize(),
	dataType: "json",
	type:"get",
	success:function(age){
		if(age.status == 1 && age.count == 0){
		  $('#ageing_status_all').modal({backdrop: 'static', keyboard: false});
		  if(DR_CR=="dr"){
			$('#status_all').html('No vendor statement generated');
		  }else{
			$('#status_all').html('No creditors statement generated');
		  }
		  $('#_all').css("color", "red");
		  $('#ageing_status_all').modal('show');
		  $('#ageing_status_all').on('hidden.bs.modal', function (e){
			$('#print_statement').modal('hide');
		  });
		}
		else{
		  $('#ageing_status_all').modal({backdrop: 'static', keyboard: false});
		  if(DR_CR=="dr"){
		  $('#status_all').html('Vendor statement generated successfully');
		  }else{
			$('#status_all').html('Creditors statement generated successfully');
		  }
		  $('#status_all').css("color", "green");
		  $('#ageing_status_all').modal('show');
		  $('#ageing_status_all').on('hidden.bs.modal', function (e){
			//$('#print_statement').modal('hide');
			var doc = 'APD';
			var type = '1';
			var user = age.user;
			var date = age.date;
			var statement = doc+type+date+user;
			// alert(statement);
			try{
				window.external.cs_event(statement.toString());
			  }
			  catch(err){
				try{
				  window.parent.postMessage(statement.toString(),"*");
				}
				catch(err)
				{
				  console.log(err)
				}
			  }
			  location.reload();
		  });
	  } ///end else
	}
  });
});

</script>
@endpush

