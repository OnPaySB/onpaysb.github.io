# OnPay API v1

## Introduction
---

The API v1 is a collection of HTTP RPC-style methods where the general structure of the URL is `https://account.onpay.my/api/v1/method_name`.

Use HTTPS when calling all methods. Any call through HTTP will be rejected.

Arguments can be passed as GET or POST parameters, depending on what request method is accepted by the method.

A response is returned as a JSON object and contains `ok` boolean field, indicating success or failure. In case of a failure, `message` field is available and contains a short description of the failure.

All API calls must have `token` parameter with valid token value for authentication purpose.

You can activate API function and  get the token at **Tetapan > Sistem > API & Webhook** in your account.

<br>

## Methods
---

### `sales.list`

Returns a list of sale records.

```none
GET https://account.onpay.my/api/v1/sales.list
```

|Argument|Required|Description|
|:-------|:------:|:----------|
|`token`|yes|Authentication token.|
|`page`|optional, default=`1`|Page number for pagination|
|`per_page`|optional, default=`20`|Records per page. Max value is `100`.|
|`ids`|optional|Filter by record IDs, where multiple IDs are separated by commas.|
|`filter_column`|optional|Filter by specific column. Allowed columns are `client_fullname`, `client_email`, `client_phone_number`, `client_address`, `extra_field_1`, `extra_field_2`, `extra_field_3`, `products`, `invoice_number` and `agent_username`.|
|`filter_value`|optional|Value used for `filter_column`.|
|`sort_column`|optional, default=`created_at`|Sort by speficic column. Allowed columns are `id`, `client_email`, `client_phone_number` and `created_at`.|
|`sort_dir`|optional, default=`asc`|Sort direction. Allowed values are `asc` and `desc`.|

```json
{"ok":true,"record_count":389,"per_page":20,"sales":[{...}],[{...}]}
```

<br>

### `sales.get`

Returns a sale record.

```none
GET https://account.onpay.my/api/v1/sales.get
```

|Argument|Required|Description|
|:-------|:------:|:----------|
|`token`|yes|Authentication token.|
|`id`|yes|Record ID.|

```json
{"ok":true,"sale":{...}}
```