<html>
    <p>Hello {{ $full_name }}!</p>
    <p>We received a request to reset your password for your account.</p>
    <p>To reset your password, simply follow the link below. Make sure to do it as soon as possible, as the link will expire after a short period of time.</p>

    <a href="{{ $url }}">Reset password</a>

    <p>Please make sure you are on a secure network before resetting your password. This is <strong>important</strong> to protect your account from unauthorized access.</p>
    <p>Thank you for your attention!</p>
</html>
