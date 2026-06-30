<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #1a202c; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px; background: #f8f9fa; }
        .detail { margin-bottom: 15px; }
        .label { font-weight: bold; color: #555; }
        .message-box { background: white; padding: 15px; border-left: 4px solid #007bff; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📧 New Contact Message</h2>
        </div>
        <div class="content">
            <div class="detail">
                <span class="label">From:</span> {{ $messageData['name'] }}
            </div>
            <div class="detail">
                <span class="label">Email:</span> {{ $messageData['email'] }}
            </div>
            <div class="detail">
                <span class="label">Subject:</span> {{ $messageData['subject'] }}
            </div>
            <div class="message-box">
                <strong>Message:</strong><br>
                {{ nl2br($messageData['message']) }}
            </div>
            <hr>
            <small style="color: #999;">This message is stored in your admin panel → Messages</small>
        </div>
    </div>
</body>
</html>
