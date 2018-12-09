<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo (isset($page_title) ? $page_title : '') . $this->config->item('view')['seo']['title']; ?></title>
<meta name="keywords" content="<?php echo $this->config->item('view')['seo']['key']; ?>">
<meta name="description" content="<?php echo $this->config->item('view')['seo']['desc']; ?>">

<link rel="stylesheet" href="<?php echo $this->config->item('public_url'); ?>css/reset.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php echo $this->config->item('public_url'); ?>css/front.css" type="text/css" media="screen, projection" />

<script type="text/javascript" src="<?php echo $this->config->item('public_url'); ?>js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('public_url'); ?>js/common.js"></script>
</head>
<body>