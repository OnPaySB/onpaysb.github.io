# OnPay Webhook

## Introduction
---

The webhook will send HTTP POST request to the specified URL. Each order form can be set with their own unique webhook URL.

A webhook request will contain data in JSON format with `application/json` header. A webhook request will always contain `token` and `event_type` fields.

A `token` field can be used for verification purpose while an `event_type` field can be used to determine event type of the webhook.

The URL must respond with HTTP status code `200 OK` if the data is received successfully.

A webhook request will timeout after 30 seconds. If the first attempt is unsuccessful, the system will retry up to 4 times (in 5 minutes, 15 minutes, 1 hour and 5 hours).

You can activate webhook function and get the token at **Tetapan > Sistem > API & Webhook** in your account.

<br>

## Events
---

### `sale.created`
Data will be sent to the webhook URL when a sale record is created, after an order is received by the system.

### `sale.confirmed`
Data will be sent to the webhook URL when a sale record is confirmed.

### `sale.canceled`
Data will be sent to the webhook URL when a confirmed sale record is canceled.

<br>

## Code Example
---
The following code is for handling webhook on your part, using PHP.

```php
<?php
$webhook_token = 'your token here';

$raw_data = file_get_contents('php://input');
$data = json_decode($raw_data, true);

if (hash_equals($webhook_token, $data['token'])) {
    if ($data['event_type'] === 'sale.created') {
        # Do your process here
    } elseif ($data['event_type'] === 'sale.confirmed') {
        # Do your process here
    } elseif ($data['event_type'] === 'sale.canceled') {
        # Do your process here
    }
}
?>

```
