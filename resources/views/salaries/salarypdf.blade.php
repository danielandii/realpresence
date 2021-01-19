<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Salary PDF</title>

	<style>
		.container {
		  text-align: center;
		  width: 625px;
		}

		.order-wrapper h3, .container h3 {
		  color: #322f33;
		  font-family: "Futura Md BT";
		  font-size: 18px;
		}

		.order-wrapper p, .container p {
		  font-size: 12px;
		}


		.order-wrapper h4, .container h4 {
		  font-size: 17px;
		  color: #322f33;
		  font-weight: bold;
		}

		.order-wrapper h6, .container h6 {
		  font-size: 12px;
		  font-family: Tekton Pro Ext;
		  color: #555;
		}

		.title h2 {
		  color: #322f33;
		  font-family: "Arial Black";
		  font-size: 20px;
		  padding-top: 5px;
		}

		.address{
		  padding-bottom: 5px;
		  border-bottom: 1px solid #CCD7D4;
		}

		.clear {
		  clear: both;
		}

		.pb-10{
		  padding-bottom: 10px;
		}

		.px-10{
		  padding: 0 10px;
		}

		.px-20{
		  padding: 0 20px;
		}

		.pr-10{
		  padding-right: 10px;
		}

		.pl-10{
		  padding-left: 10px;
		}

		.float-left {
		  text-align: left;
		  float: left;
		  display: inline-block;
		}

		.float-right {
		  text-align: right;
		  float: right;
		  display: inline-block;
		}


		.mr-1{
		  margin-right: 1px;
		}

		.order-wrapper h5, .container h5{
		  color: #262626;
		  font-family: stencil;
		  font-size: 14px;
		}

		.d-inline{
		  display: inline;
		}

		.d-inline-block{
		  display: inline-block;
		}

		.pt-10{
		  padding-top: 10px;
		}

		.menu span{
		  font-size: 14px;
		  color: #333;
		  font-family: "Futura Md BT";
		}

		.garis-plus{
		  display: inline-block;
		  height: 20px;
		  width: 150px;
		  position: relative;
		}

		.garis-plus::before {
		  width: 100%;
		  background-color: #000000;
		  height: 1px;
		  content: "";
		  display: inline-block;
		  position: absolute;
		  bottom: 0;
		  left: 0;
		}

		.garis-plus::after {
		  content: "+";
		  position: absolute;
		  right: 0;
		  top: 0;
		}

		.garis-min{
		  display: inline-block;
		  height: 20px;
		  width: 150px;
		  position: relative;
		}

		.garis-min::before {
		  width: 100%;
		  background-color: #000000;
		  height: 1px;
		  content: "";
		  display: inline-block;
		  position: absolute;
		  bottom: 0;
		  left: 0;
		}

		.garis-min::after {
		  content: "-";
		  position: absolute;
		  right: 0;
		  top: 0;
		}

		.garis-kosong{
		  display: inline-block;
		  height: 20px;
		  width: 100px;
		  position: relative;
		}

		.garis-kosong::before {
		  width: 100%;;
		  height: 1px;
		  content: "";
		  display: inline-block;
		  position: absolute;
		  bottom: 0;
		  left: 0;
		}

		.garis-kosong::after {
		  content: "";
		  position: absolute;
		  right: 0;
		  top: 0;
		}

		.garis-kosong-ttd{
		  display: inline-block;
		  height: 25px;
		  position: relative;
		}

		.garis-kosong-ttd::before {
		  width: 100%;;
		  height: 1px;
		  content: "";
		  display: inline-block;
		  position: absolute;
		  bottom: 0;
		  left: 0;
		}

		.garis-kosong-ttd::after {
		  content: "";
		  position: absolute;
		  right: 0;
		  top: 0;
		}

		.mr-50{
		  margin-right: 125px;
		}

		.ml-50{
		  margin-left: 100px;
		}

		.ttd h4{
		  text-align: center;
		}

		.ttd h5{
		  font-family: "Baskerville Old Face";
		  text-align: center;
		  font-size: 16px;
		}

		.menu .text-left{
			text-align: left;
		}

		.container .title{
			text-align: center;
		}
	</style>
