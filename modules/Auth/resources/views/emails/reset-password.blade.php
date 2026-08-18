<html>
    <p>Hello {{ $full_name }},</p>
    <p>We received a request to reset your password for your account.</p>
    <p>Please use the following verification code to proceed:</p>
    <p>
        <code>{{ $code }}</code>
    </p>
    <p>Make sure to use it as soon as possible, as this code will expire after a short period of time.</p>
    <p>Please make sure you are on a secure network before resetting your password. This is
        <strong>important</strong> to protect your account from unauthorized access.</p>
    <p>Thank you for your attention!</p>
</html>
