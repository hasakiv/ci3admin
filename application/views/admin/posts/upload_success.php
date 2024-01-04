<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Upload tập tin thành công!</h3>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p><?php echo anchor('post_add', 'Upload File khác!'); ?></p>

</body>
</html>