</head>
<body>

	<div class="container">
		<div class="title pt-10">
			<h2>Slip Gaji Karyawan</h2>
			<p>Periode: {{ $salary->month ,  $salary->year }}</p>
		</div>

		<div class="menu px-10 col-lg-12">
			<div class="col-md-5 float-left">
				<div class="col-md-12">
					<h5 class="mr-1 d-inline">Nama:</h5>
					<span>{{ $salary->employee->name }}</span>
				</div>
				
				<div class="col-md-12">
					<h5 class="mr-1 d-inline">Jabatan:</h5>
					<span>{{ config('custom.role.'.$salary->employee->role) }}</span>
				</div>
			</div>

			<div class="col-md-7 float-right text-left">
				<div class="col-md-12">
					<h5 class="mr-1 d-inline">Email:</h5>
					<span>{{ $salary->employee->email }}</span>
				</div>
				
				<div class="col-md-12">
					<h5 class="mr-1 d-inline">Telepon:</h5>
					<span>{{ $salary->employee->phone_number }}</span>
				</div>
			</div>
		</div>
		<div class="clear"></div>

		<hr>

		<div class="detail">
			<div class="title-detail">
				<h3>Detail Gaji</h3>
			</div>

			<div class="col-lg-12">
				<div class="col-lg-3">
					<div class="float-left">
						<h6>Gaji Pokok</h6>
						<h6>Uang Makan</h6>
						<h6>Bonus</h6>
						<div class="garis-kosong"></div>
					</div>
				</div>

				<div class="col-lg-9">
					<div class="float-right">
						<h6 class="mr-3">Rp. {{ number_format($salary->gaji_pokok_salary,2,",",".") }}</h6>
						<h6 class="mr-3">Rp. {{ number_format($salary->uang_makan_salary,2,",",".") }}</h6>
						<h6 class="mr-3">Rp. {{ number_format($salary->bonus,2,",",".") }}</h6>
						<div class="garis-plus"></div>
					</div>
				</div>

				<div class="clear"></div>

				<div class="col-lg-3">
					<div class="float-left">
						<h6>Gaji Kotor</h6>
						<h6>PPH ({{  $salary->pph_percentage  }}% )</h6>
						<h6>BPJS ({{  $salary->bpjs_percentage  }}% )</h6>
						<h6>Potongan Lain</h6>
						<div class="garis-kosong"></div>
					</div>
				</div>

				<div class="col-lg-9">
					<div class="float-right">
						<h6 class="mr-3">Rp. {{ number_format($salary->gaji_kotor,2,",",".") }}</h6>
						<h6 class="mr-3">Rp. {{ number_format($salary->pph,2,",",".") }}</h6>
						<h6 class="mr-3">Rp. {{ number_format($salary->bpjs,2,",",".") }}</h6>
						<h6 class="mr-3">Rp. {{ number_format($salary->potongan_lain,2,",",".") }}</h6>
						<div class="garis-min"></div>
					</div>
				</div>

				<div class="clear"></div>

				<div class="col-lg-3">
					<div class="float-left">
						<h6>Gaji Bersih/Total</h6>
						<div class="garis-kosong"></div>
					</div>
				</div>

				<div class="col-lg-9">
					<div class="float-right">
						<h6 class="mr-3">Rp.{{  number_format($salary->gaji_bersih,2,",",".") }}</h6>
					</div>
				</div>
			</div>
		</div>

		<div class="clear"></div>

		<hr>

		<div class="float-left ml-50 ttd">
			<h4>Penerima</h4>
			<div class="garis-kosong-ttd"></div>
			<h5>{{ $salary->employee->name }}</h5>
		</div>

		<div class="float-right mr-50 ttd">
			<h4>Direktur</h4>
			<div class="garis-kosong-ttd"></div>
			<h5>Nama Direktur</h5>
		</div>


	</div>

</body>
</html>