<div style="margin-top: 15%">
	<h2 id="notif"></h2>
	<input type="hidden" id="status">
	<div class="kotak2">
		<h3 align="center">Jangan segan mengontak kami jika ada permasalahan!</h3>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		setInterval(function(){
			$('#notif').load('<?php echo base_url('notif')?>');
			var notif = $('#notif').text();
			$('#status').val(notif);
		}, 100)
		var value = '',
		elem = $('#status')[0];
		setInterval(function(){
			if (elem.value !== value && elem.value !== "Proses Pemesanan Sedang Diproses") { 
				alert(elem.value);
			}
			value = elem.value;
		}, 2000);
	});
</script>