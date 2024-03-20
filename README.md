<div align="center">
  <img alt="GoTravel Logo" src="https://github.com/nazrindaniell/GemaLoka/assets/79645841/d752c8e8-f47e-4b5b-8af5-2059816c6668">
  <h3>Membership travelling agency website</h3>
  <p>GoTravel is a travel agency membership website that aims to convert users to their loyal customers by offering a variety of membership plans with their own benefits to choose from.</p>
  <br>
  <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/nazrindaniell/GoTravel">
  <img alt="GitHub repo size" src="https://img.shields.io/github/repo-size/nazrindaniell/GoTravel">
  <img alt="GitHub Repo stars" src="https://img.shields.io/github/stars/nazrindaniell/GoTravel">
  <img alt="GitHub watchers" src="https://img.shields.io/github/watchers/nazrindaniell/GoTravel">
  <img alt="X (formerly Twitter) Follow" src="https://img.shields.io/twitter/follow/zinniel_">  
</div>
<br>
<br>
## :scroll: Project Description

This project aims to use the Stripe API for membership transactions when users want to upgrade from their current plans to higher plans while maintaining the interface's aesthetics.

### Here are some of the things that I learned and implemented throughout the creation of this project

Make use of the Stripe API to handle the transaction

Listen to events and extract the necessary information to store or retrieve in the database.

Learn about the webhook endpoint to read and handle the event while providing the correct response.

Begin by scratching the interface in Figma to save time during the coding process.

## 🛠️ Built With

<ul>
  <li><img alt="Static Badge" src="https://img.shields.io/badge/HTML5-%23000?style=for-the-badge&logo=HTML5&logoColor=%23E34F26&labelColor=%23fff&color=%23E34F26"></li>
  <li><img alt="Static Badge" src="https://img.shields.io/badge/CSS-%23000?style=for-the-badge&logo=CSS3&logoColor=%231572B6&labelColor=%23fff&color=%231572B6"></li>
  <li><img alt="Static Badge" src="https://img.shields.io/badge/PHP-%23000?style=for-the-badge&logo=PHP&logoColor=%23777BB4&labelColor=%23fff&color=%23777BB4"></li>
  <li><img alt="Static Badge" src="https://img.shields.io/badge/MySQL-white?style=for-the-badge&logo=MySQL&logoColor=%234479A1&labelColor=%23fff&color=%234479A1">
</ul>

## :camera: Screenshots

## :cd: Installation

```
git clone https://github.com/nazrindaniell/GoTravel
```

### Setup

<div>
  <ul>
    <li><a href="https://www.apachefriends.org/download.html">Install XAMPP</a></li>
    <li><a href="https://freemyfonts.com/mont-font-family">Install Mont Font Family</a></li>
  </ul>
</div>

### Run the localhost server

Open XAMPP and START the following:

- `Apache`
- `MySQL`

### Create database

1. Open browser and type `localhost/phpmyadmin`
2. Create a new database and named it `gotravel`, and then click `CREATE` to create a database.
3. `Navigate to SQL` and paste this [queries](https://github.com/nazrindaniell/GemaLoka/files/14371920/gemaloka.tables.txt) one by one.
4. Click `GO` to create the table.

> [!IMPORTANT]
> When naming the database, make sure it is `gotravel`, or if you want to use your preferred database name, you need to configure the `dbname` variable in `/php/dbconnect.php` file to your database name in `localhost/phpmyadmin`.

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

### Add/edit a tour package

1. On browser, navigate to `localhost/GoTravel/admin/adding_packages.php`
2. Fill in all the requirements and click the `Add Package` button.
   > [!NOTE]
   > Make sure to enter the package details with the appropriate datatype for each input.
3. To edit an existing tour package, go to the top drop down menu and select the `Edit Selected Package` button. After finishing the editing, click the `Edit Package` button to save the edited package to the database.

### Delete a tour package

1. Navigate to `localhost/GoTravel/php/delete_packages.php`
2. Select a ticket that you want delete
3. Click the `Delete Selected Package` button to delete the package.

## :sunflower: Contribute

If you want to say thank you and/or support the active development of GemaLoka:

1. Add a [GitHub Star](https://github.com/nazrindaniell/GemaLoka) to the project.
2. Support the project by donating a [cup of coffee](https://www.buymeacoffee.com/nazrindaniell).
   <br>
