<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuw Contact Bericht</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 20px -30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .info-box {
            background-color: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-row {
            margin: 10px 0;
        }
        .label {
            font-weight: bold;
            color: #1e40af;
            display: inline-block;
            width: 120px;
        }
        .message-content {
            background-color: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            white-space: pre-line;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>📧 Nieuw Contact Bericht</h1>
        </div>

        <p>Je hebt een nieuw bericht ontvangen via het contactformulier van B-Pro Services.</p>

        <div class="info-box">
            <div class="info-row">
                <span class="label">Van:</span>
                <span>{{ $contactMessage->name }}</span>
            </div>
            <div class="info-row">
                <span class="label">Email:</span>
                <span><a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a></span>
            </div>
            <div class="info-row">
                <span class="label">Onderwerp:</span>
                <span>{{ $contactMessage->subject }}</span>
            </div>
            <div class="info-row">
                <span class="label">Datum:</span>
                <span>{{ $contactMessage->created_at->format('d-m-Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="label">IP Adres:</span>
                <span>{{ $contactMessage->ip_address }}</span>
            </div>
        </div>

        <h3>Bericht:</h3>
        <div class="message-content">{{ $contactMessage->message }}</div>

        <center>
            <a href="{{ route('admin.contact-messages.show', $contactMessage) }}" class="button">
                📋 Bekijk in Admin Panel
            </a>
        </center>

        <div class="footer">
            <p><strong>B-Pro Services</strong></p>
            <p>Dit is een automatisch gegenereerde email. Reageer rechtstreeks op het emailadres van de afzender.</p>
            <p style="font-size: 12px; margin-top: 10px;">
                © {{ date('Y') }} B-Pro Services. Alle rechten voorbehouden.
            </p>
        </div>
    </div>
</body>
</html>
