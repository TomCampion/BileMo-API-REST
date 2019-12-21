#BileMo

BileMo offers an API that allows you to:
<ul>
<li>
consult the list of Customer;
<li>
consult the details of a Customer;
<li>
consult the list of BileMo products;
<li>
consult the details of a BileMo product;
<li>
consult the list of registered users linked to a client on the website;
<li>
consult the details of a registered user linked to a client;
<li>
add a new user linked to a customer;
<li>
delete a user added by a customer.
</ul>

## Installation
1 - Clone or download the GitHub repository in the desired folder:
```
    git clone https://github.com/TomCampion/BileMo-API-REST
```
2 - Install libraries by running : 
```
    composer install
```

3 - Generate the SSH keys for the JWT authentication :
```
$ mkdir -p config/jwt
$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```
4 - Configure your environment variables in the .env file

5 - Create the database if it does not already exist, type the command below :
```
    php bin/console doctrine:database:create
```
6 - Create the different tables in the database by applying the migrations :
```
    php bin/console doctrine:migrations:migrate
```

## Documentation

Once the project is installed, you can find detailed documentation here : **/api?ui=re_doc**

Otherwise, here is a brief documentation :
#### Customer
- **GET**  /api/customers
<br>Retrieves the collection of Customer resources.

- **GET** /api/customers/{id}
<br>Retrieves a Customer resource.

#### Product
- **GET** /api/products
<br>Retrieves the collection of Product resources.

- **GET** /api/products/{id}
<br>Retrieves a Product resource.

#### User
- **GET** /api/users
<br>Retrieves the collection of User resources related to to the current connected Customer.

- **POST** /api/users
<br>Creates a User resource.

- **GET** /api/users/{id}
<br>Retrieves a User resource.

- **DELETE** /api/users/{id}
<br>Removes the User resource.