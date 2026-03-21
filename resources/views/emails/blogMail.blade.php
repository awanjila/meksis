<!DOCTYPE html>
<html>
<head>
    <style>
        .email-wrapper {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            padding: 25px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            letter-spacing: 0.5px;
        }

        .content {
            padding: 35px;
            background-color: #ffffff;
        }

        .blog-title {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .blog-description {
            color: #4a5568;
            margin-bottom: 25px;
            line-height: 1.8;
            font-size: 16px;
            position: relative;
            overflow: hidden;
            max-height: 200px;
        }

        .blog-description::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40px;
            background: linear-gradient(transparent, #ffffff);
        }

        .author-panel {
            background-color: #f8f9fa;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            display: flex;
            align-items: center;
        }

        .author-info {
            margin-left: 15px;
        }

        .author-label {
            color: #718096;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .author-name {
            color: #2c3e50;
            font-weight: 600;
            font-size: 16px;
        }

        .button-wrapper {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            display: inline-block;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 12px 28px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            font-size: 16px;
            transition: transform 0.2s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #718096;
            font-size: 13px;
            border-top: 1px solid #e9ecef;
            background-color: #f8f9fa;
            border-radius: 0 0 8px 8px;
        }

        .greeting {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 25px 0;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Hi {{ $contactName }},
            </div>

            <div class="blog-title">
                {{ $data['name'] }}
            </div>

            <div class="blog-description">
                {!! \Illuminate\Support\Str::limit(strip_tags($data['description']), 300, '...') !!}
            </div>

            <div class="author-panel">
                <div class="author-info">
                    <div class="author-label">Written by</div>
                    <div class="author-name">{{ $data['author'] }}</div>
                </div>
            </div>

            <div class="button-wrapper">
                <a href="{{ route('show.blog', ['slug' => Str::slug($data['name'])]) }}" class="button">
                    Read Full Article
                </a>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }} • All rights reserved</p>
        </div>
    </div>
</body>
</html>
