<p>送り主:&emsp;{{ $mail['name'] }}</p>
<p>連絡先:&emsp;{{ $mail['email'] }}</p>
<br>
<p>{!! nl2br(e($mail['message'])) !!}</p>
