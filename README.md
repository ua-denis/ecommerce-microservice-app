# Symfony Microservices: Product and Order Management

## Project Overview

This project implements two Symfony 6.4 microservices for product and order management with asynchronous communication.

## System Components

- **Product Service**: Manages product data and tracks product income
- **Order Service**: Creates orders, updates product quantities, and communicates with Product Service

## Prerequisites

- PHP 8.2+
- Symfony 6.4
- Composer
- RabbitMQ
- Docker

## Setup and Installation

### Environment Configuration

1. Copy the `.env.example` to `.env` in both `product-service` and `order-service`
2. Adjust environment variables as needed

### Start Services

```bash
docker network create app_network
docker-compose up -d
```

### Product Service

1. Navigate to `product-service` directory

```bash
docker-compose exec product-service composer install
```

### Order Service

1. Navigate to `order-service` directory

```bash
docker-compose exec order-service composer install
```

## API Endpoints

### Product Service

- `POST /products`
    - Create a new product
    - Request Body:
      ```json
      {
        "name": "Product Name",
        "price": 99.99,
        "qty": 100
      }
      ```
    - Response:
      ```json
      {
        "id": "uuid",
        "name": "Product Name",
        "qty": 100,
        "price": 99.99,
        "income": 0
      }
      ```

- `GET /products`
    - List all products
    - Response:
      ```json
      {
        "data": [
          {
            "id": "uuid",
            "name": "Product Name",
            "qty": 100,
            "price": 99.99,
            "income": 0
          }
        ]
      }
      ```

### Order Service

- `POST /orders`
    - Create a new order
    - Request Body:
      ```json
      {
        "product": "product-uuid",
        "qty": 10
      }
      ```
    - Response:
      ```json
      {
        "id": "order-uuid",
        "product": {
          "id": "product-uuid",
          "name": "Product Name",
          "qty": 100,
          "price": 99.99
        },
        "qty": 10,
        "amount": 999.9
      }
      ```

- `GET /orders`
    - List all orders
    - Response:
      ```json
      {
        "data": [
          {
            "id": "order-uuid",
            "product": {},
            "qty": 10,
            "amount": 999.9
          }
        ]
      }
      ```

## Messaging

- Uses RabbitMQ for asynchronous communication
- Order service publishes product income update messages
- Product service consumes these messages to update product income

## Docker Deployment

A `docker-compose.yml` is provided in root directory for containerized deployment.
A `Dockerfile` is provided in each service directory (`./Dockerfile`).

## Architecture

- Microservices architecture
- Clean architecture
- Separate microservices for Product and Order management
- RabbitMQ for asynchronous communication
- PostgreSQL databases
- HTTP-based API communication
- Validation and error handling
- Scalable design
