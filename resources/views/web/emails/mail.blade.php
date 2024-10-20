<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Contact Us Message for Cambridge InfoTech</title>
    <!-- Bootstrap 4 CSS (for email compatibility you would inline critical styles) -->
    <style>
        body {
            background-color: #f4f5f6;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .content-box {
            background-color: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        h1 {
            font-size: 24px;
            color: #0867ec;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Contact Us Message for Cambridge InfoTech</h1>

        <!-- Content Box -->
        <div class="content-box">
            <p><strong>Inquiry Type:</strong> {{ $data['inquiry_type'] ?? 'N/A' }}</p>
            <p><strong>Full Name:</strong> {{ $data['full_name'] ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $data['email'] ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
            <p><strong>Subject:</strong> {{ $data['subject'] ?? 'N/A' }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $data['message'] ?? 'No message provided' }}</p>
            <p>This is a mail from Cambridge InfoTech</p>
        </div>
    </div>
</body>

</html>
