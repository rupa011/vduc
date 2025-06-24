<!DOCTYPE html>
<html>

<body>
    <h2>Hi {{ $application->user->first_name }},</h2>

    <p>We’re pleased to inform you that your diving lesson application has been marked as <strong>Completed</strong>.
    </p>

    <p><strong>Lesson:</strong> {{ $application->lesson->lesson_name }}</p>
    <p><strong>Scheduled Date:</strong> {{ $application->schedule_date }}</p>
    <p><strong>Status:</strong> {{ $application->status }}</p>

    <p>Thank you for choosing Visayan Divers Underwater Contractor Inc.</p>

    <p>Regards,<br>Visayan Divers Team</p>
</body>

</html>
