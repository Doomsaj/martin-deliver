
# API Documentation for Martin Deliver

This documentation covers the API endpoints available in the **Martin Deliver** application. Each section provides detailed information about the endpoints, including their purpose, methods, and sample requests.

## Table of Contents

1. [Client APIs](#client-apis)
   - [Place New Consignment Request](#place-new-consignment-request)
   - [Cancel Consignment Request](#cancel-consignment-request)
   - [Create Webhook Subscription](#create-webhook-subscription)
   - [Client Login](#client-login)
2. [Courier APIs](#courier-apis)
   - [Courier Login](#courier-login)
   - [Get Available Consignments](#get-available-consignments)
   - [Accept Consignment](#accept-consignment)
   - [Update Courier Location](#update-courier-location)
   - [Get My Consignments](#get-my-consignments)
   - [Consignment Received](#consignment-received)
   - [Consignment Arrived](#consignment-arrived)

---

## Client APIs

### Place New Consignment Request

- **Endpoint**: `POST {{BASE_URL}}/api/client/consignments/new-request`
- **Description**: This endpoint allows a client to place a new consignment request.
- **Sample Request**:
  ```json
  {
      "receive_from": {
          "latitude": 12.34567890,
          "longitude": 123.45678901,
          "address": "123 Main St, City, Country",
          "name": "John Doe",
          "phone": "1234567890"
      },
      "delivery_to": {
          "latitude": 23.45678901,
          "longitude": 234.56789012,
          "address": "456 Elm St, City, Country",
          "name": "Jane Smith",
          "phone": "0987654321"
      }
  }
  ```

### Cancel Consignment Request

- **Endpoint**: `POST {{BASE_URL}}/api/client/consignments/cancel-request`
- **Description**: This endpoint allows a client to cancel an existing consignment request.
- **Sample Request**:
  ```json
  {
      "consignment_code": "019167c7-386d-7058-8a11-fe9706d21f09"
  }
  ```

### Create Webhook Subscription

- **Endpoint**: `POST {{BASE_URL}}/api/client/webhook/new-subscription`
- **Description**: This endpoint allows a client to create a new webhook subscription for event notifications.
- **Sample Request**:
  ```json
  {
      "url": "https://test.com/courier-location-changed",
      "method": "POST",
      "secret": "123sajjad",
      "event": "courier_location_changed"
  }
  ```

### Client Login

- **Endpoint**: `POST {{BASE_URL}}/api/client/login`
- **Description**: This endpoint is used for client authentication.
- **Sample Request**:
  ```json
  {
      "username": "client",
      "password": "password"
  }
  ```

---

## Courier APIs

### Courier Login

- **Endpoint**: `POST {{BASE_URL}}/api/courier/login`
- **Description**: This endpoint is used for courier authentication.
- **Sample Request**:
  ```json
  {
      "username": "courier",
      "password": "password"
  }
  ```

### Get Available Consignments

- **Endpoint**: `GET {{BASE_URL}}/api/courier/consignments/available`
- **Description**: This endpoint retrieves the list of consignments available for pickup by the courier.
  
### Accept Consignment

- **Endpoint**: `POST {{BASE_URL}}/api/courier/consignments/accept`
- **Description**: This endpoint allows a courier to accept an available consignment.
- **Sample Request**:
  ```json
  {
      "consignment_code": "01916c39-bbda-735a-8896-eb0e6fa63601"
  }
  ```

### Update Courier Location

- **Endpoint**: `POST {{BASE_URL}}/api/courier/consignments/update-location`
- **Description**: This endpoint updates the courier's current location.
- **Sample Request**:
  ```json
  {
      "latitude": 12.34567890,
      "longitude": 123.45678901,
      "consignment_code": "01916c37-ace3-73ba-9616-99f46a069684"
  }
  ```

### Get My Consignments

- **Endpoint**: `GET {{BASE_URL}}/api/courier/consignments/assigned-to-me`
- **Description**: This endpoint retrieves the list of consignments assigned to the courier.

### Consignment Received

- **Endpoint**: `POST {{BASE_URL}}/api/courier/consignments/received`
- **Description**: This endpoint is used by the courier to mark a consignment as received.
- **Sample Request**:
  ```json
  {
      "consignment_code": "01916c37-ace3-73ba-9616-99f46a069684"
  }
  ```

### Consignment Arrived

- **Endpoint**: `POST {{BASE_URL}}/api/courier/consignments/arrived`
- **Description**: This endpoint is used by the courier to mark a consignment as arrived at the delivery location.
- **Sample Request**:
  ```json
  {
      "consignment_code": "01916c37-ace3-73ba-9616-99f46a069684"
  }
  ```

---

## Authentication

Both the client and courier APIs require Bearer token authentication. The token should be included in the Authorization header of each request.

Example:
```http
Authorization: Bearer <token>
```

## Variables

The Postman collection uses the following environment variable:

- `BASE_URL`: The base URL for the API. For example, `127.0.0.1:8000`.

