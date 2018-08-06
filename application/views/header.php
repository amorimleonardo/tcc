<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>TCC</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="<?=base_url()?>public/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?=base_url()?>public/css/main.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <script src="<?=base_url()?>public/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://use.fontawesome.com/99cad594ef.js"></script>
</head>
<body>
	<? if($this->uri->segment(1) != 'home' && $this->uri->segment(1) != 'login' && $this->uri->segment(1) != ''){ ?>
	<nav class="navbar navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="javascript:history.back()"><i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar</a>
			</div>
		</div>
    </nav>
    <? } ?>
	<!-- <div class="background_app"> -->
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<p class="icon_app"><i class="fa fa-home fa-5x" aria-hidden="true"></i></p>