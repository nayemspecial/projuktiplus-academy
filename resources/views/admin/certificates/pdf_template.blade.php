<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; text-align: center; margin: 0; padding: 0; }
        .container { 
            width: 100%; height: 100vh; 
            position: relative; 
            @if($bgImage)
            background-image: url('{{ $bgImage }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            @else
            border: 10px solid #ddd;
            @endif
        }
        .content { position: absolute; top: 40%; left: 0; right: 0; transform: translateY(-50%); }
        h1 { font-size: 40px; color: #333; margin-bottom: 10px; }
        h2 { font-size: 30px; color: #555; margin: 20px 0; }
        p { font-size: 18px; color: #777; }
        .course-name { font-size: 24px; font-weight: bold; color: #2d3748; margin: 10px 0; }
        .footer { position: absolute; bottom: 50px; left: 0; right: 0; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <p>এটি প্রত্যয়ন করা যাচ্ছে যে</p>
            <h2>{{ $user->name }}</h2>
            <p>সফলভাবে সম্পন্ন করেছেন</p>
            <div class="course-name">{{ $course->title }}</div>
            <p>ইস্যু তারিখ: {{ \Carbon\Carbon::parse($data['issue_date'])->format('d M, Y') }}</p>
        </div>
        <div class="footer">
            সার্টিফিকেট আইডি: {{ $data['certificate_number'] }} <br>
            যাচাইকরণ কোড: {{ $data['verification_code'] }}
        </div>
    </div>
</body>
</html>