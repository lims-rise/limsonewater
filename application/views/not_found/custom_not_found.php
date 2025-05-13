<!DOCTYPE html>
<html>
<head>
    <title>Data Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fdfdfd;
            color: #333;
            text-align: center;
            padding-top: 100px;
        }
        .message-box {
            display: inline-block;
            border: 1px solid #ccc;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h2>Oops! No data found</h2>
        <p><?php echo $message; ?></p>
        <p>Sample ID: <strong><?php echo $sample_id; ?></strong></p>
        <a href="<?php echo site_url('dashboard'); ?>" style="text-decoration: none; color: #007BFF;">← Back to Dashboard</a>
    </div>
</body>
</html>
