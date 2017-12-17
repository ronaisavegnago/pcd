<!DOCTYPE html>
<html class="ls-theme-blue">
	<head>

		<meta http-equiv="content-language" content="pt-br">
    	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
    	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<title>Elaborador de PCD</title>
		<meta name="description" content="Islen Calçados">
	    <meta name="author" content="Ronai Savegnago Ribeiro">
	    <meta name="robots" content="noindex,nofollow">
	    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	    <link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/3.10.0/stylesheets/locastyle.css">
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

	  	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

	    <script type="text/javascript">
			$(document).ready(function() {
  				$(".classes").select2();
			});
		</script>
		
		<script type="text/javascript">
            $(document).ready(function(){
              $('#classe_datatable').DataTable({
                "order": [[0, "desc"]],
                "language": {
		            "url": "////cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
		        }
              });
            });
        </script>
        <script>
        	$(document).ready(function(){
              $('#subclasse_datatable').DataTable({
                "order": [[0, "desc"]],
                "language": {
		            "url": "////cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
		        }
              });
            });
        </script>
        <script>
        	$(document).ready(function(){
              $('#grupo_datatable').DataTable({
                "order": [[0, "desc"]],
                "language": {
		            "url": "////cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
		        }
              });
            });
        </script>

	</head>
	<body>