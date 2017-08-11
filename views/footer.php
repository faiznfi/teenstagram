	<div>
	</div>

	<!-- Latest compiled and minified JavaScript -->
	<?= $_div->nojquery ? '' : '<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>' ?>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<?= "\n" . ( $_div->foot ?: '' ) . "\n" ?>
    </BODY>
</html>