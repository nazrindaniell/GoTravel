<div align="center">
  <img alt="GoTravel Logo" src="https://github.com/nazrindaniell/GoTravel/assets/79645841/47d8c1f4-d397-4009-8242-709ba14fc29e">
  <h3>Membership travel agency website</h3>
  <p>GoTravel is a travel agency membership website that aims to convert users to loyal customers by offering a variety of membership plans with benefits to choose from.</p>
  <br>
  <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/nazrindaniell/GoTravel">
  <img alt="GitHub repo size" src="https://img.shields.io/github/repo-size/nazrindaniell/GoTravel">
  <img alt="GitHub forks" src="https://img.shields.io/github/forks/nazrindaniell/GoTravel">
  <img alt="GitHub watchers" src="https://img.shields.io/github/watchers/nazrindaniell/GoTravel">
  <img alt="X (formerly Twitter) Follow" src="https://img.shields.io/twitter/follow/zinniel_">  
</div>
<br>
<br>

## :scroll: Project Description

This project aims to use the Stripe API for membership transactions when users want to upgrade from their current plans to higher plans while maintaining the interface's aesthetics.
<br><br>
### Here are some of the things that I learned and implemented throughout the creation of this project

:wrench: `Make use of the Stripe API` to handle the transaction

:bookmark_tabs: `Listen to events and extract the necessary information` to store or retrieve in the database.

:hook: `Learn about the webhook endpoint to read and handle the event` while providing the correct response.

:stars: Begin by `scratching the interface in Figma` to save time during the coding process.
<br><br>

## 🛠️ Built With

<ul>
  <li><img alt="Static Badge" src="https://img.shields.io/badge/HTML5-%23000?style=for-the-badge&logo=HTML5&logoColor=%23E34F26&labelColor=%23fff&color=%23E34F26"></li>
  <li><img alt="Static Badge" src="https://img.shields.io/badge/CSS-%23000?style=for-the-badge&logo=CSS3&logoColor=%231572B6&labelColor=%23fff&color=%231572B6"></li>
  <li><img alt="Static Badge" src="https://img.shields.io/badge/PHP-%23000?style=for-the-badge&logo=PHP&logoColor=%23777BB4&labelColor=%23fff&color=%23777BB4"></li>
  <li><img alt="Static Badge" src="https://img.shields.io/badge/MySQL-white?style=for-the-badge&logo=MySQL&logoColor=%234479A1&labelColor=%23fff&color=%234479A1">
</ul>
<br>

## :camera: Screenshots
![home page](https://github.com/nazrindaniell/GoTravel/assets/79645841/92ba751d-a047-4f23-b176-69b056d1f7af)
![membership](https://github.com/nazrindaniell/GoTravel/assets/79645841/557ca564-a563-4e06-a148-0dda881bb6d1)
![login](https://github.com/nazrindaniell/GoTravel/assets/79645841/454def24-dc84-4984-8815-9cfe398d3157)
![tour details](https://github.com/nazrindaniell/GoTravel/assets/79645841/710a8f8b-6ab9-488e-9e5d-436df53fa8f3)

## :cd: Installation

```
git clone https://github.com/nazrindaniell/GoTravel
```

### Setup

<div>
  <ul>
    <li><a href="https://www.apachefriends.org/download.html">Install XAMPP</a></li>
    <li><a href="https://befonts.com/cina-geo-font-family.html">Install Cina Geo Font Family</a></li>
  </ul>
</div>

### Run the localhost server

Open XAMPP and START the following:

- `Apache`
- `MySQL`

### Create a database

1. Open the browser and type `localhost/phpmyadmin`
2. Create a new database and name it `gotravel`, and then click `CREATE` to create a database.
3. `Navigate to SQL` and paste this [queries](https://github.com/nazrindaniell/GoTravel/files/14664669/gotravel.tables.txt)

> [!IMPORTANT]
> When naming the database, make sure it is `gotravel`, or if you want to use your preferred database name, you need to configure the `dbname` variable in the `php/dbconnect.php` file to your database name in `localhost/phpmyadmin`.

```php
<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "gotravel";
	$conn = mysqli_connect($host, $username, $password, $dbname);

	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}
?>
```

<br>

## :clipboard: How to Use

### Create your Stripe account
1. Go to the [Stripe](https://stripe.com/en-my) website and register if you don't have one.
2. On the dashboard page, turn on the `Test mode` to safely make transactions in the testing environment.
> [!NOTE]
> By enabling the `Test mode`, you're using test data and real money won't be charged.
3. Click on the `Developers` section and find the `API keys`.
4. Copy the `Secret key` and paste it into the `php/secrets.php` file:
```php
<?php
$stripeSecretKey = 'PASTE YOUR SECRET KEY IN THIS STRING';
?>
```
> [!IMPORTANT]
> Make sure not to reveal your `Secret key` to the public, as it is only accessible to your Stripe account.

---

### Add/edit a tour package

1. On the browser, navigate to `localhost/GoTravel/admin/adding_packages.php`
2. Fill in all the requirements and click the `Add Package` button.  
> [!NOTE]
> Make sure to enter each input's package details with the appropriate datatype.
3. To edit an existing tour package, go to the top drop-down menu and select the `Edit Selected Package` button. After editing, click the `Edit Package` button to save the edited package to the database.

---

### Delete a tour package

1. Navigate to `localhost/GoTravel/admin/delete_packages.php`.
2. Select a ticket that you want to delete.
3. Click the `Delete Selected Package` button to delete the package.
<br><br>

## :sunflower: Contribute

If you want to say thank you and/or support the active development of GoTravel:

1. Add a [GitHub Star](https://github.com/nazrindaniell/GemaLoka) to the project.
2. Support the project by donating a [cup of coffee](https://www.buymeacoffee.com/nazrindaniell).
<br><br>

## :bust_in_silhouette: Author
If you have any inquiries, feel free to leave me a message at nazrindaniel8@gmail.com
