<?php

return [
    'log_message' => "Notifiable[:notifiable] has been notified with the Notification[:notification] via \":notification_type\" type Notifications",
    'events' => [
        'created' => [
            'success' => "The notification has been saved and it will be broadcasted to the respective users shortly.",
            'failure' => "The notification couldn't been saved, please try again later."
        ]
    ]
];
