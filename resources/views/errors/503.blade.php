<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance | Chada Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --md-primary: #2563eb;
            --md-on-primary: #ffffff;
            --md-surface: #fafafa;
            --md-on-surface: #171717;
            --md-surface-variant: #f0ede8;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--md-surface);
            color: var(--md-on-surface);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .maintenance-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            border: 1px solid #e5e5e5;
            max-width: 480px;
            width: 100%;
            padding: 3rem;
            text-align: center;
        }
        .maintenance-icon {
            width: 80px;
            height: 80px;
            background: var(--md-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }
        h1 { font-family: 'Outfit', sans-serif; font-weight: 700; }
    </style>
</head>
<body>
    <div class="maintenance-card">
        <div class="maintenance-icon">
            <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
        </div>
        <h1 class="mb-3">We Will Be Right Back</h1>
        <p class="text-muted mb-4">Chada Digital is currently undergoing scheduled maintenance. We are making improvements to serve you better.</p>
        <p class="text-muted mb-0" style="font-size: 0.875rem;">Expected to return shortly. Thank you for your patience.</p>
    </div>
</body>
</html>
