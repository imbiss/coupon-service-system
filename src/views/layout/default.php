<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/admin/resource/netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/resource/netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
    <title><?=$title_for_layout?></title>
    <link rel="stylesheet" href="/admin/css/standard.css" >
</head>
<body>
<?php
echo $body;
?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/admin/resource/cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/admin/resource/cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="/bootstrap/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.selectpicker').selectpicker({
            'selectedText': 'cat'
        });
    });
</script>
</body>
</html>