<h1>Dashboard</h1>
<?php if (!empty($_SESSION['user'])): ?>
	<?php pr($_SESSION['user']) ?>
<?php endif ?>