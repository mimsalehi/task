### Prerequisite

Install Docker on your local Machine and Enable the WSL2 if you are using Windows OS

### Run Steps

#### Step 1

Use this command to build your containers

```shell
docker-compose build
```

#### Step 2

Use this command to run your containers

```shell
docker-compose up -d
```

#### Step 3

Open Docker Desktop and run the terminal of task-php container then run these commands:

**Note: Don't change the order of commands!**

```shell
composer install
chmod -R 777 storage/*
cp .env.example .env
php artisan optimize:clear
php artisan migrate
php artisan db:seed
```

### Tests

To run tests use this command

```shell
php artisan test
```

Expected Results are:

```text
   PASS  Tests\Feature\Api\AssignReportToAgentTest
  ✓ report assignment

   PASS  Tests\Feature\Api\DelayReportTest
  ✓ delay report
  ✓ delay report queued
  ✓ delay report not queued

   PASS  Tests\Feature\Api\OrderTest
  ✓ orders list route

   PASS  Tests\Feature\Api\StatisticsTest
  ✓ statistics list

   PASS  Tests\Feature\Api\TripTest
  ✓ store trip

  Tests:  7 passed
  Time:   39.82s

```

### APIs

Use `http://localhost/api/v1/` as `API`

#### `GET` API/orders

Gets the list of orders

##### Response

```json
[
    {
        "id": 1,
        "title": "qui",
        "description": "Ut distinctio pariatur laboriosam ullam non. Quis aut vitae inventore soluta. Quisquam sit blanditiis voluptate.",
        "delivery_time": "2022-08-21 13:22:26"
    },
    {
        "id": 2,
        "title": "non",
        "description": "Quia alias sapiente beatae ea. Corporis id blanditiis molestiae. Rerum unde et molestias natus ut aperiam.",
        "delivery_time": "2022-08-21 13:03:29"
    }
]
```

#### `GET` API/statistics

Gets the vendors' statistics with

##### Response

```json
[
    {
        "id": 25,
        "title": "veniam",
        "address": "3960 Linnie Bypass Apt. 719\nEast Josh, MT 56578",
        "created_at": "2022-08-21T14:10:15.000000Z",
        "reports_count": 8,
        "sum_delay_minutes": 112
    },
    {
        "id": 26,
        "title": "asperiores",
        "address": "37196 Armand Fall\nAbernathyville, WI 74457-2415",
        "created_at": "2022-08-21T14:10:15.000000Z",
        "reports_count": 8,
        "sum_delay_minutes": 112
    }
]
```

#### `POST` API/orders/{order}/report

Creates a delay report for the order

##### Responses

```json
{
    "success": true,
    "message": "Delay reported successfully!"
}
```

Or

```json
{
    "success": false,
    "message": "Failed to report delay."
}
```

#### `POST` API/orders/{order}/trip

Creates a trip for an order

##### Responses

```json
{
    "id": 12,
    "order_id": 124,
    "status": "ASSIGNED",
    "created_at": "2021-02-03 10:20:30"
}
```

#### `POST` API/agent/assign-report

Assigns a delay report to an Agent - FIFO

##### Responses

```json
{
    "success": true,
    "message": "Order assigned to agent successfully!"
}
```

Or

```json
{
    "success": false,
    "message": "Failed to assign the agent to order."
}
```
